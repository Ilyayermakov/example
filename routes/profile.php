<?php

use App\Http\Controllers\table\CombinedController;
use App\Http\Controllers\Table\ProcedureController;
use App\Http\Controllers\Table\ProfileController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'active', 'admin']], function () {

Route::get('table.profile/{profile_id}', [ProfileController::class, 'indexProfile'])->name('table.profile.client');
Route::post('table.profile.index/{profile_id}', [CombinedController::class, 'updateClientProfile'])->name('combined.updateClientProfile');


Route::post('table.profile.record/{profile_id}', [CombinedController::class, 'storeRecordProfile'])->name('combined.storeRecordProfile');


Route::post('table.profile.storeMaterial', [CombinedController::class, 'storeMaterial'])->name('table.profile.storeMaterial');

Route::post('table.profile.storeSpent/{profile_id}', [CombinedController::class, 'storeSpent'])->name('table.profile.storeSpent');

Route::delete('table.profile.delete.record', [CombinedController::class, 'deleteRecord'])->name('table.profile.delete.record');

Route::delete('table.profile.delete.spent', [CombinedController::class, 'deleteSpent'])->name('table.profile.delete.spent');

Route::post('table.profile.update', [CombinedController::class, 'update'])->name('table.profile.update');

Route::post('/update-material/{id}', [CombinedController::class, 'updateMaterial'])->name('combined.updateMaterial');
Route::post('/update-procedure/{id}', [CombinedController::class, 'updateProcedure'])->name('combined.updateProcedure');

});
