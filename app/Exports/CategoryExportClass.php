<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoryExportClass implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Name',
            'Created_at',
        ];
    }
    public function collection()
    {
        return Category::latest()->select('name','created_at')->get();
    }
}
