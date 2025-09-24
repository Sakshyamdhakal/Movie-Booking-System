<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f9;
            padding: 30px;
            margin: 0;
        }
        .ticket-wrapper {
            display: flex;
            max-width: 700px;
            margin: 0 auto;
            border: 2px dashed #ccc;
            border-radius: 16px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .ticket-main {
            flex: 3;
            padding: 25px;
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            position: relative;
        }
        .ticket-main h1 {
            font-size: 22px;
            margin: 0 0 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .ticket-details {
            background: rgba(255,255,255,0.15);
            padding: 15px;
            border-radius: 10px;
        }
        .ticket-details p {
            margin: 6px 0;
            font-size: 14px;
        }
        .ticket-footer {
            margin-top: 20px;
            font-size: 12px;
            opacity: 0.85;
        }
        .ticket-stub {
            flex: 1;
            padding: 20px;
            background: #ecf0f1;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-left: 2px dashed #bbb;
        }
        .stub-id {
            font-size: 12px;
            margin-bottom: 15px;
            color: #333;
        }
        .qr-code img {
            max-width: 100%;
            height: auto;
        }
        .perforation {
            position: absolute;
            right: -12px;
            top: 0;
            bottom: 0;
            width: 24px;
            background: #f4f4f9;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 6px 0;
        }
        .circle {
            width: 24px;
            height: 24px;
            background: #f4f4f9;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="ticket-wrapper">
        <!-- Main Ticket -->
        <div class="ticket-main">
            <h1>{{ $booking->movie ?? 'Unknown Movie' }}</h1>
            <div class="ticket-details">
                <p><strong>Date & Time:</strong> {{ now()->format('d M Y, h:i A') }}</p>
                <p><strong>Hall:</strong> {{ $booking->hall ?? 'Main Hall' }}</p>
                <p><strong>Seats:</strong>
                    @if(is_array($booking->seats))
                       {{ implode(', ', $booking->seats) }}
                    @elseif($booking->seats instanceof \Illuminate\Support\Collection)
                       {{ $booking->seats->implode(', ') }}
                    @elseif(isset($booking->seat_count))
                       {{ $booking->seat_count }} seats
                    @else
                       {{ $booking->seats ?? 'N/A' }}
                    @endif
                </p>

                <p><strong>Booked By:</strong> {{ $booking->name ?? 'N/A' }}</p>
            </div>
            <div class="ticket-footer">
                Booking Confirmed! Please arrive 15 minutes early.  
                Show this ticket at entry.
            </div>
            <!-- Perforation circles -->
            <div class="perforation">
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
        </div>

        <!-- Ticket Stub -->
        <div class="ticket-stub">
            <div class="stub-id">Booking ID: #{{ $booking->id ?? 'N/A' }}</div>
            <div class="qr-code">
                <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
            </div>
            <div style="font-size: 10px; margin-top: 15px; color: #555;">
                {{ now()->format('d M Y, h:i A') }}
            </div>
        </div>
    </div>
</body>
</html>
