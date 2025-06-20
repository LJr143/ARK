// resources/views/receipts/payment.blade.php
<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-title {
            font-size: 24px;
            font-weight: bold;
        }

        .receipt-info {
            margin: 30px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="receipt-title">PAYMENT RECEIPT</div>
    <div>Receipt #: {{ $receipt_number }}</div>
    <div>Date: {{ $date }}</div>
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

<div class="footer">
    <p>Thank you for your payment!</p>
    <p>This is an official receipt from {{ config('app.name') }}</p>
</div>
</body>
</html>
