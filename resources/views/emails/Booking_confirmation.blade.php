<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Ticket Confirmation</title>
    <style>
        .email-container {
            background: linear-gradient(135deg, #1f2937 0%, #111827 50%, #000000 100%);
            min-height: 100vh;
            padding: 20px;
            font-family: 'Arial', sans-serif;
        }
        .ticket-card {
            background: #000000;
            border: 2px solid #374151;
            border-radius: 20px;
            max-width: 600px;
            margin: 0 auto;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .ticket-header {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            padding: 30px;
            text-align: center;
            position: relative;
        }
        .ticket-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.3;
        }
        .ticket-header h1 {
            color: #000000;
            font-size: 28px;
            font-weight: bold;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        .ticket-header .subtitle {
            color: #000000;
            font-size: 16px;
            margin-top: 8px;
            opacity: 0.8;
            position: relative;
            z-index: 1;
        }
        .ticket-body {
            padding: 40px 30px;
            color: white;
        }
        .movie-info {
            background: #1f2937;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 4px solid #fbbf24;
        }
        .movie-title {
            color: #fbbf24;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .movie-title::before {
            content: '🎬';
            margin-right: 10px;
            font-size: 20px;
        }
        .booking-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        .detail-item {
            background: #374151;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #4b5563;
        }
        .detail-label {
            color: #9ca3af;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .detail-value {
            color: #fbbf24;
            font-size: 16px;
            font-weight: 600;
        }
        .seats-info {
            grid-column: span 2;
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            border: 1px solid #fbbf24;
        }
        .seats-number {
            font-size: 36px;
            font-weight: bold;
            color: #fbbf24;
            margin-bottom: 5px;
        }
        .ticket-footer {
            background: #111827;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #374151;
        }
        .success-message {
            color: #10b981;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .booking-id {
            color: #6b7280;
            font-size: 14px;
            font-family: monospace;
        }
        .perforation {
            height: 20px;
            background: repeating-linear-gradient(
                90deg,
                #374151 0px,
                #374151 10px,
                transparent 10px,
                transparent 20px
            );
            margin: 20px 0;
            border-radius: 10px;
        }
        @media (max-width: 600px) {
            .booking-details {
                grid-template-columns: 1fr;
            }
            .seats-info {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="ticket-card">
            <!-- Ticket Header -->
            <div class="ticket-header">
                <h1>🎫 Movie Ticket Confirmation</h1>
                <div class="subtitle">Your booking has been confirmed!</div>
            </div>

            <!-- Decorative Perforation -->
            <div class="perforation"></div>

            <!-- Ticket Body -->
            <div class="ticket-body">
                <!-- Movie Information -->
                <div class="movie-info">
                    <div class="movie-title">{{ $booking->movie }}</div>
                </div>

                <!-- Booking Details Grid -->
                <div class="booking-details">
                    <div class="detail-item">
                        <div class="detail-label">Customer Name</div>
                        <div class="detail-value">{{ $booking->name }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Email Address</div>
                        <div class="detail-value">{{ $booking->email }}</div>
                    </div>

                    <div class="seats-info">
                        <div class="detail-label">Number of Seats</div>
                        <div class="seats-number">{{ $booking->seats }}</div>
                        <div class="detail-value">Reserved Seat{{ $booking->seats > 1 ? 's' : '' }}</div>
                    </div>
                </div>
            </div>

            <!-- Ticket Footer -->
            <div class="ticket-footer">
                <div class="success-message">✅ Booking Confirmed Successfully!</div>
                <div class="booking-id">Booking ID: #{{ $booking->id }}</div>
                <div style="color: #6b7280; font-size: 12px; margin-top: 10px;">
                    Please arrive 15 minutes before showtime. Show this email at the theater entrance.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
