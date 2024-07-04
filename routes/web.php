<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrainerClientController;
use App\Http\Controllers\ServiceNoteController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'dashboard/admin', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [ClientController::class, 'index'])->name('admin.users.index');
        Route::get('/add-users', [ClientController::class, 'create'])->name('admin.users.create');
        Route::post('/add-users', [ClientController::class, 'store'])->name('admin.users.store');
        Route::get('/subscriptions', [ClientController::class, 'subscription'])->name('admin.users.subscription');
        Route::get('/expiring', [ClientController::class, 'expiringPOS'])->name('admin.users.expiring');
        Route::get('/add-subscriptions', [ClientController::class, 'addsubscription'])->name('admin.users.subscription.add');
        Route::post('/add-subscriptions', [ClientController::class, 'storesubscription'])->name('admin.users.subscription.store');
        Route::get('/edit-users', [ClientController::class, 'edit'])->name('admin.users.edit');
        Route::post('/edit-users', [ClientController::class, 'update'])->name('admin.users.update');
        Route::post('/delete-users', [ClientController::class, 'destroy'])->name('admin.users.destroy');

    });

    Route::group(['prefix' => 'administrators'], function(){
        Route::get('/', [AdminController::class, 'index'])->name('admin.administrators.index');
        Route::get('/add-administrators', [AdminController::class, 'create'])->name('admin.administrators.create');
        Route::post('/add-administrators', [AdminController::class, 'store'])->name('admin.administrators.store');
        Route::get('/edit-administrators', [AdminController::class, 'edit'])->name('admin.administrators.edit');
        Route::post('/edit-administrators', [AdminController::class, 'update'])->name('admin.administrators.update');
        Route::post('/delete-administrators', [AdminController::class, 'destroy'])->name('admin.administrators.destroy');
    });

    Route::group(['prefix' => 'trainer'], function(){
        Route::get('/', [TrainingController::class, 'index'])->name('admin.trainer.index');
        Route::get('/assign-trainer', [TrainingController::class, 'assign'])->name('admin.trainer.assign');
        Route::post('/assign-trainer', [TrainingController::class, 'assign_store'])->name('admin.trainer.assign.store');
        Route::get('/add-trainer', [TrainingController::class, 'create'])->name('admin.trainer.create');
        Route::post('/add-trainer', [TrainingController::class, 'store'])->name('admin.trainer.store');
        Route::get('/edit-trainer', [TrainingController::class, 'edit'])->name('admin.trainer.edit');
        Route::post('/edit-trainer', [TrainingController::class, 'update'])->name('admin.trainer.update');
        Route::post('/delete-trainer', [TrainingController::class, 'destroy'])->name('admin.trainer.destroy');
    });

    Route::group(['prefix' => 'service'], function(){
        Route::get('/', [ServiceController::class, 'index'])->name('admin.service.index');
        Route::get('/add-service', [ServiceController::class, 'create'])->name('admin.service.create');
        Route::post('/add-service', [ServiceController::class, 'store'])->name('admin.service.store');
        Route::get('/edit-service', [ServiceController::class, 'edit'])->name('admin.service.edit');
        Route::post('/edit-service', [ServiceController::class, 'update'])->name('admin.service.update');
        Route::post('/delete-service', [ServiceController::class, 'destroy'])->name('admin.service.destroy');
        Route::get('/options', [ServiceController::class, 'option'])->name('admin.service.option');
        Route::get('/options/create', [ServiceController::class, 'option_create'])->name('admin.service.option.create');
        Route::post('/options/store', [ServiceController::class, 'option_store'])->name('admin.service.option.store');
        Route::get('/edit-options', [ServiceController::class, 'option_edit'])->name('admin.service.option.edit');
        Route::post('/edit-options', [ServiceController::class, 'option_update'])->name('admin.service.option.update');
        Route::post('/delete-options', [ServiceController::class, 'option_destroy'])->name('admin.service.option.destroy');
    });

    Route::group(['prefix' => 'analytics'], function(){
        Route::get('/get-monthly-attendance', [ServiceController::class, 'pre_calender'])->name('admin.analytics.monthly');
        Route::post('/get-monthly-attendance', [ServiceController::class, 'calender'])->name('admin.analytics.monthly.get');
        Route::get('/get-today-servicenotes', [ServiceController::class, 'todayServiceNotes'])->name('admin.analytics.servicenote.today');
        Route::get('/get-servicenotes-list', [ServiceController::class, 'servicenotelist'])->name('admin.analytics.servicenote.list');
        Route::get('/get-servicenote', [ServiceController::class, 'servicenote'])->name('admin.analytics.servicenote');

    });
});

Route::group(['prefix' => 'dashboard/trainer', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'clients'], function(){
        Route::get('/', [TrainerClientController::class, 'index'])->name('trainer.clients.index');
    });

    Route::group(['prefix' => 'services'], function(){
        Route::get('/note', [ServiceNoteController::class, 'note'])->name('trainer.services.note');
        Route::post('/note', [ServiceNoteController::class, 'note_create'])->name('trainer.services.note.create');
    });
});

Route::group(['prefix' => 'dashboard/user', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'trainer'], function(){
        Route::get('/', [TrainerController::class, 'index'])->name('');
    });


});

Route::group(['middleware' => ['role:super-admin|admin']], function() {

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);


});

require __DIR__.'/auth.php';
