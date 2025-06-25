<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    protected $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function collection()
    {
        // Jika $this->products adalah array, ubah ke Collection
        return collect($this->products);
    }

    public function headings(): array
    {
        return ['ID', 'Title', 'Price', 'Stock'];
    }
}
