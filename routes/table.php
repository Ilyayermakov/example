<?php

use App\Http\Controllers\Table\AccountingController;
use App\Http\Controllers\Table\CombinedController;
use App\Http\Controllers\Table\DifferentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'active', 'admin']], function () {

    // Delete

    Route::delete('table.delete.client', [CombinedController::class, 'deleteClient'])->name('table.delete.client');
    Route::delete('table.delete.record', [CombinedController::class, 'deleteRecord'])->name('table.delete.record');
    Route::delete('table.delete.material', [CombinedController::class, 'deleteMaterial'])->name('table.delete.material');
    Route::delete('table.delete.procedure', [CombinedController::class, 'deleteProcedure'])->name('table.delete.procedure');
    Route::delete('table.delete.spent', [CombinedController::class, 'deleteSpent'])->name('table.delete.spent');

    // Клиенты

    Route::get('table.clients', [DifferentController::class, 'indexClients'])->name('table.clients');
    Route::post('table.store.clients', [DifferentController::class, 'storeClients'])->name('table.store.clients');
    Route::post('table.update/{id}', [DifferentController::class, 'updateClient'])->name('different.updateClient');

    // Записи
    Route::get('table', [DifferentController::class, 'indexRecordsTrue'])->name('table');
    Route::get('table.records', [DifferentController::class, 'indexRecords'])->name('table.records');
    Route::post('table.update', [DifferentController::class, 'update'])->name('table.update');
    Route::post('table.record.comment', [DifferentController::class, 'updateRecordComment'])->name('table.record.comment');
    Route::post('table.store.records', [DifferentController::class, 'storeRecords'])->name('table.store.records');
    Route::post('table.update.records', [DifferentController::class, 'updateRecords'])->name('table.update.records');

    // Бухгалтерия
    Route::get('table.accounting', [DifferentController::class, 'indexAccounting'])->name('table.accounting');

    // Материалы
    Route::get('table.materials', [DifferentController::class, 'indexMaterials'])->name('table.materials');
    Route::post('table.store.materials', [DifferentController::class, 'storeMaterials'])->name('table.store.materials');
    Route::post('/update/{id}', [DifferentController::class, 'updateMaterials'])->name('different.updateMaterials');

    // Процедуры
    Route::get('table.procedures', [DifferentController::class, 'indexProcedures'])->name('table.procedures');
    Route::post('table.store.procedures', [DifferentController::class, 'storeProcedures'])->name('table.store.procedures');
    Route::post('/update-procedures/{id}', [DifferentController::class, 'updateProcedures'])->name('different.updateProcedures');

    // JOB PHOTOS
    Route::post('home.store', [DifferentController::class, 'storeJob'])->name('home.store');
    Route::delete('home.delete', [DifferentController::class, 'deleteJob'])->name('home.delete');

    
});
