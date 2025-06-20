<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto Mono', monospace;
            background: #fff;
            color: #000;
            font-size: 12px;
            line-height: 1.4;
            padding: 20px;
        }

        .receipt-container {
            width: 80mm;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #000;
            background: #fff;
        }

        .receipt-header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .receipt-title {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .receipt-subtitle {
            font-size: 10px;
            color: #333;
        }

        .receipt-meta {
            margin: 10px 0;
            font-size: 10px;
        }

        .receipt-meta-item {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .section {
            margin: 10px 0;
        }

        .section-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
        }

        .info-grid {
            font-size: 10px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin: 10px 0;
        }

        .transaction-table th, .transaction-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .transaction-table th {
            font-weight: 600;
            background: #f0f0f0;
        }

        .amount-cell {
            text-align: right;
            font-weight: 600;
        }

        .total-section {
            text-align: right;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px dashed #000;
        }

        .total-label {
            font-size: 11px;
            font-weight: 600;
        }

        .total-amount {
            font-size: 14px;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            font-size: 9px;
            margin-top: 10px;
            border-top: 2px dashed #000;
            padding-top: 10px;
        }

        .footer-text {
            margin: 3px 0;
        }

        @media print {
            body {
                padding: 0;
                margin: 0;
                width: 80mm;
            }

            .receipt-container {
                border: none;
                box-shadow: none;
            }

            @page {
                size: 80mm auto;
                margin: 0;
            }
        }
    </style>
</head>
<body>
<div class="receipt-container">
    <div class="receipt-header">
        <h1 class="receipt-title">Official Receipt</h1>
        <p class="receipt-subtitle">Payment Confirmation</p>
        <div class="receipt-meta">
            <div class="receipt-meta-item">
                <span>Receipt No:</span>
                <span>{{ $receipt_number }}</span>
            </div>
            <div class="receipt-meta-item">
                <span>Date:</span>
                <span>{{ $date }}</span>
            </div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Payer Information</h2>
        <div class="info-grid">
            <div class="info-item">
                <span>Name:</span>
                <span>{{ $user->first_name }} {{ $user->family_name }}</span>
            </div>
            <div class="info-item">
                <span>PRC Reg No:</span>
                <span>{{ $user->prc_registration_number ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Transaction Details</h2>
        <div class="info-grid">
            <div class="info-item">
                <span>Payment Method:</span>
                <span>{{ $payment->payment_method }}</span>
            </div>
            <div class="info-item">
                <span>Reference:</span>
                <span>{{ $transaction->transaction_reference }}</span>
            </div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Payment Summary</h2>
        <table class="transaction-table">
            <thead>
            <tr>
                <th>Description</th>
                <th>Amount (PHP)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Membership Dues</td>
                <td class="amount-cell">{{ number_format($transaction->amount, 2) }}</td>
            </tr>
            </tbody>
        </table>
        <div class="total-section">
            <div class="total-label">Total Paid</div>
            <div class="total-amount">PHP {{ number_format($transaction->amount, 2) }}</div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-text">Issued by: {{ config('app.name') }}</div>
        <div class="footer-text">This is an electronic receipt and is valid without signature.</div>
        <div class="footer-text">Printed on: {{ now()->format('M d, Y h:i A') }}</div>
    </div>
</div>
</body>
</html>
