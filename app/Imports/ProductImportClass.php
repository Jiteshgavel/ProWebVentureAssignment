<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImportClass implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
       
        Validator::make($rows->toArray(), [
            '*.name' => 'required|unique:products,name',
            '*.category' => 'required',
            '*.price' => 'required|numeric',
            '*.weight' => 'required|numeric',
            '*.description' => 'required',
        ])->validate();
       
        foreach ($rows as $row) {
        $category =  Category::updateOrCreate(
                ['name' => $row['category']],
                ['name' => $row['category'],]
            );
                Product::create(
                    [
                        'name' => $row['name'],
                        'category_id' => $category->id,
                        'weight' => $row['weight'],
                        'price' => $row['price'],
                        'description' => $row['description']
                    ]
                );
            }
        }
}
