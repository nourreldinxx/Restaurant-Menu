<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required|string',
            'persons' => 'required|integer|min:1',
        ]);

        Reservation::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'persons' => $validated['persons'],
            'status' => 'pending',
        ]);

        return redirect()->route('booking')->with('success', 'Your table reservation has been submitted successfully!');
    }
}
