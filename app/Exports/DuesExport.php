<?php

namespace App\Exports;

use App\Models\Due;
use Maatwebsite\Excel\Concerns\FromCollection;

class DuesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Due::all();
    }
}
