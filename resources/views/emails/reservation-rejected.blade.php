<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Update</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #F9F9F7; padding: 30px; border-radius: 10px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="https://i.ibb.co/JjHQQ4Pm/mainlogo.png" alt="Restaurant Logo" style="max-width: 180px; height: auto;">
        </div>
        <h1 style="color: #AD343E; text-align: center; margin-bottom: 30px;">Reservation Update</h1>
        
        <p>Dear {{ $reservation->name }},</p>
        
        <p>We regret to inform you that we are unable to accommodate your reservation request for the selected date and time.</p>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h2 style="color: #2C2F24; margin-top: 0;">Reservation Details:</h2>
            <p><strong>Reservation Code:</strong> {{ $reservation->reservation_code }}</p>
            <p><strong>Date:</strong> {{ $reservation->date->format('F d, Y') }}</p>
            <p><strong>Time:</strong> {{ $reservation->time }}</p>
            <p><strong>Number of Persons:</strong> {{ $reservation->persons }}</p>
        </div>

        @if($reservation->notes)
        <div style="background: #ffe6e6; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0;"><strong>Note:</strong> {{ $reservation->notes }}</p>
        </div>
        @endif

        <div style="background: #e3f2fd; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0;"><strong>We'd love to have you!</strong></p>
            <p style="margin: 10px 0 0 0;">Please feel free to make a new reservation for a different date or time. We're here to serve you!</p>
        </div>
        
        <p style="margin-top: 30px;">We apologize for any inconvenience and hope to see you soon!</p>
        
        <p>Best regards,<br>
        <strong>Restaurant Menu Team</strong></p>
    </div>
</body>
</html>
