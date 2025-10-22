<?php

namespace App\Exports;

use App\Models\Target;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;


class TargetExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $rowNumber = 0;

    public function collection()
    {
        return Target::all();
    }

    public function headings(): array
    {
        return ['No', 'Target', 'Berapa lama', 'Target Uang'];
    }

    public function map($Target): array
    {
        return [
            ++$this->rowNumber,
            $Target->Target,
            $Target->Berapa_Bulan,
            $Target->Target_Uang
        ];
    }
}
