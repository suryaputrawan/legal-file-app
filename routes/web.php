<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IzincorporateController;
use App\Http\Controllers\IzinnakesController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth', 'rolelevel:Admin,User,Legal')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard');

    Route::prefix('template-surat')->group(function () {
        Route::get('', [TemplateController::class, 'index'])->name('template');
        Route::get('create', [TemplateController::class, 'create'])->name('template.create');
        Route::post('store', [TemplateController::class, 'store'])->name('template.store');
        Route::get('edit/{id}', [TemplateController::class, 'edit'])->name('template.edit');
        Route::put('update/{id}', [TemplateController::class, 'update'])->name('template.update');
        Route::get('{id}/download', [TemplateController::class, 'download'])->name('template.download');
    });

    Route::prefix('penerbit')->middleware('rolelevel:Admin,Legal')->group(function () {
        Route::get('', [PenerbitController::class, 'index'])->name('penerbit.index');
        Route::get('create', [PenerbitController::class, 'create'])->name('penerbit.create');
        Route::post('store', [PenerbitController::class, 'store'])->name('penerbit.store');
        Route::get('edit/{id}', [PenerbitController::class, 'edit'])->name('penerbit.edit');
        Route::post('update/{id}', [PenerbitController::class, 'update'])->name('penerbit.update');
    });

    Route::prefix('unit')->middleware('rolelevel:Admin,Legal')->group(function () {
        Route::get('', [UnitController::class, 'index'])->name('unit');
        Route::get('create', [UnitController::class, 'create'])->name('unit.create');
        Route::post('store', [UnitController::class, 'store'])->name('unit.store');
        Route::get('edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
        Route::put('update/{id}', [UnitController::class, 'update'])->name('unit.update');
    });

    Route::prefix('nakes')->middleware('rolelevel:Admin,Legal')->group(function () {
        Route::get('', [EmployeeController::class, 'index'])->name('employee');
        Route::get('create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('store', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    });

    Route::prefix('counter')->middleware('rolelevel:Admin,Legal')->group(function () {
        Route::get('', [CounterController::class, 'index'])->name('counter');
        Route::get('create', [CounterController::class, 'create'])->name('counter.create');
        Route::post('store', [CounterController::class, 'store'])->name('counter.store');
        Route::get('edit/{id}', [CounterController::class, 'edit'])->name('counter.edit');
        Route::put('update/{id}', [CounterController::class, 'update'])->name('counter.update');
    });

    Route::prefix('department')->middleware('rolelevel:Admin,Legal')->group(function () {
        Route::get('', [DepartmentController::class, 'index'])->name('department');
        Route::get('create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('store', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::put('update/{id}', [DepartmentController::class, 'update'])->name('department.update');
    });

    Route::prefix('category')->middleware('rolelevel:Admin,Legal')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('category');
        Route::get('create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('category.update');
    });

    Route::prefix('agreement')->middleware('rolelevel:Admin,Legal')->group(function () {
        Route::get('', [AgreementController::class, 'index'])->name('agreement');
        Route::get('create', [AgreementController::class, 'create'])->name('agreement.create');
        Route::post('store', [AgreementController::class, 'store'])->name('agreement.store');
        Route::get('edit/{id}', [AgreementController::class, 'edit'])->name('agreement.edit');
        Route::put('update/{id}', [AgreementController::class, 'update'])->name('agreement.update');
        Route::get('{id}/show', [AgreementController::class, 'show'])->name('agreement.show');
        Route::get('{id}/downloadImage', [AgreementController::class, 'downloadImage'])->name('agreement.downloadImage');
        Route::get('{id}/downloadFile', [AgreementController::class, 'downloadFile'])->name('agreement.downloadFile');
    });

    Route::prefix('izin-nakes')->middleware('rolelevel:Admin,Legal')->group(function () {
        Route::get('', [IzinnakesController::class, 'index'])->name('izinNakes');
        Route::get('create', [IzinnakesController::class, 'create'])->name('izinNakes.create');
        Route::post('store', [IzinnakesController::class, 'store'])->name('izinNakes.store');
        Route::get('edit/{id}', [IzinnakesController::class, 'edit'])->name('izinNakes.edit');
        Route::put('update/{id}', [IzinnakesController::class, 'update'])->name('izinNakes.update');
        Route::get('{id}/show', [IzinnakesController::class, 'show'])->name('izinNakes.show');
        Route::get('{id}/downloadImage', [IzinnakesController::class, 'downloadImage'])->name('izinNakes.downloadImage');
        Route::get('{id}/downloadFile', [IzinnakesController::class, 'downloadFile'])->name('izinNakes.downloadFile');
    });

    Route::prefix('izin-corporate')->middleware('rolelevel:Admin,Legal')->group(function () {
        Route::get('', [IzincorporateController::class, 'index'])->name('izinCorporate');
        Route::get('create', [IzincorporateController::class, 'create'])->name('izinCorporate.create');
        Route::post('store', [IzincorporateController::class, 'store'])->name('izinCorporate.store');
        Route::get('edit/{id}', [IzincorporateController::class, 'edit'])->name('izinCorporate.edit');
        Route::put('update/{id}', [IzincorporateController::class, 'update'])->name('izinCorporate.update');
        Route::get('{id}/show', [IzincorporateController::class, 'show'])->name('izinCorporate.show');
        Route::get('{id}/downloadImage', [IzincorporateController::class, 'downloadImage'])->name('izinCorporate.downloadImage');
        Route::get('{id}/downloadFile', [IzincorporateController::class, 'downloadFile'])->name('izinCorporate.downloadFile');
    });

    Route::prefix('settings')->middleware('rolelevel:Admin')->group(function () {
        Route::get('', [SettingsController::class, 'index'])->name('settings');
        Route::get('edit/{id}', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('update/{id}', [SettingsController::class, 'update'])->name('settings.update');
    });
});

require __DIR__ . '/auth.php';
