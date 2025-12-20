<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Accepted</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #F9F9F7; padding: 30px; border-radius: 10px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="https://postimg.cc/nX6kTw60" alt="Restaurant Logo" style="max-width: 180px; height: auto;">
        </div>
        <h1 style="color: #27ae60; text-align: center; margin-bottom: 30px;">Reservation Confirmed!</h1>
        
        <p>Dear {{ $reservation->name }},</p>
        
        <p>Great news! Your reservation has been <strong style="color: #27ae60;">confirmed</strong>. We're looking forward to serving you!</p>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h2 style="color: #2C2F24; margin-top: 0;">Reservation Details:</h2>
            <p><strong>Reservation Code:</strong> <span style="font-size: 18px; color: #AD343E; font-weight: bold;">{{ $reservation->reservation_code }}</span></p>
            <p><strong>Date:</strong> {{ $reservation->date->format('F d, Y') }}</p>
            <p><strong>Time:</strong> {{ $reservation->time }}</p>
            <p><strong>Number of Persons:</strong> {{ $reservation->persons }}</p>
            <p><strong>Status:</strong> <span style="color: #27ae60; font-weight: bold;">Confirmed</span></p>
        </div>

        <div style="background: #e8f5e9; padding: 20px; border-radius: 8px; margin: 20px 0; text-align: center;">
            <h3 style="color: #2C2F24; margin-top: 0;">Your QR Code</h3>
            <p style="margin-bottom: 15px;">Please present this QR code when you arrive:</p>
            <div style="background: white; padding: 20px; display: inline-block; border-radius: 8px;">
                <img src="{{ $qrCodeUrl }}" alt="QR Code for {{ $reservation->reservation_code }}" style="max-width: 200px; width: 200px; height: 200px; display: block; margin: 0 auto;">
            </div>
            <p style="margin-top: 15px; font-size: 14px; color: #666;">Reservation Code: <strong>{{ $reservation->reservation_code }}</strong></p>
        </div>

        <p style="margin-top: 30px;">We look forward to seeing you!</p>
        
        <p>Best regards,<br>
        <strong>Restaurant Menu Team</strong></p>
    </div>
</body>
</html>
