<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #F9F9F7; padding: 30px; border-radius: 10px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="https://i.postimg.cc/433SfDwk/mainlogo.png" alt="Restaurant Logo" style="max-width: 180px; height: auto;">
        </div>
        <h1 style="color: #AD343E; text-align: center; margin-bottom: 30px;">Reservation Confirmation</h1>
        
        <p>Dear {{ $reservation->name }},</p>
        
        <p>Thank you for your reservation request! We have received your booking and it is currently <strong>pending approval</strong>.</p>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h2 style="color: #2C2F24; margin-top: 0;">Reservation Details:</h2>
            <p><strong>Reservation Code:</strong> {{ $reservation->reservation_code }}</p>
            <p><strong>Date:</strong> {{ $reservation->date->format('F d, Y') }}</p>
            <p><strong>Time:</strong> {{ $reservation->time }}</p>
            <p><strong>Number of Persons:</strong> {{ $reservation->persons }}</p>
            <p><strong>Status:</strong> <span style="color: #f39c12;">Pending</span></p>
        </div>
        
        <p>We will review your reservation and notify you via email once it has been confirmed or if we need any additional information.</p>

        <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0 0 10px 0;"><strong>Manage Your Reservation:</strong> You can view, modify, or cancel your reservation using the link below:</p>
            <a href="{{ config('app.url') . route('reservation.manage', ['code' => $reservation->reservation_code], false) }}" 
               style="color: #AD343E; text-decoration: none; font-weight: bold; display: inline-block; padding: 10px 20px; background: white; border-radius: 5px;">
                Manage My Reservation
            </a>
        </div>
        
        <p style="margin-top: 30px;">Best regards,<br>
        <strong>Restaurant Menu Team</strong></p>
    </div>
</body>
</html>
