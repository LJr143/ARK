<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder Notification</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
        }
        .header h1 {
            color: #2d3748;
            margin: 0;
            font-size: 24px;
        }
        .reminder-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
            color: #4a5568;
        }
        .reminder-details {
            background: #f7fafc;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .reminder-title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
            margin: 0 0 15px 0;
        }
        .detail-row {
            display: flex;
            margin-bottom: 10px;
            align-items: flex-start;
        }
        .detail-label {
            font-weight: 600;
            color: #4a5568;
            min-width: 100px;
            margin-right: 10px;
        }
        .detail-value {
            color: #2d3748;
            flex: 1;
        }
        .description {
            background: white;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
            margin: 15px 0;
        }
        .attachments {
            margin: 20px 0;
        }
        .attachment-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            margin-bottom: 8px;
        }
        .attachment-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            color: #667eea;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #718096;
            font-size: 14px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
        }
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .container {
                padding: 20px;
            }
            .detail-row {
                flex-direction: column;
            }
            .detail-label {
                min-width: auto;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="reminder-icon">📅</div>
        <h1>Reminder Notification</h1>
    </div>

    <div class="greeting">
        Hello {{ $recipientName }},
    </div>

    <p>You have a reminder scheduled. Here are the details:</p>

    <div class="reminder-details">
        <h2 class="reminder-title">{{ $reminderTitle }}</h2>

        <div class="detail-row">
            <span class="detail-label">Date & Time:</span>
            <span class="detail-value">{{ $startDateTime }}</span>
        </div>

        @if($endDateTime)
            <div class="detail-row">
                <span class="detail-label">End Time:</span>
                <span class="detail-value">{{ $endDateTime }}</span>
            </div>
        @endif

        @if($location)
            <div class="detail-row">
                <span class="detail-label">Location:</span>
                <span class="detail-value">{{ $location }}</span>
            </div>
        @endif

        <div class="detail-row">
            <span class="detail-label">Category:</span>
            <span class="detail-value">{{ $category }}</span>
        </div>
    </div>

    @if($reminderDescription)
        <div class="description">
            <strong>Description:</strong><br>
            {{ $reminderDescription }}
        </div>
    @endif

    @if($attachments && $attachments->count() > 0)
        <div class="attachments">
            <strong>Attachments:</strong>
            @foreach($attachments as $attachment)
                <div class="attachment-item">
                    <div class="attachment-icon">📎</div>
                    <span>{{ $attachment->original_name }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <div style="text-align: center;">
        <a href="{{ config('app.url') }}" class="cta-button">View in App</a>
    </div>

    <div class="footer">
        <p>This is an automated reminder notification.</p>
        <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</div>
</body>
</html>
