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
            <td>Php {{ number_format($transaction->amount, 2) }}</td>
        </tr>
        </tbody>
    </table>

    <div class="total">Total Paid: Php {{ number_format($transaction->amount, 2) }}</div>

    <!-- Print Button (hidden when printing) -->
    <div class="print-button no-print">
        <button class="btn-print" type="button" onclick="printReceipt()">
            Print Receipt
        </button>
        <br><br>
        <small style="color: #666;">You can also use Ctrl+P (Windows) or Cmd+P (Mac) to print</small>
    </div>

    <!-- Signature Section (only visible when printing) -->
    <div class="signature-section print-only">
        <div class="signature-box">
            <div class="signature-line">Member Signature</div>
        </div>
        <div class="signature-box">
            <div class="signature-line">Authorized Signature</div>
        </div>
    </div><!DOCTYPE html>
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
                font-size: 32px;
                font-weight: 700;
                color: #212529;
                margin-bottom: 20px;
                letter-spacing: 0.5px;
                text-transform: uppercase;
            }

            .receipt-subtitle {
                font-size: 16px;
                color: #6c757d;
                margin-bottom: 25px;
                font-weight: 500;
            }

            .status-badge {
                display: inline-block;
                background-color: #28a745;
                color: white;
                padding: 8px 24px;
                font-size: 14px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 25px;
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
                font-size: 14px;
                color: #6c757d;
                font-weight: 500;
                margin-bottom: 5px;
            }

            .receipt-meta-value {
                font-size: 16px;
                font-weight: 600;
                color: #212529;
            }

            .receipt-content {
                padding: 40px 50px;
            }

            .section {
                margin-bottom: 35px;
            }

            .section-title {
                font-size: 16px;
                font-weight: 600;
                color: #495057;
                margin-bottom: 15px;
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
                margin-bottom: 25px;
                border: 1px solid #dee2e6;
            }

            .transaction-table th {
                background-color: #495057;
                color: white;
                padding: 15px 20px;
                text-align: left;
                font-weight: 600;
                font-size: 14px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .transaction-table td {
                padding: 15px 20px;
                border-bottom: 1px solid #dee2e6;
                font-size: 15px;
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
                font-size: 16px;
            }

            .total-section {
                border: 2px solid #343a40;
                background-color: #f8f9fa;
                padding: 25px;
                text-align: right;
            }

            .total-label {
                font-size: 18px;
                font-weight: 600;
                color: #495057;
                margin-bottom: 8px;
            }

            .total-amount {
                font-size: 28px;
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
                font-size: 16px;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.2s ease;
            }

            .btn-print:hover {
                background-color: #0056b3;
            }

            .print-instructions {
                font-size: 14px;
                color: #6c757d;
                margin-top: 10px;
            }

            .signature-section {
                display: none;
                margin-top: 50px;
                padding-top: 30px;
                border-top: 1px solid #dee2e6;
            }

            .signature-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 80px;
                margin-top: 40px;
            }

            .signature-box {
                text-align: center;
            }

            .signature-line {
                border-top: 1px solid #343a40;
                margin-top: 60px;
                padding-top: 8px;
                font-size: 13px;
                color: #6c757d;
                font-weight: 500;
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
                font-size: 18px;
                font-weight: 600;
                color: #212529;
                margin-bottom: 10px;
            }

            .footer-text {
                font-size: 14px;
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

            <div class="print-section no-print">
                <button class="btn-print" onclick="printReceipt()">Print Receipt</button>
                <div class="print-instructions">
                    For your records, please print or save this receipt.<br>
                    You may also use Ctrl+P (Windows) or Cmd+P (Mac) to print.
                </div>
            </div>

            <div class="signature-section">
                <div class="signature-grid">
                    <div class="signature-box">
                        <div class="signature-line">Member Signature</div>
                    </div>
                    <div class="signature-box">
                        <div class="signature-line">Authorized Representative</div>
                    </div>
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

    <script>
        function printReceipt() {
            window.print();
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault();
                printReceipt();
            }
        });

        // Optional auto-print on load (uncomment if needed)
        // window.addEventListener('load', function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 1000);
        // });
    </script>
    </body>
    </html>

    <div class="footer">
        <p>Thank you for your payment!</p>
        <p>This is an official receipt from {{ config('app.name') }}</p>
        <p class="print-only">Receipt printed on {{ now()->format('F j, Y g:i A') }}</p>
    </div>
</div>

<script>

    function printReceipt() {
        if (window.print) {
            setTimeout(function() {
                window.print();
            }, 100);
        } else {
            alert('Printing is not supported in this browser. Please use Ctrl+P or Cmd+P to print.');
        }
    }

    function printReceiptAlt() {
        window.focus();
        window.print();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const printBtn = document.querySelector('.btn-print');
        if (printBtn) {
            printBtn.addEventListener('click', function(e) {
                e.preventDefault();
                printReceipt();
            });
        }
    });

    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            printReceipt();
        }
    });

    window.addEventListener('load', function() {
        setTimeout(function() {
            window.print();
        }, 1000);
    });
</script>
</body>
</html>
