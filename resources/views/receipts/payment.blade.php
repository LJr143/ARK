<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            color: #212529;
            line-height: 1.5;
        }

        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #dee2e6;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }

        .receipt-header {
            background-color: #ffffff;
            border-bottom: 3px solid #343a40;
            padding: 40px 50px;
            text-align: center;
        }

        .receipt-title {
            font-size: 25px;
            font-weight: 700;
            color: #212529;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .receipt-subtitle {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .status-badge {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 8px 24px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .receipt-meta {
            display: flex;
            justify-content: space-between;
            max-width: 400px;
            margin: 0 auto;
        }

        .receipt-meta-item {
            text-align: center;
        }

        .receipt-meta-label {
            font-size: 12px;
            color: #6c757d;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .receipt-meta-value {
            font-size: 14px;
            font-weight: 600;
            color: #212529;
        }

        .receipt-content {
            padding: 40px 50px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 8px;
        }

        .member-info {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 25px;
            border-left: 4px solid #007bff;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-label {
            font-weight: 500;
            color: #495057;
            min-width: 160px;
        }

        .info-value {
            font-weight: 600;
            color: #212529;
            text-align: right;
        }

        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }

        .transaction-table th {
            background-color: #495057;
            color: white;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .transaction-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #dee2e6;
            font-size: 13px;
        }

        .transaction-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .transaction-table tbody tr:hover {
            background-color: #e9ecef;
        }

        .description-cell {
            font-weight: 500;
            color: #212529;
        }

        .amount-cell {
            text-align: right;
            font-weight: 600;
            color: #28a745;
            font-size: 14px;
        }

        .total-section {
            border: 2px solid #343a40;
            background-color: #f8f9fa;
            padding: 25px;
            text-align: right;
        }

        .total-label {
            font-size: 16px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .total-amount {
            font-size: 26px;
            font-weight: 700;
            color: #28a745;
        }

        .print-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .btn-print {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }



        .footer {
            border-top: 1px solid #dee2e6;
            background-color: #f8f9fa;
            padding: 25px 50px;
            text-align: center;
        }

        .footer-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .footer-title {
            font-size: 16px;
            font-weight: 600;
            color: #212529;
            margin-bottom: 10px;
        }

        .footer-text {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .footer-legal {
            font-size: 12px;
            color: #868e96;
            margin-top: 15px;
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .receipt-header,
            .receipt-content,
            .footer {
                padding: 25px 20px;
            }

            .receipt-title {
                font-size: 24px;
            }

            .receipt-meta {
                flex-direction: column;
                gap: 15px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .info-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .info-value {
                text-align: left;
            }

            .transaction-table th,
            .transaction-table td {
                padding: 10px 15px;
            }

            .total-amount {
                font-size: 24px;
            }

            .signature-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        /* Print Styles */
        @media print {
            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            body {
                background: white;
                padding: 0;
                font-size: 12pt;
            }

            .receipt-container {
                max-width: none;
                margin: 0;
                box-shadow: none;
                border: none;
            }

            .receipt-header {
                border-bottom: 2pt solid black;
            }

            .status-badge {
                background-color: #f0f0f0 !important;
                color: black !important;
                border: 1pt solid black;
            }

            .member-info {
                background-color: transparent !important;
                border: 1pt solid black;
                border-left: 3pt solid black;
            }

            .transaction-table {
                border: 1pt solid black;
            }

            .transaction-table th {
                background-color: #f0f0f0 !important;
                color: black !important;
                border-bottom: 1pt solid black;
            }

            .transaction-table td {
                border-bottom: 1pt solid #ccc;
            }

            .total-section {
                border: 2pt solid black;
                background-color: #f8f8f8 !important;
            }

            .footer {
                background-color: transparent !important;
                border-top: 1pt solid black;
            }

            .print-section {
                display: none !important;
            }

            .signature-section {
                display: block !important;
                page-break-inside: avoid;
            }

            .no-print {
                display: none !important;
            }

            .receipt-container {
                page-break-inside: avoid;
            }

            .section {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
<div class="receipt-container">
    <div class="receipt-header">
        <h1 class="receipt-title">Official Payment Receipt</h1>
        <p class="receipt-subtitle">Professional Services Payment Documentation</p>

        <div class="status-badge">PAID</div>

        <div class="receipt-meta">
            <div class="receipt-meta-item">
                <div class="receipt-meta-label">Receipt Number</div>
                <div class="receipt-meta-value">{{ $receipt_number }}</div>
            </div>
            <div class="receipt-meta-item">
                <div class="receipt-meta-label">Issue Date</div>
                <div class="receipt-meta-value">{{ $date }}</div>
            </div>
        </div>
    </div>

    <div class="receipt-content">
        <div class="section">
            <h2 class="section-title">Member Information</h2>
            <div class="member-info">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Full Name:</span>
                        <span class="info-value">{{ $user->first_name }} {{ $user->family_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">PRC Registration No.:</span>
                        <span class="info-value">{{ $user->prc_registration_number ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Transaction Details</h2>
            <div class="member-info">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Payment Method:</span>
                        <span class="info-value">{{ $payment->payment_method }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Transaction Reference:</span>
                        <span class="info-value">{{ $transaction->transaction_reference }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Payment Summary</h2>
            <table class="transaction-table">
                <thead>
                <tr>
                    <th>Description</th>
                    <th style="text-align: right;">Amount (PHP)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="description-cell">Membership Dues Payment</td>
                    <td class="amount-cell">{{ number_format($transaction->amount, 2) }}</td>
                </tr>
                </tbody>
            </table>

            <div class="total-section">
                <div class="total-label">Total Amount Paid</div>
                <div class="total-amount">PHP {{ number_format($transaction->amount, 2) }}</div>
            </div>
        </div>

    </div>

    <div class="footer">
        <div class="footer-content">
            <div class="footer-title">Receipt Acknowledgment</div>
            <div class="footer-text">This serves as your official receipt for the payment made.</div>
            <div class="footer-text">Issued by: {{ config('app.name') }}</div>
            <div class="footer-text">Please retain this receipt for your records.</div>
            <div class="footer-legal">
                This document was generated electronically and is valid without signature.
                <span style="display: none;" class="print-only">
                        <br>Printed on: {{ now()->format('F j, Y \a\t g:i A') }}
                    </span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
