<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAP Application Status</title>
    <style type="text/css">
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #1a365d;
            padding: 32px 20px;
            text-align: center;
            border-bottom: 4px solid #e53e3e;
        }

        .logo {
            height: 70px;
            width: auto;
        }

        .content {
            padding: 32px;
        }

        h1 {
            color: #1a365d;
            font-size: 24px;
            margin-top: 0;
        }

        .status-box {
            background-color: #fff5f5;
            border-left: 4px solid #e53e3e;
            padding: 16px;
            margin: 24px 0;
            border-radius: 0 4px 4px 0;
        }

        .footer {
            padding: 24px;
            text-align: center;
            font-size: 12px;
            color: #718096;
            background-color: #f7fafc;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <img class="logo" src="{{ url('storage/logo/UAP-Fort-Bonifacio-Chapter-Logo%201.png') }}" alt="UAP Logo">
    </div>

    <div class="content">
        <h1>Application Status Update</h1>

        <p>Dear {{ $name }},</p>

        <div class="status-box">
            <p>We regret to inform you that your membership application submitted on {{ $date }} has not been
                approved.</p>
            <p>The review committee has determined that your application did not meet our current membership
                requirements.</p>
        </div>

        <p>Your account and all associated data have been removed from our systems in accordance with our privacy
            policy.</p>

        <p>If you believe this decision was made in error, or if you would like more information about our membership
            criteria, please contact our membership committee:</p>

        <p>
            <strong>Email:</strong> <a href="mailto:membership@uap.org.ph">membership@uap.org.ph</a><br>
            <strong>Phone:</strong> (02) 1234-5678
        </p>

        <p>We appreciate your interest in joining the United Architects of the Philippines and encourage you to review
            our membership guidelines for future applications.</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} United Architects of the Philippines</p>
        <p>53 Scout Rallos Street, Quezon City, Philippines</p>
    </div>
</div>
</body>
</html>
