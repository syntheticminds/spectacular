<?php

use App\Http\Controllers\ExportController;
use App\Http\Middleware\TidyHtml;
use Illuminate\Support\Facades\Route;

Route::controller(ExportController::class)->group(function () {
     Route::get('export/{project}/html', 'html')->name('export.html')->middleware(TidyHtml::class);
     Route::get('export/{project}/markdown', 'markdown')->name('export.markdown');
});

Route::view('/{any?}', 'app')->where('any', '.*');
