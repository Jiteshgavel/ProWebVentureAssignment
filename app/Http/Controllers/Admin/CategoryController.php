<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\CategoryExportClass;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function index(Request $request){
      

        if ($request->ajax()) {
  
            $data = Category::with('product')->latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Edit</a>';
                        if (isset($row->products) and $row->products->count()) {
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory">Delete</a>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.category.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:categories,name,'.$request->category_id,
        ]);

        Category::updateOrCreate(
            ['id' => $request->category_id],
            ['name' => $request->name,]
        );
        return response()->json(['success' => 'Category saved successfully.']);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

    public function export(){
        return Excel::download(new CategoryExportClass, 'categories.xlsx');
    }
    
}
