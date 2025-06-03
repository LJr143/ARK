<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAP Membership Approval</title>
    <style type="text/css">
        /* Base Styles */
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        /* Email Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        /* Header */
        .header {
            background-color: #1a365d;
            padding: 32px 20px;
            text-align: center;
            border-bottom: 4px solid #2b6cb0;
        }

        .logo {
            height: 70px;
            width: auto;
            max-width: 100%;
        }

        /* Content */
        .content {
            padding: 32px;
        }

        h1 {
            color: #1a365d;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 24px;
        }

        /* Credentials Box */
        .credentials-box {
            background-color: #f8fafc;
            border-left: 4px solid #4299e1;
            padding: 16px;
            margin: 24px 0;
            border-radius: 0 4px 4px 0;
        }

        .credentials-item {
            margin-bottom: 8px;
        }

        .label {
            font-weight: 600;
            color: #4a5568;
            display: inline-block;
            min-width: 120px;
        }

        /* Button */
        .button-container {
            text-align: center;
            margin: 32px 0;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2b6cb0;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 16px;
        }

        /* Footer */
        .footer {
            padding: 24px;
            text-align: center;
            font-size: 12px;
            color: #718096;
            background-color: #f7fafc;
            border-top: 1px solid #e2e8f0;
        }

        .footer a {
            color: #4a5568;
            text-decoration: none;
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {
            .content {
                padding: 24px;
            }

            .credentials-item {
                display: block;
            }

            .label {
                display: block;
                margin-bottom: 4px;
            }
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <!-- Using absolute URL for email clients -->
        <img class="logo" src="{{ url('storage/logo/UAP-Fort-Bonifacio-Chapter-Logo%201.png') }}"
             alt="UAP Fort Bonifacio Chapter Logo">
    </div>

    <div class="content">
        <h1>Welcome to UAP, {{ $user->first_name }}!</h1>

        <p>We're pleased to inform you that your membership application has been approved. Below are your account
            credentials:</p>

        <div class="credentials-box">
            <div class="credentials-item">
                <span class="label">Email:</span>
                <span>{{ $user->email }}</span>
            </div>
            <div class="credentials-item">
                <span class="label">Temporary Password:</span>
                <span>{{ $password }}</span>
            </div>
        </div>

        <p><strong>Important:</strong> For security purposes, please change your password immediately after logging in
            for the first time.</p>

        <div class="button-container">
            <a href="{{ route('login') }}" class="button">Access Your Account</a>
        </div>

        <p>If you encounter any issues or have questions, please don't hesitate to contact our membership committee:</p>
        <p>
            <a href="mailto:membership@uap.org.ph">membership@uap.org.ph</a><br>
            (02) 1234-5678
        </p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} United Architects of the Philippines - Fort Bonifacio Chapter</p>
        <p>All rights reserved. <a href="{{ url('/privacy') }}">Privacy Policy</a></p>
        <p>UAP National Office, 53 Scout Rallos Street, Quezon City, Philippines</p>
    </div>
</div>
</body>
</html>
