<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Imports\ProductImportClass;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ProductImportController extends Controller
{

    public function import(){

        return view('admin.import.import_product');
    }

    public function store(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'import' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('import');

        // Process the Excel file
        Excel::import(new ProductImportClass, $file);

        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}
