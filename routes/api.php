<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::prefix('reservations')->group(function () {
    Route::get('/', [ReservationController::class, 'index']); // Listar reservas
    Route::post('/', [ReservationController::class, 'store']); // Crear reserva
    Route::get('/{id}', [ReservationController::class, 'show']); // Obtener reserva
    Route::put('/{id}', [ReservationController::class, 'update']); // Actualizar reserva
    Route::delete('/{id}', [ReservationController::class, 'destroy']); // Eliminar reserva
});

