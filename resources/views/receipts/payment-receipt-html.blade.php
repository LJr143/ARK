<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt - {{ $receipt_number }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #fff;
        }

        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border: 2px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .receipt-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .company-logo {
            max-width: 100px;
            max-height: 100px;
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .company-details {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.4;
        }

        .receipt-title {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #e9ecef;
        }

        .receipt-title h1 {
            margin: 0;
            font-size: 24px;
            color: #495057;
        }

        .receipt-number {
            font-size: 18px;
            color: #6c757d;
            margin-top: 5px;
        }

        .receipt-body {
            padding: 30px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .info-section {
            flex: 1;
        }

        .info-section h3 {
            color: #495057;
            font-size: 16px;
            margin-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 5px;
        }

        .info-section p {
            margin: 5px 0;
            line-height: 1.5;
        }

        .payment-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .dues-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .dues-table th,
        .dues-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .dues-table th {
            background-color: #e9ecef;
            font-weight: bold;
            color: #495057;
        }

        .dues-table tr:hover {
            background-color: #f8f9fa;
        }

        .total-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 6px;
            text-align: right;
        }

        .total-amount {
            font-size: 24px;
            font-weight: bold;
        }

        .receipt-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 2px solid #e9ecef;
            font-size: 12px;
            color: #6c757d;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .payment-method-badge {
            display: inline-block;
            padding: 6px 12px;
            background: #007bff;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .payment-method-walkin {
            background: #28a745;
        }

        .payment-method-paypal {
            background: #007bff;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .receipt-container {
                border: none;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
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
                <h3>Bill To</h3>
                <p><strong>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->family_name }}</strong></p>
                <p>{{ $user->email }}</p>
                @if($user->prc_registration_number)
                    <p>PRC #: {{ $user->prc_registration_number }}</p>
                @endif
            </div>

            <div class="info-section">
                <h3>Payment Information</h3>
                <p><strong>Date:</strong> {{ $transaction->completed_at ? $transaction->completed_at->format('M d, Y h:i A') : $transaction->created_at->format('M d, Y h:i A') }}</p>
                <p><strong>Transaction ID:</strong> {{ $transaction->transaction_reference }}</p>
                <p><strong>Payment Method:</strong>
                    <span class="payment-method-badge payment-method-{{ $transaction->payment_method }}">
                            {{ ucfirst($transaction->payment_method) }}
                        </span>
                </p>
                <p><strong>Status:</strong>
                    <span class="status-badge status-{{ $transaction->status }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                </p>
            </div>
        </div>

        <!-- Dues Details -->
        @if($dues->count() > 0)
            <h3>Membership Dues Paid</h3>
            <table class="dues-table">
                <thead>
                <tr>
                    <th>Due Period</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dues as $due)
                    <tr>
                        <td>{{ $due->fiscal_year ? $due->fiscal_year->period : 'N/A' }}</td>
                        <td>{{ $due->description ?? 'Membership Due' }}</td>
                        <td>{{ $due->due_date ? \Carbon\Carbon::parse($due->due_date)->format('M d, Y') : 'N/A' }}</td>
                        <td>₱{{ number_format($due->amount, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <!-- Payment Details -->
        <div class="payment-details">
            <h3>Payment Summary</h3>
            <p><strong>Description:</strong> {{ $transaction->description }}</p>
            @if($transaction->payment_method === 'paypal' && $transaction->external_transaction_id)
                <p><strong>PayPal Transaction ID:</strong> {{ $transaction->external_transaction_id }}</p>
            @endif
        </div>

        <!-- Total -->
        <div class="total-section">
            <div style="margin-bottom: 10px;">Total Amount Paid</div>
            <div class="total-amount">₱{{ number_format($transaction->amount, 2) }} {{ strtoupper($transaction->currency) }}</div>
        </div>
    </div>

    <!-- Footer -->
    <div class="receipt-footer">
        <p>This is an official receipt generated on {{ $generated_at->format('M d, Y h:i A') }}</p>
        <p>Thank you for your payment!</p>
        @if($transaction->payment_method === 'walk-in')
            <p><em>This receipt was generated for a walk-in payment transaction.</em></p>
        @endif
    </div>
</div>
</body>
</html>
