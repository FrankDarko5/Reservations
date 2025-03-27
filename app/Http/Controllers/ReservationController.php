<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // Obtener todas las reservas
    public function index()
    {
        return response()->json(Reservation::all(), 200);
    }

    // Crear una nueva reserva
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'event_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'status' => 'string|in:pending,confirmed,canceled'
        ]);

        $reservation = Reservation::create($request->all());

        return response()->json($reservation, 201);
    }

    // Mostrar una reserva específica
    public function show($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }
        return response()->json($reservation, 200);
    }

    // Actualizar una reserva
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        $request->validate([
            'quantity' => 'integer|min:1',
            'status' => 'string|in:pending,confirmed,canceled'
        ]);

        $reservation->update($request->all());

        return response()->json($reservation, 200);
    }

    // Eliminar una reserva
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => 'Reserva eliminada'], 200);
    }
}
