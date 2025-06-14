<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt - {{ $receipt_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .receipt-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .receipt-header::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .company-logo {
            max-width: 120px;
            max-height: 120px;
            margin-bottom: 20px;
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .company-name {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
        }

        .company-details {
            font-size: 16px;
            opacity: 0.95;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .receipt-title {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 30px;
            text-align: center;
            border-bottom: 3px solid #667eea;
        }

        .receipt-title h1 {
            font-size: 28px;
            color: #495057;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .receipt-number {
            font-size: 20px;
            color: #667eea;
            font-weight: 600;
            background: white;
            padding: 8px 20px;
            border-radius: 25px;
            display: inline-block;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }

        .receipt-body {
            padding: 40px;
            background: #fff;
        }

        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .info-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            transition: transform 0.3s ease;
        }

        .info-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .info-section h3 {
            color: #495057;
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: 600;
            border-bottom: 2px solid #667eea;
            padding-bottom: 8px;
        }

        .info-section p {
            margin: 8px 0;
            line-height: 1.6;
            color: #6c757d;
        }

        .info-section strong {
            color: #495057;
        }

        .dues-section {
            margin: 30px 0;
        }

        .dues-section h3 {
            color: #495057;
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .dues-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .dues-table th,
        .dues-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #f1f3f4;
        }

        .dues-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .dues-table tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        .dues-table td {
            color: #6c757d;
            font-size: 14px;
        }

        .payment-details {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 25px;
            border-radius: 10px;
            margin: 30px 0;
            border-left: 4px solid #28a745;
        }

        .payment-details h3 {
            color: #495057;
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .payment-details p {
            margin: 8px 0;
            line-height: 1.6;
            color: #6c757d;
        }

        .total-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            margin: 30px 0;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .total-section::before {
            content: '₱';
            position: absolute;
            font-size: 200px;
            opacity: 0.1;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .total-label {
            font-size: 18px;
            margin-bottom: 10px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .total-amount {
            font-size: 36px;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
        }

        .receipt-footer {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 30px;
            text-align: center;
            border-top: 3px solid #667eea;
        }

        .receipt-footer p {
            margin: 8px 0;
            color: #6c757d;
            font-size: 14px;
        }

        .receipt-footer .thank-you {
            font-size: 18px;
            font-weight: 600;
            color: #495057;
            margin-top: 15px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-completed {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .status-pending {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }

        .payment-method-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .payment-method-walk-in {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .payment-method-paypal {
            background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
            color: white;
        }

        .download-actions {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .download-btn {
            display: inline-block;
            padding: 12px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            margin-left: 10px;
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        @media (max-width: 768px) {
            .info-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .receipt-body {
                padding: 20px;
            }

            .company-name {
                font-size: 24px;
            }

            .total-amount {
                font-size: 28px;
            }

            .download-actions {
                position: static;
                text-align: center;
                margin-bottom: 20px;
            }
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .receipt-container {
                box-shadow: none;
                border-radius: 0;
            }

            .download-actions {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="download-actions">
    <a href="{{ route('receipt.download', $payment->id) }}" class="download-btn">📥 Download PDF</a>
    <button onclick="window.print()" class="download-btn">🖨️ Print</button>
</div>

<div class="receipt-container">
    <!-- Header -->
    <div class="receipt-header">
        @if($company_info['logo'])
            <img src="{{ $company_info['logo'] }}" alt="Company Logo" class="company-logo">
        @endif
        <div class="company-name">{{ $company_info['name'] }}</div>
        <div class="company-details">
            {{ $company_info['address'] }}<br>
            Phone: {{ $company_info['phone'] }} | Email: {{ $company_info['email'] }}<br>
            {{ $company_info['website'] }}
        </div>
    </div>

    <!-- Receipt Title -->
    <div class="receipt-title">
        <h1>Payment Receipt</h1>
        <div class="receipt-number">Receipt #{{ $receipt_number }}</div>
    </div>

    <!-- Receipt Body -->
    <div class="receipt-body">
        <!-- Info Row -->
        <div class="info-row">
            <div class="info-section">
                <h3>👤 Bill To</h3>
                <p><strong>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->family_name }}</strong></p>
                <p>📧 {{ $user->email }}</p>
                @if($user->prc_registration_number)
                    <p>🆔 PRC #: {{ $user->prc_registration_number }}</p>
                @endif
            </div>

            <div class="info-section">
                <h3>💳 Payment Information</h3>
                <p><strong>📅 Date:</strong> {{ $transaction->completed_at ? $transaction->completed_at->format('M d, Y h:i A') : $transaction->created_at->format('M d, Y h:i A') }}</p>
                <p><strong>🔗 Transaction ID:</strong> {{ $transaction->transaction_reference }}</p>
                <p><strong>💰 Payment Method:</strong><br>
                    <span class="payment-method-badge payment-method-{{ str_replace('-', '-', $transaction->payment_method) }}">
                            {{ ucwords(str_replace('-', ' ', $transaction->payment_method)) }}
                        </span>
                </p>
                <p><strong>📊 Status:</strong><br>
                    <span class="status-badge status-{{ $transaction->status }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                </p>
            </div>
        </div>

        <!-- Dues Details -->
        @if($dues->count() > 0)
            <div class="dues-section">
                <h3>📋 Membership Dues Paid</h3>
                <table class="dues-table">
                    <thead>
                    <tr>
                        <th>📅 Due Period</th>
                        <th>📝 Description</th>
                        <th>⏰ Due Date</th>
                        <th>💵 Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dues as $due)
                        <tr>
                            <td>{{ $due->fiscal_year ? $due->fiscal_year->period : 'N/A' }}</td>
                            <td>{{ $due->description ?? 'Membership Due' }}</td>
                            <td>{{ $due->due_date ? \Carbon\Carbon::parse($due->due_date)->format('M d, Y') : 'N/A' }}</td>
                            <td><strong>₱{{ number_format($due->amount, 2) }}</strong></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Payment Details -->
        <div class="payment-details">
            <h3>📄 Payment Summary</h3>
            <p><strong>Description:</strong> {{ $transaction->description }}</p>
            @if($transaction->payment_method === 'paypal' && $transaction->external_transaction_id)
                <p><strong>PayPal Transaction ID:</strong> {{ $transaction->external_transaction_id }}</p>
            @endif
            @if($transaction->payer_id)
                <p><strong>Payer ID:</strong> {{ $transaction->payer_id }}</p>
            @endif
        </div>

        <!-- Total -->
        <div class="total-section">
            <div class="total-label">Total Amount Paid</div>
            <div class="total-amount">₱{{ number_format($transaction->amount, 2) }} {{ strtoupper($transaction->currency) }}</div>
        </div>
    </div>

    <!-- Footer -->
    <div class="receipt-footer">
        <p>🕒 This receipt was generated on {{ $generated_at->format('M d, Y h:i A') }}</p>
        <p class="thank-you">🙏 Thank you for your payment!</p>
        @if($transaction->payment_method === 'walk-in')
            <p><em>💼 This receipt was generated for a walk-in payment transaction.</em></p>
        @elseif($transaction->payment_method === 'paypal')
            <p><em>🌐 This payment was processed securely through PayPal.</em></p>
        @endif
        <p style="margin-top: 20px; font-size: 12px; opacity: 0.7;">
            This is a computer-generated receipt and is valid without signature.
        </p>
    </div>
</div>

<script>
    // Add some interactive features
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects to table rows
        const tableRows = document.querySelectorAll('.dues-table tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8f9fa';
            });
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });

        // Add click to copy functionality for transaction ID
        const transactionId = document.querySelector('.info-section p strong');
        if (transactionId) {
            transactionId.style.cursor = 'pointer';
            transactionId.title = 'Click to copy';
            transactionId.addEventListener('click', function() {
                navigator.clipboard.writeText('{{ $transaction->transaction_reference }}').then(function() {
                    // Show copied feedback
                    const originalText = transactionId.textContent;
                    transactionId.textContent = 'Copied!';
                    transactionId.style.color = '#28a745';
                    setTimeout(() => {
                        transactionId.textContent = originalText;
                        transactionId.style.color = '';
                    }, 2000);
                });
            });
        }
    });
</script>
</body>
</html>
