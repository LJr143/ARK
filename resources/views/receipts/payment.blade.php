<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .receipt-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .receipt-number,
        .receipt-date {
            font-size: 16px;
            color: #666;
            margin: 8px 0;
        }

        .receipt-info {
            margin: 30px 0;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }

        .receipt-info div {
            margin: 12px 0;
            font-size: 16px;
            line-height: 1.5;
        }

        .receipt-info strong {
            color: #333;
            font-weight: 600;
            display: inline-block;
            min-width: 180px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            background: white;
        }

        .table th,
        .table td {
            padding: 15px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #343a40;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .table td {
            font-size: 16px;
            background-color: #fff;
        }

        .table td:last-child {
            text-align: right;
            font-weight: 600;
            color: #28a745;
        }

        .total {
            font-weight: bold;
            font-size: 22px;
            text-align: right;
            margin: 30px 0;
            padding: 20px;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 25px;
        }

        .footer p {
            margin: 10px 0;
        }

        .footer p:first-child {
            font-size: 18px;
            font-weight: 600;
            color: #28a745;
        }

        /* Print Button */
        .print-button {
            text-align: center;
            margin: 30px 0 20px 0;
        }

        .btn-print {
            background-color: #007bff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-print:hover {
            background-color: #0056b3;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 10px 0;
        }

        /* Print Styles */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
                color: black;
                font-size: 12px;
            }

            .receipt-container {
                max-width: none;
                margin: 0;
                padding: 15px;
                border-radius: 0;
                box-shadow: none;
                background: white;
            }

            .header {
                margin-bottom: 20px;
                padding-bottom: 15px;
                border-bottom: 2px solid black;
            }

            .receipt-title {
                font-size: 24px;
                color: black;
            }

            .receipt-number,
            .receipt-date {
                font-size: 14px;
                color: black;
            }

            .receipt-info {
                background-color: transparent;
                border: 1px solid black;
                border-left: 3px solid black;
                padding: 15px;
                margin: 20px 0;
            }

            .receipt-info div {
                margin: 8px 0;
                font-size: 14px;
            }

            .table th {
                background-color: #f0f0f0 !important;
                color: black !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .table th,
            .table td {
                padding: 10px 8px;
                border: 1px solid black;
                font-size: 14px;
            }

            .table td:last-child {
                color: black;
            }

            .total {
                background: #f0f0f0 !important;
                color: black !important;
                font-size: 18px;
                border: 2px solid black;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .footer {
                margin-top: 30px;
                padding-top: 20px;
                font-size: 12px;
                color: black;
                border-top: 1px solid black;
            }

            .footer p:first-child {
                color: black;
                font-size: 16px;
            }

            .status-badge {
                background-color: #f0f0f0 !important;
                color: black !important;
                border: 1px solid black;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Hide elements that shouldn't be printed */
            .no-print,
            .print-button,
            .btn-print {
                display: none !important;
            }

            /* Ensure proper page breaks */
            .receipt-container {
                page-break-inside: avoid;
            }

            .table {
                page-break-inside: auto;
            }

            .table tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            /* Add signature lines for printed version */
            .signature-section {
                margin-top: 40px;
                display: flex;
                justify-content: space-between;
                page-break-inside: avoid;
            }

            .signature-box {
                width: 45%;
                text-align: center;
            }

            .signature-line {
                border-top: 1px solid black;
                margin-top: 40px;
                padding-top: 5px;
                font-size: 11px;
            }
        }

        /* Screen-only styles */
        @media screen {
            .print-only {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="receipt-container">
    <div class="header">
        <div class="receipt-title">PAYMENT RECEIPT</div>
        <div class="status-badge">PAID</div>
        <div class="receipt-number">Receipt #: {{ $receipt_number }}</div>
        <div class="receipt-date">Date: {{ $date }}</div>
    </div>

    <div class="receipt-info">
        <div><strong>Member:</strong> {{ $user->first_name }} {{ $user->family_name }}</div>
        <div><strong>PRC #:</strong> {{ $user->prc_registration_number ?? 'N/A' }}</div>
        <div><strong>Payment Method:</strong> {{ $payment->payment_method }}</div>
        <div><strong>Transaction Reference:</strong> {{ $transaction->transaction_reference }}</div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Description</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Membership Dues Payment</td>
            <td>₱{{ number_format($transaction->amount, 2) }}</td>
        </tr>
        </tbody>
    </table>

    <div class="total">Total Paid: ₱{{ number_format($transaction->amount, 2) }}</div>

    <!-- Print Button (hidden when printing) -->
    <div class="print-button no-print">
        <button class="btn-print" onclick="window.print()">
            🖨️ Print Receipt
        </button>
    </div>

    <!-- Signature Section (only visible when printing) -->
    <div class="signature-section print-only">
        <div class="signature-box">
            <div class="signature-line">Member Signature</div>
        </div>
        <div class="signature-box">
            <div class="signature-line">Authorized Signature</div>
        </div>
    </div>

    <div class="footer">
        <p>Thank you for your payment!</p>
        <p>This is an official receipt from {{ config('app.name') }}</p>
        <p class="print-only">Receipt printed on {{ now()->format('F j, Y g:i A') }}</p>
    </div>
</div>

<script>
    // window.addEventListener('load', function() {
    //     window.print();
    // });

    function printReceipt() {
        window.print();
    }
</script>
</body>
</html>
