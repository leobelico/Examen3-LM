<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\VehiculoExportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $userType = auth()->user()->tipo; 
        if ($userType == 1) {
            return view('dashboard');
        } elseif ($userType == 2) {
            return view('dashboardBEC');
        } elseif ($userType == 3) {
            return view('dashboardCLIENTE');
        } else {
            
        }
    })->name('dashboard');
    
    Route::get('/dashboardBEC', function () {
        return view('dashboardBEC');
    })->name('dashboardBEC');
    
    Route::get('/dashboardCLIENTE', function () {
        return view('dashboardCLIENTE');
    })->name('dashboardCLIENTE');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/vehiculos', [VehiculoController::class, 'create'])->name('vehiculos.create');
Route::get('/vehiculos/create', [VehiculoController::class, 'create'])->name('vehiculos.create');
Route::post('/vehiculos', [VehiculoController::class, 'store'])->name('vehiculos.store');


Route::get('/vehiculos/{id}/edit', [VehiculoController::class, 'edit'])->name('vehiculos.edit');
Route::put('/vehiculos/{id}', [VehiculoController::class, 'update'])->name('vehiculos.update');
Route::delete('/vehiculos/{id}', [VehiculoController::class, 'destroy'])->name('vehiculos.destroy');


Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
Route::get('/vermisproductos', [VehiculoController::class, 'showMyProducts'])->name('vehiculos.showmyproducts');
Route::get('/importar-vehiculos', [VehiculoController::class, 'mostrarFormularioImportar']);
Route::post('/importar-vehiculos', [VehiculoController::class, 'importar'])->name('importar-vehiculos');
Route::get('/dashboard/importar-vehiculos', [VehiculoController::class, 'mostrarFormularioImportar']);
Route::get('/ver-vehiculos', [VehiculoController::class, 'mostrarVehiculos'])->name('ver-vehiculos');
Route::get('/compra-vehiculo', [VehiculoController::class, 'mostrarComprarVehiculo'])->name('compra-vehiculo');
Route::get('/vehiculos-bec', [VehiculoController::class, 'vehiculosbec'])->name('vehiculos-bec');
Route::get('/confirmar-vehiculo', [VehiculoController::class, 'mostrarConfirmarVehiculo'])->name('confirmar-vehiculo');
Route::put('/confirmar-vehiculos/{id}', [VehiculoController::class, 'confirmarvehiculo'])->name('confirmar-vehiculos');

Route::get('/exportar-vehiculos', [VehiculoExportController::class, 'exportar'])->name('exportar-vehiculos');
Route::put('/comprar-vehiculo/{id}', [VehiculoController::class, 'comprarVehiculo'])->name('comprar-vehiculo');


Route::get('/subir-imagen/{id}', [VehiculoController::class, 'showForm'])->name('vehiculos.subir-imagen');
Route::post('/subir-imagen/{id}', [VehiculoController::class, 'agregar'])->name('vehiculos.agregar');
require __DIR__.'/auth.php';
