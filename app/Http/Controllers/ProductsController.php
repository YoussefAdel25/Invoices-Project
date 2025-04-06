<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        $products = Product::all();
        return view('products.products')
            ->with('sections', $sections)
            ->with('products', $products);
    }


    public function store(Request $request)
    {
        $request->validate([
            'Product_name' => 'required|max:255|unique:products,Product_name',
            'section_id' => 'required|exists:sections,id',
            'description' => 'nullable|string',
        ], [
            'Product_name.required' => 'يرجى إدخال اسم المنتج',
            'Product_name.unique' => 'اسم المنتج مسجل مسبقًا',
            'section_id.required' => 'يرجى اختيار القسم',
            'section_id.exists' => 'القسم غير موجود',
        ]);

        Product::create([
            'Product_name' => $request->Product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);

        session()->flash('Add', 'تم إضافة المنتج بنجاح');
        return redirect('/products');
    }

    public function update(Request $request)
    {
        $request->validate([
            'Product_name' => 'required|max:255|unique:products,Product_name,' . $request->pro_id,
            'section_name' => 'required|exists:sections,section_name',
            'description' => 'nullable|string',
        ], [
            'Product_name.required' => 'يرجى إدخال اسم المنتج',
            'Product_name.unique' => 'اسم المنتج مسجل مسبقًا',
            'section_name.required' => 'يرجى اختيار القسم',
            'section_name.exists' => 'القسم غير موجود',
        ]);

        $section = Section::where('section_name', $request->section_name)->first();
        if (!$section) {
            return back()->withErrors(['section_name' => 'القسم غير موجود']);
        }

        $product = Product::findOrFail($request->pro_id);
        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $section->id,
        ]);

        session()->flash('Edit', 'تم تعديل المنتج بنجاح');
        return back();
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->pro_id);
        $product->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return back();
    }

    // public function getProducts($id)
    // {
    //     $products = Product::where('section_id', $id)->pluck('product_name', 'id');
    //     return response()->json($products);
    // }
}
