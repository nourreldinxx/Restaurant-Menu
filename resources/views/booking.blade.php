<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book a table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
          rel="stylesheet">
    <script src="{{ asset('assets/js/main.js') }}"></script>
</head>
<body>
@include('components.topbar')
@include('components.header')
<main>
    <div class="booking-back">
        <h1>Book A Table</h1>
        <p>We consider all the drivers of change gives you the components <br>
            you need to change to create a truly happens.</p>
    </div>
    <img class="booking-image" src="{{ asset('assets/images/table.png') }}" alt="">
    <form method="POST" action="{{ route('booking.store') }}" class="booking-container">
        @csrf
        @if(session('success'))
            <div style="background: #4CAF50; color: white; padding: 15px; margin-bottom: 20px; border-radius: 5px; flex-shrink: 0;">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="form-group">
                <label for="name">Full Name</label>
                <div class="input">
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <div class="input">
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="date">Date</label>
                <div class="input">
                    <input type="date" id="date" name="date" required>
                </div>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <div class="input">
                    <select id="time" name="time" required>
                        <option value="" disabled selected>Select Time</option>
                        <option value="03:00 PM">03:00 PM</option>
                        <option value="04:00 PM">04:00 PM</option>
                        <option value="05:00 PM">05:00 PM</option>
                        <option value="06:00 PM">06:00 PM</option>
                        <option value="07:00 PM">07:00 PM</option>
                        <option value="08:00 PM">08:00 PM</option>
                        <option value="09:00 PM">09:00 PM</option>
                        <option value="10:00 PM">10:00 PM</option>
                        <option value="11:00 PM">11:00 PM</option>
                        <option value="12:00 PM">12:00 PM</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="persons">Total Persons</label>
                <div class="input">
                    <select id="persons" name="persons" required>
                        <option value="" disabled selected>Select number of persons</option>
                        <option value="1">1 Person</option>
                        <option value="2">2 Persons</option>
                        <option value="3">3 Persons</option>
                        <option value="4">4 Persons</option>
                        <option value="5">5 Persons</option>
                        <option value="6">6 Persons</option>
                        <option value="7">7 Persons</option>
                        <option value="8">8+ Persons</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <button type="submit" class="booking-button">Book Table</button>
        </div>
    </form>
</main>
@include('components.footer')
</body>
</html>
