<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\FrontController::class, 'index'])->name('index');
Route::get('/clear-table', [\App\Http\Controllers\FrontController::class, 'clearTable'])->name('clear_table');
Route::get('/requests', [\App\Http\Controllers\FrontController::class, 'requestsInfo'])->name('requests_info');


/* Transfer - import\export */
Route::prefix('transfer')->name('transfer.')->middleware(['saveRequest', 'updateRequest'])->group( function () {

    // for IDE to navigate through
    $baseController = \App\Http\Controllers\Transfer\BaseController::class;

    $waysToTransfer = [
        'Php',
        'Laravel',
        'Spatie'
    ];

    foreach ($waysToTransfer as $way) {
        $lowercase = strtolower($way);

        Route::get("{$lowercase}/export", ["\App\Http\Controllers\Transfer\\{$way}Controller", 'export'])->name("{$lowercase}.export");
        Route::post("{$lowercase}/import", ["\App\Http\Controllers\Transfer\\{$way}Controller", 'import'])->name("{$lowercase}.import");
    }
});
