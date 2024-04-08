<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExportClass implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Name',
            'Category',
            'Price',
            'Weight',
            'Description',
            'Create Time'
        ];
    }
    public function collection()
    {
        return Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.name', 'categories.name as category_name', 'products.price', 'products.weight','products.description','products.created_at')
            ->latest()->get();
    }
}
