<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;


class CustomersExport implements FromCollection, WithStyles, WithColumnWidths, WithMapping, WithColumnFormatting, WithHeadings
{

    private $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function collection()
    {

        return $this->filter;
    }

    public function map($row): array
    {

        $created_at = Date::PHPToExcel($row->created_at);
        $updated_at = Date::PHPToExcel($row->updated_at);

        return [
            $row->id,
            $row->first_name,
            $row->last_name,
            $row->phone,
            $row->email,
            $row->created_by,
            $row->updated_by,
            $row->created_at = $created_at,
            $row->updated_at = $updated_at,
            $row->is_activated ? 'Yes' : 'No',
        ];
    }

    public function columnFormats(): array
    {

        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function headings(): array
    {

        return [
            'ID',
            'First Name',
            'Last Name',
            'phone',
            'Email',
            'Created By',
            'Updated By',
            'Created At',
            'Updated At',
            'Is Activated',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 40,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'font' => ['bold' => true],
                'font' => ['size' => 12],
            ],
        ];
    }
}
