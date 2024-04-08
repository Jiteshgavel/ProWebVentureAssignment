<?php

namespace App\Http\Controllers\Admin;
use DataTables;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductExportClass;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->with('category')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $categories = Category::all();
        return view('admin.product.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:products,name,' . $request->product_id,
            'category'=>'required',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);
        Product::updateOrCreate(
            ['id' => $request->product_id],
            [
            'name' => $request->name,
            'category_id'=>$request->category,
            'weight'=>$request->weight,
            'price'=> $request->price,
            'description' => $request->description
            ]
        );

        return response()->json(['success' => 'Product saved successfully.']);
    }
   
    public function edit($id)
    {
        $product = Product::with('category')->find($id);
        return response()->json($product);
    }

    public function destroy($id)
    {
        Product::find($id)->delete();

        return response()->json(['success' => 'Product deleted successfully.']);
    }

    public function export(){
        return Excel::download(new ProductExportClass, 'products_list.xlsx');
    }
}
