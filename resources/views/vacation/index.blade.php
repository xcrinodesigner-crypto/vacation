<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Airportal - Travel & Vacation</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1a56db;
            --primary-dark: #1648b8;
            --accent: #f97316;
            --dark: #1e293b;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-500: #64748b;
            --gray-700: #334155;
            --gray-900: #0f172a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* ========== NAVBAR ========== */
        .navbar-vacation {
            padding: 14px 0;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        .navbar-vacation .navbar-brand {
            font-weight: 800;
            font-size: 1.35rem;
            letter-spacing: -0.5px;
        }

        .navbar-vacation .navbar-brand .blue-text {
            color: var(--primary);
        }

        .navbar-vacation .navbar-brand .portal-text {
            color: var(--dark);
        }

        .navbar-vacation .nav-link {
            color: var(--gray-700);
            font-weight: 500;
            font-size: 0.9rem;
            padding: 8px 16px !important;
            transition: color 0.2s;
        }

        .navbar-vacation .nav-link:hover,
        .navbar-vacation .nav-link.active {
            color: var(--primary);
        }

        .btn-login {
            border: 1.5px solid var(--gray-300);
            color: var(--dark);
            font-weight: 500;
            padding: 7px 22px;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-login:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-register {
            background: var(--primary);
            color: #fff;
            font-weight: 500;
            padding: 7px 22px;
            border-radius: 8px;
            font-size: 0.9rem;
            border: 1.5px solid var(--primary);
            transition: all 0.2s;
        }

        .btn-register:hover {
            background: var(--primary-dark);
            color: #fff;
        }

        /* ========== HERO SECTION ========== */
        .hero-section {
            position: relative;
            min-height: 520px;
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 50%, #4a90c4 100%);
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 80%, rgba(255,255,255,0.05) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 50%);
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 120px;
            background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: #fff;
            padding-top: 60px;
            padding-bottom: 100px;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.15;
            max-width: 560px;
            margin-bottom: 16px;
        }

        .hero-content p {
            font-size: 1.05rem;
            opacity: 0.85;
            max-width: 480px;
            line-height: 1.6;
        }

        .hero-mountains {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 55%;
            height: 100%;
            z-index: 1;
        }

        .hero-mountains svg {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 80%;
        }

        /* ========== SEARCH BAR ========== */
        .search-bar-wrapper {
            position: relative;
            z-index: 10;
            margin-top: -36px;
        }

        .search-bar {
            background: #fff;
            border-radius: 16px;
            padding: 12px 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .search-bar .search-field {
            border: none;
            background: var(--gray-100);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.88rem;
            color: var(--dark);
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }

        .search-bar .search-field:focus {
            outline: none;
            background: #e8effa;
        }

        .search-bar .search-field::placeholder {
            color: var(--gray-500);
        }

        .search-bar label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 6px;
            display: block;
        }

        .btn-search {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 32px;
            font-weight: 600;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .btn-search:hover {
            background: var(--primary-dark);
            color: #fff;
        }

        /* ========== SECTION TITLES ========== */
        .section-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .section-subtitle {
            color: var(--gray-500);
            font-size: 0.92rem;
        }

        .see-all-link {
            color: var(--primary);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .see-all-link:hover {
            opacity: 0.8;
            color: var(--primary);
        }

        /* ========== FILTER TABS ========== */
        .filter-tabs {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 7px 20px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            border: 1.5px solid var(--gray-200);
            background: #fff;
            color: var(--gray-700);
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        .filter-tab:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .filter-tab.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        /* ========== DESTINATION CARDS ========== */
        .destination-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .destination-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .destination-card .card-img-top {
            height: 200px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .destination-card .card-body {
            padding: 16px;
        }

        .destination-card .city-name {
            font-weight: 600;
            font-size: 1rem;
            color: var(--gray-900);
        }

        .destination-card .country-name {
            font-size: 0.82rem;
            color: var(--gray-500);
        }

        .destination-card .price-tag {
            font-weight: 700;
            color: var(--primary);
            font-size: 0.95rem;
        }

        .dest-img-placeholder {
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.7);
            font-size: 2.5rem;
        }

        .dest-img-1 { background: linear-gradient(135deg, #1e88e5, #1565c0); }
        .dest-img-2 { background: linear-gradient(135deg, #43a047, #2e7d32); }
        .dest-img-3 { background: linear-gradient(135deg, #fb8c00, #ef6c00); }
        .dest-img-4 { background: linear-gradient(135deg, #e53935, #c62828); }
        .dest-img-5 { background: linear-gradient(135deg, #8e24aa, #6a1b9a); }
        .dest-img-6 { background: linear-gradient(135deg, #00acc1, #00838f); }

        /* ========== PROMO BANNER ========== */
        .promo-banner {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            min-height: 260px;
            background: linear-gradient(135deg, #1a365d 0%, #2b6cb0 50%, #63b3ed 100%);
            display: flex;
            align-items: center;
        }

        .promo-banner .promo-content {
            position: relative;
            z-index: 2;
            color: #fff;
            padding: 40px;
        }

        .promo-banner .promo-content h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .promo-banner .promo-content p {
            opacity: 0.9;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .btn-promo {
            background: #fff;
            color: var(--primary);
            font-weight: 600;
            padding: 10px 28px;
            border-radius: 10px;
            border: none;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-promo:hover {
            background: #f0f0f0;
            color: var(--primary-dark);
        }

        .promo-decoration {
            position: absolute;
            right: -20px;
            top: 0;
            bottom: 0;
            width: 45%;
            opacity: 0.15;
        }

        /* ========== CATALOG CARDS ========== */
        .catalog-card {
            border-radius: 14px;
            overflow: hidden;
            text-align: center;
            padding: 28px 16px;
            background: #fff;
            border: 1.5px solid var(--gray-200);
            transition: all 0.25s;
            cursor: pointer;
        }

        .catalog-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 20px rgba(26,86,219,0.1);
            transform: translateY(-2px);
        }

        .catalog-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 14px;
        }

        .catalog-icon.hotels { background: #dbeafe; color: #1a56db; }
        .catalog-icon.flights { background: #fce7f3; color: #db2777; }
        .catalog-icon.activities { background: #d1fae5; color: #059669; }
        .catalog-icon.packages { background: #fef3c7; color: #d97706; }
        .catalog-icon.cruises { background: #e0e7ff; color: #4f46e5; }
        .catalog-icon.transport { background: #ffe4e6; color: #e11d48; }

        .catalog-card h6 {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .catalog-card p {
            font-size: 0.8rem;
            color: var(--gray-500);
            margin-bottom: 0;
        }

        /* ========== OFFER CARDS ========== */
        .offer-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .offer-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .offer-img {
            height: 180px;
            position: relative;
        }

        .offer-img-1 { background: linear-gradient(135deg, #f6d365, #fda085); }
        .offer-img-2 { background: linear-gradient(135deg, #a18cd1, #fbc2eb); }
        .offer-img-3 { background: linear-gradient(135deg, #ffecd2, #fcb69f); }

        .offer-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--accent);
            color: #fff;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .offer-card .card-body {
            padding: 16px;
        }

        .offer-card .offer-title {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 6px;
        }

        .offer-card .offer-desc {
            font-size: 0.82rem;
            color: var(--gray-500);
            margin-bottom: 10px;
        }

        .offer-card .offer-price {
            font-weight: 700;
            color: var(--primary);
        }

        .offer-card .offer-original {
            text-decoration: line-through;
            color: var(--gray-500);
            font-size: 0.82rem;
            margin-left: 6px;
        }

        /* ========== GETAWAY CARDS ========== */
        .getaway-card {
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            min-height: 280px;
            display: flex;
            align-items: flex-end;
            transition: transform 0.25s;
            cursor: pointer;
        }

        .getaway-card:hover {
            transform: translateY(-4px);
        }

        .getaway-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, transparent 60%);
            z-index: 1;
        }

        .getaway-content {
            position: relative;
            z-index: 2;
            padding: 20px;
            color: #fff;
            width: 100%;
        }

        .getaway-content h5 {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 4px;
        }

        .getaway-content span {
            font-size: 0.82rem;
            opacity: 0.85;
        }

        .getaway-1 { background: linear-gradient(135deg, #2c5364, #203a43, #0f2027); }
        .getaway-2 { background: linear-gradient(135deg, #c94b4b, #4b134f); }
        .getaway-3 { background: linear-gradient(135deg, #11998e, #38ef7d); }
        .getaway-4 { background: linear-gradient(135deg, #fc5c7d, #6a82fb); }

        /* ========== LATEST PLACES ========== */
        .place-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .place-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .place-img {
            height: 170px;
        }

        .place-img-1 { background: linear-gradient(135deg, #89f7fe, #66a6ff); }
        .place-img-2 { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .place-img-3 { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .place-img-4 { background: linear-gradient(135deg, #43e97b, #38f9d7); }

        .place-card .card-body {
            padding: 14px 16px;
        }

        .place-card .place-name {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .place-card .place-location {
            font-size: 0.8rem;
            color: var(--gray-500);
        }

        .place-card .place-rating {
            color: #f59e0b;
            font-size: 0.85rem;
        }

        /* ========== REVIEWS ========== */
        .review-card {
            border-radius: 16px;
            background: #fff;
            padding: 28px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid var(--gray-200);
            transition: box-shadow 0.25s;
        }

        .review-card:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        .review-stars {
            color: #f59e0b;
            font-size: 0.9rem;
            margin-bottom: 14px;
        }

        .review-text {
            font-size: 0.9rem;
            color: var(--gray-700);
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .reviewer-img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #fff;
            font-size: 1rem;
        }

        .reviewer-1 { background: linear-gradient(135deg, #667eea, #764ba2); }
        .reviewer-2 { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .reviewer-3 { background: linear-gradient(135deg, #4facfe, #00f2fe); }

        .reviewer-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .reviewer-role {
            font-size: 0.78rem;
            color: var(--gray-500);
        }

        /* ========== STORIES ========== */
        .story-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .story-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .story-img {
            height: 190px;
        }

        .story-img-1 { background: linear-gradient(135deg, #a8edea, #fed6e3); }
        .story-img-2 { background: linear-gradient(135deg, #d299c2, #fef9d7); }
        .story-img-3 { background: linear-gradient(135deg, #89f7fe, #66a6ff); }

        .story-card .card-body {
            padding: 18px;
        }

        .story-category {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .story-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .story-excerpt {
            font-size: 0.82rem;
            color: var(--gray-500);
            line-height: 1.6;
        }

        .story-meta {
            font-size: 0.78rem;
            color: var(--gray-500);
            padding-top: 12px;
            border-top: 1px solid var(--gray-200);
        }

        /* ========== FOOTER ========== */
        .footer-section {
            background: var(--gray-900);
            color: #fff;
            padding: 60px 0 0;
        }

        .footer-brand {
            font-weight: 800;
            font-size: 1.35rem;
            margin-bottom: 14px;
        }

        .footer-brand .blue-text { color: #60a5fa; }

        .footer-desc {
            font-size: 0.85rem;
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .footer-social a {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 0.95rem;
            margin-right: 8px;
            transition: background 0.2s;
            text-decoration: none;
        }

        .footer-social a:hover {
            background: var(--primary);
        }

        .footer-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 20px;
            color: #fff;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #94a3b8;
            font-size: 0.85rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .newsletter-input {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            padding: 10px 16px;
            color: #fff;
            font-size: 0.85rem;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }

        .newsletter-input::placeholder {
            color: #94a3b8;
        }

        .newsletter-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .btn-newsletter {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 0.85rem;
            width: 100%;
            margin-top: 10px;
            font-family: 'Poppins', sans-serif;
            transition: background 0.2s;
        }

        .btn-newsletter:hover {
            background: var(--primary-dark);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 20px 0;
            margin-top: 40px;
        }

        .footer-bottom p {
            font-size: 0.82rem;
            color: #64748b;
            margin: 0;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 991.98px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-section {
                min-height: 420px;
            }

            .hero-mountains {
                width: 40%;
                opacity: 0.4;
            }

            .promo-banner .promo-content h2 {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 767.98px) {
            .hero-content h1 {
                font-size: 1.8rem;
            }

            .hero-content {
                padding-top: 40px;
                padding-bottom: 80px;
                text-align: center;
            }

            .hero-content h1,
            .hero-content p {
                max-width: 100%;
            }

            .hero-mountains {
                width: 100%;
                opacity: 0.2;
            }

            .search-bar .row {
                gap: 8px;
            }

            .section-title {
                font-size: 1.3rem;
            }

            .getaway-card {
                min-height: 220px;
            }

            .promo-banner {
                min-height: 220px;
            }

            .promo-banner .promo-content {
                padding: 24px;
            }

            .promo-banner .promo-content h2 {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 575.98px) {
            .search-bar {
                padding: 16px;
            }

            .btn-search {
                width: 100%;
                margin-top: 4px;
            }

            .hero-content h1 {
                font-size: 1.55rem;
            }
        }
    </style>
</head>
<body>

    <!-- ========== NAVBAR ========== -->
    <nav class="navbar navbar-expand-lg navbar-vacation">
        <div class="container">
            <a class="navbar-brand" href="#">
                <span class="blue-text">blue.</span><span class="portal-text">airportal.lv</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav gap-1">
                    <li class="nav-item"><a class="nav-link active" href="#">Explore</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Destinations</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Hotels</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Flights</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                </ul>
            </div>
            <div class="d-none d-lg-flex align-items-center gap-2">
                <a href="#" class="btn btn-login">Login</a>
                <a href="#" class="btn btn-register">Register</a>
            </div>
        </div>
    </nav>

    <!-- ========== HERO SECTION ========== -->
    <section class="hero-section">
        <div class="hero-mountains">
            <svg viewBox="0 0 800 400" preserveAspectRatio="xMaxYMax meet" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,400 L150,120 L250,250 L350,80 L500,220 L600,50 L750,200 L800,150 L800,400 Z" fill="rgba(255,255,255,0.06)"/>
                <path d="M0,400 L100,200 L200,300 L350,150 L500,280 L650,100 L800,250 L800,400 Z" fill="rgba(255,255,255,0.04)"/>
                <circle cx="680" cy="60" r="30" fill="rgba(255,255,255,0.06)"/>
            </svg>
        </div>
        <div class="container">
            <div class="hero-content">
                <h1>Travel, experience, and live a new and full life</h1>
                <p>Discover amazing destinations around the world. Book your dream vacation with the best deals and packages.</p>
            </div>
        </div>
    </section>

    <!-- ========== SEARCH BAR ========== -->
    <div class="search-bar-wrapper">
        <div class="container">
            <div class="search-bar">
                <div class="row align-items-end g-3">
                    <div class="col-lg-4 col-md-6">
                        <label><i class="bi bi-geo-alt me-1"></i>Destination</label>
                        <input type="text" class="search-field" placeholder="Where are you going?">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label><i class="bi bi-calendar-event me-1"></i>Check In</label>
                        <input type="date" class="search-field">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label><i class="bi bi-calendar-event me-1"></i>Check Out</label>
                        <input type="date" class="search-field">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <button class="btn btn-search w-100"><i class="bi bi-search me-2"></i>Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== TRENDING DESTINATIONS ========== -->
    <section class="py-5 mt-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="section-title">Trending Destinations</h2>
                    <p class="section-subtitle mb-0">Most popular choices for travellers worldwide</p>
                </div>
                <a href="#" class="see-all-link d-none d-md-inline">See All <i class="bi bi-arrow-right ms-1"></i></a>
            </div>

            <div class="filter-tabs mb-4">
                <button class="filter-tab active">All</button>
                <button class="filter-tab">Europe</button>
                <button class="filter-tab">Asia</button>
                <button class="filter-tab">Americas</button>
                <button class="filter-tab">Africa</button>
                <button class="filter-tab">Oceania</button>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="destination-card">
                        <div class="dest-img-placeholder dest-img-1"><i class="bi bi-building"></i></div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="city-name">Paris</div>
                                <div class="country-name"><i class="bi bi-geo-alt-fill me-1"></i>France</div>
                            </div>
                            <div class="price-tag">$320</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="destination-card">
                        <div class="dest-img-placeholder dest-img-2"><i class="bi bi-tree"></i></div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="city-name">Bali</div>
                                <div class="country-name"><i class="bi bi-geo-alt-fill me-1"></i>Indonesia</div>
                            </div>
                            <div class="price-tag">$250</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="destination-card">
                        <div class="dest-img-placeholder dest-img-3"><i class="bi bi-sun"></i></div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="city-name">Santorini</div>
                                <div class="country-name"><i class="bi bi-geo-alt-fill me-1"></i>Greece</div>
                            </div>
                            <div class="price-tag">$410</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="destination-card">
                        <div class="dest-img-placeholder dest-img-4"><i class="bi bi-snow2"></i></div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="city-name">Tokyo</div>
                                <div class="country-name"><i class="bi bi-geo-alt-fill me-1"></i>Japan</div>
                            </div>
                            <div class="price-tag">$480</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="destination-card">
                        <div class="dest-img-placeholder dest-img-5"><i class="bi bi-water"></i></div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="city-name">Maldives</div>
                                <div class="country-name"><i class="bi bi-geo-alt-fill me-1"></i>South Asia</div>
                            </div>
                            <div class="price-tag">$560</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="destination-card">
                        <div class="dest-img-placeholder dest-img-6"><i class="bi bi-globe-americas"></i></div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="city-name">New York</div>
                                <div class="country-name"><i class="bi bi-geo-alt-fill me-1"></i>United States</div>
                            </div>
                            <div class="price-tag">$380</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== PROMO BANNER ========== -->
    <section class="py-4">
        <div class="container">
            <div class="promo-banner">
                <div class="promo-decoration">
                    <svg viewBox="0 0 400 300" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="300" cy="150" r="120" fill="rgba(255,255,255,0.2)"/>
                        <circle cx="350" cy="80" r="60" fill="rgba(255,255,255,0.15)"/>
                        <path d="M50,300 L150,100 L250,200 L350,50 L400,150 L400,300 Z" fill="rgba(255,255,255,0.1)"/>
                    </svg>
                </div>
                <div class="promo-content col-lg-7">
                    <h2>Explore the World with Special Deals</h2>
                    <p>Get up to 40% off on selected destinations. Limited time offer for early bird travellers this season.</p>
                    <a href="#" class="btn btn-promo">Explore Deals <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== OUR CATALOGS ========== -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">Our Catalogs</h2>
                <p class="section-subtitle">Browse our wide range of travel services</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="catalog-card">
                        <div class="catalog-icon hotels"><i class="bi bi-building"></i></div>
                        <h6>Hotels</h6>
                        <p>2,340 listings</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="catalog-card">
                        <div class="catalog-icon flights"><i class="bi bi-airplane"></i></div>
                        <h6>Flights</h6>
                        <p>1,120 routes</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="catalog-card">
                        <div class="catalog-icon activities"><i class="bi bi-compass"></i></div>
                        <h6>Activities</h6>
                        <p>860 experiences</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="catalog-card">
                        <div class="catalog-icon packages"><i class="bi bi-box-seam"></i></div>
                        <h6>Packages</h6>
                        <p>540 bundles</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="catalog-card">
                        <div class="catalog-icon cruises"><i class="bi bi-tsunami"></i></div>
                        <h6>Cruises</h6>
                        <p>230 voyages</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="catalog-card">
                        <div class="catalog-icon transport"><i class="bi bi-car-front"></i></div>
                        <h6>Transport</h6>
                        <p>1,450 rentals</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== OFFERS FOR YOU ========== -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="section-title">Offers For You</h2>
                    <p class="section-subtitle mb-0">Exclusive deals handpicked for you</p>
                </div>
                <a href="#" class="see-all-link d-none d-md-inline">See All <i class="bi bi-arrow-right ms-1"></i></a>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="offer-card">
                        <div class="offer-img offer-img-1 d-flex align-items-center justify-content-center">
                            <i class="bi bi-sun text-white" style="font-size: 3rem; opacity: 0.5;"></i>
                            <span class="offer-badge">30% OFF</span>
                        </div>
                        <div class="card-body">
                            <div class="offer-title">Summer Beach Paradise</div>
                            <div class="offer-desc">7 nights in luxury resort with breakfast included</div>
                            <div>
                                <span class="offer-price">$699</span>
                                <span class="offer-original">$999</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="offer-card">
                        <div class="offer-img offer-img-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-moon-stars text-white" style="font-size: 3rem; opacity: 0.5;"></i>
                            <span class="offer-badge">25% OFF</span>
                        </div>
                        <div class="card-body">
                            <div class="offer-title">Mountain Retreat Escape</div>
                            <div class="offer-desc">5 nights in cozy cabin with spa access</div>
                            <div>
                                <span class="offer-price">$449</span>
                                <span class="offer-original">$599</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="offer-card">
                        <div class="offer-img offer-img-3 d-flex align-items-center justify-content-center">
                            <i class="bi bi-building text-white" style="font-size: 3rem; opacity: 0.5;"></i>
                            <span class="offer-badge">40% OFF</span>
                        </div>
                        <div class="card-body">
                            <div class="offer-title">City Explorer Bundle</div>
                            <div class="offer-desc">4 nights with guided tours & museum passes</div>
                            <div>
                                <span class="offer-price">$359</span>
                                <span class="offer-original">$599</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== WEEKEND GETAWAYS ========== -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="section-title">Weekend Getaways</h2>
                    <p class="section-subtitle mb-0">Short trips for a perfect weekend</p>
                </div>
                <a href="#" class="see-all-link d-none d-md-inline">See All <i class="bi bi-arrow-right ms-1"></i></a>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="getaway-card getaway-1">
                        <div class="getaway-content">
                            <h5>Lake Como</h5>
                            <span><i class="bi bi-geo-alt me-1"></i>Italy &middot; From $180</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="getaway-card getaway-2">
                        <div class="getaway-content">
                            <h5>Barcelona</h5>
                            <span><i class="bi bi-geo-alt me-1"></i>Spain &middot; From $210</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="getaway-card getaway-3">
                        <div class="getaway-content">
                            <h5>Swiss Alps</h5>
                            <span><i class="bi bi-geo-alt me-1"></i>Switzerland &middot; From $290</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="getaway-card getaway-4">
                        <div class="getaway-content">
                            <h5>Amsterdam</h5>
                            <span><i class="bi bi-geo-alt me-1"></i>Netherlands &middot; From $160</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== LATEST PLACES ========== -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="section-title">Latest Places</h2>
                    <p class="section-subtitle mb-0">Recently added to our collection</p>
                </div>
                <a href="#" class="see-all-link d-none d-md-inline">See All <i class="bi bi-arrow-right ms-1"></i></a>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="place-card">
                        <div class="place-img place-img-1 d-flex align-items-center justify-content-center">
                            <i class="bi bi-water text-white" style="font-size: 2.5rem; opacity: 0.4;"></i>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="place-name">Phuket Beach</div>
                                    <div class="place-location"><i class="bi bi-geo-alt me-1"></i>Thailand</div>
                                </div>
                                <div class="place-rating"><i class="bi bi-star-fill"></i> 4.8</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="place-card">
                        <div class="place-img place-img-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-building text-white" style="font-size: 2.5rem; opacity: 0.4;"></i>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="place-name">Dubai Marina</div>
                                    <div class="place-location"><i class="bi bi-geo-alt me-1"></i>UAE</div>
                                </div>
                                <div class="place-rating"><i class="bi bi-star-fill"></i> 4.9</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="place-card">
                        <div class="place-img place-img-3 d-flex align-items-center justify-content-center">
                            <i class="bi bi-snow2 text-white" style="font-size: 2.5rem; opacity: 0.4;"></i>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="place-name">Reykjavik</div>
                                    <div class="place-location"><i class="bi bi-geo-alt me-1"></i>Iceland</div>
                                </div>
                                <div class="place-rating"><i class="bi bi-star-fill"></i> 4.7</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="place-card">
                        <div class="place-img place-img-4 d-flex align-items-center justify-content-center">
                            <i class="bi bi-tree text-white" style="font-size: 2.5rem; opacity: 0.4;"></i>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="place-name">Costa Rica</div>
                                    <div class="place-location"><i class="bi bi-geo-alt me-1"></i>Central America</div>
                                </div>
                                <div class="place-rating"><i class="bi bi-star-fill"></i> 4.6</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== CUSTOMER REVIEWS ========== -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">Customer Reviews</h2>
                <p class="section-subtitle">What our happy travellers say about us</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="review-card h-100">
                        <div class="review-stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="review-text">"Amazing experience from start to finish! The booking was seamless and the hotel exceeded our expectations. Will definitely use again."</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="reviewer-img reviewer-1">SM</div>
                            <div>
                                <div class="reviewer-name">Sarah Mitchell</div>
                                <div class="reviewer-role">Travelled to Bali</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="review-card h-100">
                        <div class="review-stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="review-text">"The weekend getaway package was perfect! Great value for money and the customer service team was incredibly helpful throughout."</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="reviewer-img reviewer-2">JD</div>
                            <div>
                                <div class="reviewer-name">James Donovan</div>
                                <div class="reviewer-role">Travelled to Paris</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="review-card h-100">
                        <div class="review-stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <p class="review-text">"Found the best deals here compared to other platforms. The flight + hotel combo saved us hundreds. Highly recommended for families!"</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="reviewer-img reviewer-3">EK</div>
                            <div>
                                <div class="reviewer-name">Emily Kim</div>
                                <div class="reviewer-role">Travelled to Tokyo</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FEATURED STORIES ========== -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="section-title">Featured Stories</h2>
                    <p class="section-subtitle mb-0">Travel tips and inspiration from our blog</p>
                </div>
                <a href="#" class="see-all-link d-none d-md-inline">See All <i class="bi bi-arrow-right ms-1"></i></a>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="story-card h-100">
                        <div class="story-img story-img-1 d-flex align-items-center justify-content-center">
                            <i class="bi bi-journal-richtext" style="font-size: 2.5rem; color: rgba(0,0,0,0.15);"></i>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="story-category">Travel Tips</div>
                            <h5 class="story-title">10 Essential Packing Tips for Long Trips</h5>
                            <p class="story-excerpt flex-grow-1">Learn how to pack efficiently and travel light without missing any essentials on your next adventure.</p>
                            <div class="story-meta d-flex justify-content-between">
                                <span><i class="bi bi-calendar me-1"></i>Feb 15, 2026</span>
                                <span><i class="bi bi-clock me-1"></i>5 min read</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="story-card h-100">
                        <div class="story-img story-img-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-camera" style="font-size: 2.5rem; color: rgba(0,0,0,0.15);"></i>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="story-category">Destinations</div>
                            <h5 class="story-title">Hidden Gems in Southeast Asia You Must Visit</h5>
                            <p class="story-excerpt flex-grow-1">Discover off-the-beaten-path destinations that offer authentic cultural experiences away from crowds.</p>
                            <div class="story-meta d-flex justify-content-between">
                                <span><i class="bi bi-calendar me-1"></i>Feb 10, 2026</span>
                                <span><i class="bi bi-clock me-1"></i>7 min read</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="story-card h-100">
                        <div class="story-img story-img-3 d-flex align-items-center justify-content-center">
                            <i class="bi bi-wallet2" style="font-size: 2.5rem; color: rgba(0,0,0,0.15);"></i>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="story-category">Budget</div>
                            <h5 class="story-title">How to Travel Europe on a Student Budget</h5>
                            <p class="story-excerpt flex-grow-1">Insider tips and tricks for exploring Europe without breaking the bank. Hostels, trains, and free attractions.</p>
                            <div class="story-meta d-flex justify-content-between">
                                <span><i class="bi bi-calendar me-1"></i>Feb 5, 2026</span>
                                <span><i class="bi bi-clock me-1"></i>6 min read</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="footer-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <span class="blue-text">blue.</span>airportal.lv
                    </div>
                    <p class="footer-desc">Your trusted travel companion for discovering amazing destinations worldwide. Book flights, hotels, and experiences all in one place.</p>
                    <div class="footer-social">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-title">Company</h6>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-title">Support</h6>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Safety</a></li>
                        <li><a href="#">Cancellation</a></li>
                        <li><a href="#">COVID-19</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-title">Newsletter</h6>
                    <p class="footer-desc">Subscribe to get special offers and travel deals delivered to your inbox.</p>
                    <input type="email" class="newsletter-input" placeholder="Enter your email">
                    <button class="btn-newsletter">Subscribe <i class="bi bi-send ms-1"></i></button>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p>&copy; 2026 blue.airportal.lv. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p>
                            <a href="#" class="text-decoration-none" style="color: #64748b; margin-right: 16px;">Privacy Policy</a>
                            <a href="#" class="text-decoration-none" style="color: #64748b; margin-right: 16px;">Terms of Service</a>
                            <a href="#" class="text-decoration-none" style="color: #64748b;">Cookies</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Filter tab interaction
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
