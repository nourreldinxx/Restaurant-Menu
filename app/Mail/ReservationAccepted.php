<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation Accepted - ' . $this->reservation->reservation_code,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Generate QR code URL
        $manageUrl = config('app.url') . route('reservation.manage', ['code' => $this->reservation->reservation_code], false);
        
        // Generate QR code as PNG base64
        try {
            $qrCodeImage = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)
                ->format('png')
                ->errorCorrection('H')
                ->generate($manageUrl);
            
            $qrCodeBase64 = base64_encode($qrCodeImage);
        } catch (\Exception $e) {
            \Log::error('Failed to generate QR code: ' . $e->getMessage());
            $qrCodeBase64 = null;
        }

        return new Content(
            view: 'emails.reservation-accepted',
            with: [
                'qrCode' => $qrCodeBase64,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
