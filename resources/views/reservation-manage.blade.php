<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Reservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
          rel="stylesheet">
</head>
<body>
@include('components.topbar')
@include('components.header')
<main>
    <div class="booking-back" style="padding-bottom: 80px;">
        <h1>Manage Your Reservation</h1>
        <p>Reservation Code: <strong>{{ $reservation->reservation_code }}</strong></p>
    </div>
    
    <div style="max-width: 800px; margin: 20px auto; padding: 0 20px;">
        @if(session('success'))
            <div style="background: #4CAF50; color: white; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div style="background: #f44336; color: white; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                {{ session('error') }}
            </div>
        @endif

        <div style="background: white; padding: 40px; border-radius: 25px; box-shadow: 0 -1px 4px 1px #DBDFD0;">
            <div style="margin-bottom: 30px;">
                <h2 style="color: #2C2F24; margin-bottom: 20px;">Reservation Details</h2>
                <p><strong>Name:</strong> {{ $reservation->name }}</p>
                <p><strong>Email:</strong> {{ $reservation->email }}</p>
                <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
                <p><strong>Status:</strong> 
                    <span style="padding: 5px 15px; border-radius: 20px; font-size: 14px;
                        @if($reservation->status === 'confirmed') background: #e8f5e9; color: #27ae60;
                        @elseif($reservation->status === 'pending') background: #fff3cd; color: #f39c12;
                        @else background: #ffebee; color: #e74c3c;
                        @endif">
                        {{ ucfirst($reservation->status) }}
                    </span>
                </p>
            </div>

            @if($reservation->status === 'pending')
            <form method="POST" action="{{ route('reservation.update', $reservation->reservation_code) }}" style="margin-bottom: 30px;">
                @csrf
                <h3 style="color: #2C2F24; margin-bottom: 20px;">Update Reservation</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label for="date" style="display: block; margin-bottom: 8px; color: #2C2F24;">Date</label>
                        <input type="date" id="date" name="date" value="{{ $reservation->date->format('Y-m-d') }}" required
                               style="width: 100%; padding: 12px; border: 2px solid #DBDFD0; border-radius: 8px;">
                    </div>
                    <div>
                        <label for="time" style="display: block; margin-bottom: 8px; color: #2C2F24;">Time</label>
                        <input type="text" id="time" name="time" value="{{ $reservation->time }}" required
                               style="width: 100%; padding: 12px; border: 2px solid #DBDFD0; border-radius: 8px;">
                    </div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="persons" style="display: block; margin-bottom: 8px; color: #2C2F24;">Number of Persons</label>
                    <input type="number" id="persons" name="persons" value="{{ $reservation->persons }}" min="1" required
                           style="width: 100%; padding: 12px; border: 2px solid #DBDFD0; border-radius: 8px;">
                </div>
                
                <button type="submit" style="background: #AD343E; color: white; padding: 12px 30px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px;">
                    Update Reservation
                </button>
            </form>

            <form method="POST" action="{{ route('reservation.cancel', $reservation->reservation_code) }}" 
                  onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                @csrf
                <button type="submit" style="background: #e74c3c; color: white; padding: 12px 30px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px;">
                    Cancel Reservation
                </button>
            </form>
            @elseif($reservation->status === 'confirmed')
            <div style="background: #e8f5e9; padding: 20px; border-radius: 8px; color: #27ae60;">
                <p style="margin: 0;"><strong>Reservation Confirmed</strong></p>
                <p style="margin: 10px 0 0 0;">Your reservation has been confirmed and cannot be modified. Please contact us if you need to make any changes.</p>
            </div>
            @else
            <div style="background: #ffebee; padding: 20px; border-radius: 8px; color: #c62828;">
                <p>This reservation has been cancelled and cannot be modified.</p>
            </div>
            @endif
        </div>
    </div>
</main>
@include('components.footer')
</body>
</html>
