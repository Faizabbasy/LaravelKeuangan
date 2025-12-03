<?php

namespace App\Exports;

use App\Models\Riwayat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;


class RiwayatExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $rowNumber = 0;

    public function collection()
    {
        return Riwayat::all();
    }

    public function headings(): array
    {
        return ['No', 'Target', 'Stor', 'Tanggal', 'Target Uang'];
    }

    public function map($Riwayat): array
    {
        return [
            ++$this->rowNumber,
            $Riwayat->target,
            $Riwayat->stor,
            $Riwayat->Target_Uang,
            $Riwayat->Tanggal,
        ];
    }
}
