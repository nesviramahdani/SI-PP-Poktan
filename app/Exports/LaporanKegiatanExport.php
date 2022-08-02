<?php

namespace App\Exports;

use App\Models\Detailkegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanKegiatanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Detailkegiatan::all();
    }
}
