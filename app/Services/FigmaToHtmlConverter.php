<?php

namespace App\Services;

class FigmaToHtmlConverter
{
    protected array $styles = [];
    protected int $classCounter = 0;
    protected array $imageUrls = [];

    /**
     * Convert a Figma document to HTML + CSS.
     */
    public function convert(array $document, array $imageUrls = []): array
    {
        $this->styles = [];
        $this->classCounter = 0;
        $this->imageUrls = $imageUrls;

        $html = $this->convertNode($document);
        $css = $this->generateCss();

        return [
            'html' => $html,
            'css' => $css,
            'full_page' => $this->wrapInBootstrapPage($html, $css),
        ];
    }

    /**
     * Convert a Figma file's pages to separate HTML outputs.
     */
    public function convertFile(array $fileData, array $imageUrls = []): array
    {
        $pages = [];
        $document = $fileData['document'] ?? [];
        $children = $document['children'] ?? [];

        foreach ($children as $page) {
            $this->styles = [];
            $this->classCounter = 0;
            $this->imageUrls = $imageUrls;

            $html = $this->convertNode($page);
            $css = $this->generateCss();

            $pages[] = [
                'name' => $page['name'] ?? 'Untitled Page',
                'id' => $page['id'] ?? '',
                'html' => $html,
                'css' => $css,
                'full_page' => $this->wrapInBootstrapPage($html, $css),
            ];
        }

        return $pages;
    }

    /**
     * Convert a single Figma node to HTML.
     */
    protected function convertNode(array $node, int $depth = 0): string
    {
        if (($node['visible'] ?? true) === false) {
            return '';
        }

        $type = $node['type'] ?? '';

        return match ($type) {
            'DOCUMENT' => $this->convertContainer($node, 'div', $depth),
            'CANVAS' => $this->convertCanvas($node, $depth),
            'FRAME', 'GROUP', 'COMPONENT', 'COMPONENT_SET', 'INSTANCE', 'SECTION' => $this->convertFrame($node, $depth),
            'TEXT' => $this->convertText($node, $depth),
            'RECTANGLE', 'ELLIPSE', 'LINE', 'REGULAR_POLYGON', 'STAR', 'VECTOR', 'BOOLEAN_OPERATION' => $this->convertShape($node, $depth),
            default => $this->convertContainer($node, 'div', $depth),
        };
    }

    protected function convertCanvas(array $node, int $depth): string
    {
        $children = $node['children'] ?? [];
        $html = '';

        foreach ($children as $child) {
            $html .= $this->convertNode($child, $depth);
        }

        return $html;
    }

    protected function convertFrame(array $node, int $depth): string
    {
        $className = $this->generateClassName($node);
        $styles = $this->extractFrameStyles($node);
        $this->styles[$className] = $styles;

        $indent = str_repeat('  ', $depth);
        $children = $node['children'] ?? [];
        $childHtml = '';

        foreach ($children as $child) {
            $childHtml .= $this->convertNode($child, $depth + 1);
        }

        $name = htmlspecialchars($node['name'] ?? '', ENT_QUOTES);
        $html = "{$indent}<div class=\"{$className}\" data-figma-name=\"{$name}\">\n";
        $html .= $childHtml;
        $html .= "{$indent}</div>\n";

        return $html;
    }

    protected function convertText(array $node, int $depth): string
    {
        $className = $this->generateClassName($node);
        $styles = $this->extractTextStyles($node);
        $this->styles[$className] = $styles;

        $indent = str_repeat('  ', $depth);
        $characters = htmlspecialchars($node['characters'] ?? '', ENT_QUOTES);

        // Determine the appropriate tag
        $fontSize = $node['style']['fontSize'] ?? 16;
        $tag = $this->getTextTag($fontSize, $node);

        $html = "{$indent}<{$tag} class=\"{$className}\">{$characters}</{$tag}>\n";

        return $html;
    }

    protected function convertShape(array $node, int $depth): string
    {
        $className = $this->generateClassName($node);
        $type = $node['type'] ?? '';

        // Check if there's an image fill
        $fills = $node['fills'] ?? [];
        $hasImageFill = false;
        foreach ($fills as $fill) {
            if (($fill['type'] ?? '') === 'IMAGE') {
                $hasImageFill = true;
                break;
            }
        }

        $styles = $this->extractShapeStyles($node);
        $this->styles[$className] = $styles;

        $indent = str_repeat('  ', $depth);
        $name = htmlspecialchars($node['name'] ?? '', ENT_QUOTES);

        $nodeId = $node['id'] ?? '';
        if ($hasImageFill && isset($this->imageUrls[$nodeId])) {
            return "{$indent}<img class=\"{$className}\" src=\"{$this->imageUrls[$nodeId]}\" alt=\"{$name}\">\n";
        }

        return "{$indent}<div class=\"{$className}\" data-figma-name=\"{$name}\"></div>\n";
    }

    protected function convertContainer(array $node, string $tag, int $depth): string
    {
        $children = $node['children'] ?? [];
        $html = '';

        foreach ($children as $child) {
            $html .= $this->convertNode($child, $depth);
        }

        return $html;
    }

    protected function extractFrameStyles(array $node): array
    {
        $styles = [];

        // Size
        $box = $node['absoluteBoundingBox'] ?? $node['size'] ?? [];
        if (isset($box['width'])) {
            $styles['width'] = round($box['width']) . 'px';
        }
        if (isset($box['height'])) {
            $styles['height'] = round($box['height']) . 'px';
        }

        // Layout mode (auto-layout)
        $layoutMode = $node['layoutMode'] ?? null;
        if ($layoutMode) {
            $styles['display'] = 'flex';
            $styles['flex-direction'] = $layoutMode === 'VERTICAL' ? 'column' : 'row';

            $gap = $node['itemSpacing'] ?? 0;
            if ($gap > 0) {
                $styles['gap'] = $gap . 'px';
            }

            // Alignment
            $primaryAlign = $node['primaryAxisAlignItems'] ?? 'MIN';
            $counterAlign = $node['counterAxisAlignItems'] ?? 'MIN';

            $styles['justify-content'] = match ($primaryAlign) {
                'CENTER' => 'center',
                'MAX' => 'flex-end',
                'SPACE_BETWEEN' => 'space-between',
                default => 'flex-start',
            };

            $styles['align-items'] = match ($counterAlign) {
                'CENTER' => 'center',
                'MAX' => 'flex-end',
                default => 'flex-start',
            };
        }

        // Padding
        $paddingLeft = $node['paddingLeft'] ?? 0;
        $paddingRight = $node['paddingRight'] ?? 0;
        $paddingTop = $node['paddingTop'] ?? 0;
        $paddingBottom = $node['paddingBottom'] ?? 0;

        if ($paddingTop || $paddingRight || $paddingBottom || $paddingLeft) {
            $styles['padding'] = "{$paddingTop}px {$paddingRight}px {$paddingBottom}px {$paddingLeft}px";
        }

        // Background
        $this->applyFillStyles($node, $styles);

        // Border radius
        $this->applyBorderRadius($node, $styles);

        // Effects (shadows, blur)
        $this->applyEffects($node, $styles);

        // Strokes
        $this->applyStrokes($node, $styles);

        // Overflow
        if (($node['clipsContent'] ?? false) === true) {
            $styles['overflow'] = 'hidden';
        }

        // Opacity
        $opacity = $node['opacity'] ?? 1;
        if ($opacity < 1) {
            $styles['opacity'] = round($opacity, 2);
        }

        // Position (for absolute positioned children)
        if (isset($node['constraints'])) {
            $styles['position'] = 'relative';
        }

        return $styles;
    }

    protected function extractTextStyles(array $node): array
    {
        $styles = [];
        $textStyle = $node['style'] ?? [];

        // Font family
        $fontFamily = $textStyle['fontFamily'] ?? null;
        if ($fontFamily) {
            $styles['font-family'] = "'{$fontFamily}', sans-serif";
        }

        // Font size
        $fontSize = $textStyle['fontSize'] ?? null;
        if ($fontSize) {
            $styles['font-size'] = $fontSize . 'px';
        }

        // Font weight
        $fontWeight = $textStyle['fontWeight'] ?? null;
        if ($fontWeight) {
            $styles['font-weight'] = $fontWeight;
        }

        // Letter spacing
        $letterSpacing = $textStyle['letterSpacing'] ?? 0;
        if ($letterSpacing != 0) {
            $styles['letter-spacing'] = round($letterSpacing, 2) . 'px';
        }

        // Line height
        $lineHeight = $textStyle['lineHeightPx'] ?? null;
        $lineHeightUnit = $textStyle['lineHeightUnit'] ?? 'INTRINSIC';
        if ($lineHeight && $lineHeightUnit !== 'INTRINSIC') {
            $styles['line-height'] = round($lineHeight) . 'px';
        }

        // Text alignment
        $textAlign = $textStyle['textAlignHorizontal'] ?? 'LEFT';
        if ($textAlign !== 'LEFT') {
            $styles['text-align'] = strtolower($textAlign);
        }

        // Text decoration
        $decoration = $textStyle['textDecoration'] ?? 'NONE';
        if ($decoration !== 'NONE') {
            $styles['text-decoration'] = strtolower(str_replace('_', '-', $decoration));
        }

        // Text transform
        $textCase = $textStyle['textCase'] ?? 'ORIGINAL';
        if ($textCase !== 'ORIGINAL') {
            $styles['text-transform'] = match ($textCase) {
                'UPPER' => 'uppercase',
                'LOWER' => 'lowercase',
                'TITLE' => 'capitalize',
                default => 'none',
            };
        }

        // Color from fills
        $this->applyFillStyles($node, $styles, 'color');

        // Opacity
        $opacity = $node['opacity'] ?? 1;
        if ($opacity < 1) {
            $styles['opacity'] = round($opacity, 2);
        }

        return $styles;
    }

    protected function extractShapeStyles(array $node): array
    {
        $styles = [];
        $type = $node['type'] ?? '';

        // Size
        $box = $node['absoluteBoundingBox'] ?? $node['size'] ?? [];
        if (isset($box['width'])) {
            $styles['width'] = round($box['width']) . 'px';
        }
        if (isset($box['height'])) {
            $styles['height'] = round($box['height']) . 'px';
        }

        // Ellipse = border-radius 50%
        if ($type === 'ELLIPSE') {
            $styles['border-radius'] = '50%';
        }

        // Background
        $this->applyFillStyles($node, $styles);

        // Border radius
        if ($type !== 'ELLIPSE') {
            $this->applyBorderRadius($node, $styles);
        }

        // Effects
        $this->applyEffects($node, $styles);

        // Strokes
        $this->applyStrokes($node, $styles);

        // Opacity
        $opacity = $node['opacity'] ?? 1;
        if ($opacity < 1) {
            $styles['opacity'] = round($opacity, 2);
        }

        return $styles;
    }

    protected function applyFillStyles(array $node, array &$styles, string $property = 'background-color'): void
    {
        $fills = $node['fills'] ?? [];

        foreach ($fills as $fill) {
            if (($fill['visible'] ?? true) === false) {
                continue;
            }

            $type = $fill['type'] ?? '';

            if ($type === 'SOLID') {
                $color = $fill['color'] ?? [];
                $opacity = $fill['opacity'] ?? 1;
                $styles[$property] = $this->rgbaToString($color, $opacity);
                break;
            }

            if ($type === 'GRADIENT_LINEAR') {
                $gradientStops = $fill['gradientStops'] ?? [];
                $gradientParts = [];
                foreach ($gradientStops as $stop) {
                    $color = $this->rgbaToString($stop['color'] ?? []);
                    $position = round(($stop['position'] ?? 0) * 100);
                    $gradientParts[] = "{$color} {$position}%";
                }
                if ($gradientParts) {
                    $bgProp = $property === 'color' ? 'color' : 'background';
                    $styles[$bgProp] = 'linear-gradient(180deg, ' . implode(', ', $gradientParts) . ')';
                }
                break;
            }
        }
    }

    protected function applyBorderRadius(array $node, array &$styles): void
    {
        $cornerRadius = $node['cornerRadius'] ?? 0;
        if ($cornerRadius > 0) {
            $styles['border-radius'] = $cornerRadius . 'px';
            return;
        }

        $tl = $node['rectangleCornerRadii'][0] ?? 0;
        $tr = $node['rectangleCornerRadii'][1] ?? 0;
        $br = $node['rectangleCornerRadii'][2] ?? 0;
        $bl = $node['rectangleCornerRadii'][3] ?? 0;

        if ($tl || $tr || $br || $bl) {
            $styles['border-radius'] = "{$tl}px {$tr}px {$br}px {$bl}px";
        }
    }

    protected function applyEffects(array $node, array &$styles): void
    {
        $effects = $node['effects'] ?? [];
        $shadows = [];

        foreach ($effects as $effect) {
            if (($effect['visible'] ?? true) === false) {
                continue;
            }

            $type = $effect['type'] ?? '';

            if ($type === 'DROP_SHADOW' || $type === 'INNER_SHADOW') {
                $offset = $effect['offset'] ?? ['x' => 0, 'y' => 0];
                $radius = $effect['radius'] ?? 0;
                $spread = $effect['spread'] ?? 0;
                $color = $this->rgbaToString($effect['color'] ?? []);
                $inset = $type === 'INNER_SHADOW' ? 'inset ' : '';

                $shadows[] = "{$inset}{$offset['x']}px {$offset['y']}px {$radius}px {$spread}px {$color}";
            }

            if ($type === 'LAYER_BLUR') {
                $radius = $effect['radius'] ?? 0;
                $styles['filter'] = "blur({$radius}px)";
            }

            if ($type === 'BACKGROUND_BLUR') {
                $radius = $effect['radius'] ?? 0;
                $styles['backdrop-filter'] = "blur({$radius}px)";
            }
        }

        if ($shadows) {
            $styles['box-shadow'] = implode(', ', $shadows);
        }
    }

    protected function applyStrokes(array $node, array &$styles): void
    {
        $strokes = $node['strokes'] ?? [];
        $strokeWeight = $node['strokeWeight'] ?? 0;

        if ($strokeWeight <= 0 || empty($strokes)) {
            return;
        }

        foreach ($strokes as $stroke) {
            if (($stroke['visible'] ?? true) === false) {
                continue;
            }

            if (($stroke['type'] ?? '') === 'SOLID') {
                $color = $this->rgbaToString($stroke['color'] ?? []);
                $styles['border'] = "{$strokeWeight}px solid {$color}";
                break;
            }
        }
    }

    protected function rgbaToString(array $color, float $opacity = 1.0): string
    {
        $r = round(($color['r'] ?? 0) * 255);
        $g = round(($color['g'] ?? 0) * 255);
        $b = round(($color['b'] ?? 0) * 255);
        $a = round(($color['a'] ?? 1) * $opacity, 2);

        if ($a >= 1) {
            return sprintf('#%02x%02x%02x', $r, $g, $b);
        }

        return "rgba({$r}, {$g}, {$b}, {$a})";
    }

    protected function generateClassName(array $node): string
    {
        $this->classCounter++;
        $name = $node['name'] ?? 'element';
        // Sanitize name for CSS class
        $sanitized = preg_replace('/[^a-zA-Z0-9_-]/', '-', $name);
        $sanitized = preg_replace('/-+/', '-', $sanitized);
        $sanitized = trim($sanitized, '-');

        return "fg-{$sanitized}-{$this->classCounter}";
    }

    protected function getTextTag(float $fontSize, array $node): string
    {
        $fontWeight = $node['style']['fontWeight'] ?? 400;

        if ($fontSize >= 32 && $fontWeight >= 600) return 'h1';
        if ($fontSize >= 24 && $fontWeight >= 600) return 'h2';
        if ($fontSize >= 20 && $fontWeight >= 500) return 'h3';
        if ($fontSize >= 18 && $fontWeight >= 500) return 'h4';
        if ($fontSize >= 16 && $fontWeight >= 600) return 'h5';
        if ($fontSize < 14) return 'small';

        return 'p';
    }

    protected function generateCss(): string
    {
        $css = "/* Generated from Figma design */\n\n";

        foreach ($this->styles as $className => $properties) {
            if (empty($properties)) {
                continue;
            }

            $css .= ".{$className} {\n";
            foreach ($properties as $prop => $value) {
                $css .= "  {$prop}: {$value};\n";
            }
            $css .= "}\n\n";
        }

        return $css;
    }

    protected function wrapInBootstrapPage(string $html, string $css): string
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Figma Design Export</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    {$css}
  </style>
</head>
<body>
  <div class="container-fluid">
    {$html}
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
HTML;
    }
}
