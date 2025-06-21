<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of data to export.
     */
    public function collection()
    {
        return Transaction::all([
            'id',
            'transaction_reference',
            'payment_method',
            'amount',
            'status',
            'payer_email',
            'completed_at'
        ]);
    }

    /**
     * Return the headings for the spreadsheet.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Transaction Reference',
            'Payment Method',
            'Amount',
            'Status',
            'Payer Email',
            'Completed At'
        ];
    }
}
