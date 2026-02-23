<?php

use App\Http\Controllers\FigmaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('vacation.index'))->name('home');
Route::get('/figma', [FigmaController::class, 'index'])->name('figma.index');
Route::post('/figma/token', [FigmaController::class, 'saveToken'])->name('figma.save-token');
Route::post('/figma/fetch', [FigmaController::class, 'fetchFile'])->name('figma.fetch');
Route::post('/figma/convert', [FigmaController::class, 'convert'])->name('figma.convert');
Route::post('/figma/download', [FigmaController::class, 'download'])->name('figma.download');
