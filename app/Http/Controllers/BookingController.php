<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Mail\ReservationConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'date' => 'required|date',
            'time' => 'required|string',
            'persons' => 'required|integer|min:1',
        ]);

        // Generate unique reservation code
        $reservationCode = 'RES-' . strtoupper(Str::random(8));

        $reservation = Reservation::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'persons' => $validated['persons'],
            'status' => 'pending',
            'reservation_code' => $reservationCode,
        ]);

        // Send confirmation email
        try {
            Mail::to($reservation->email)->send(new ReservationConfirmation($reservation));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send confirmation email: ' . $e->getMessage());
        }

        return redirect()->route('booking')->with('success', 'Your table reservation has been submitted successfully! Check your email for confirmation.');
    }
}
