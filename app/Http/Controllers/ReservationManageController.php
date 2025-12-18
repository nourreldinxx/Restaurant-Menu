<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationManageController extends Controller
{
    public function show($code)
    {
        $reservation = Reservation::where('reservation_code', $code)->firstOrFail();
        
        return view('reservation-manage', compact('reservation'));
    }

    public function update(Request $request, $code)
    {
        $reservation = Reservation::where('reservation_code', $code)->firstOrFail();
        
        // Only allow updates if status is pending
        if ($reservation->status !== 'pending') {
            return redirect()->back()->with('error', 'This reservation cannot be modified. Only pending reservations can be updated.');
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'persons' => 'required|integer|min:1',
        ]);

        $reservation->update($validated);

        return redirect()->back()->with('success', 'Reservation updated successfully!');
    }

    public function cancel(Request $request, $code)
    {
        $reservation = Reservation::where('reservation_code', $code)->firstOrFail();
        
        // Only allow cancellation if status is pending
        if ($reservation->status !== 'pending') {
            return redirect()->back()->with('error', 'This reservation cannot be cancelled. Only pending reservations can be cancelled.');
        }

        $reservation->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Reservation cancelled successfully.');
    }
}
