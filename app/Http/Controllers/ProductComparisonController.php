<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Compare;

class ProductComparisonController extends Controller
{
    public function compare($id)
    {
        $compareProduct = Product::findOrFail($id);
        $searchResults = [];

        return view('compareProduct', ['product' => $compareProduct, 'searchResults' => $searchResults]);
    }

    public function searchAndAdd(Request $request, $id)
{
    $keyword = $request->input('keyword');

    // 搜索基于关键词的产品
    $searchResults = Product::where('name', 'like', '%' . $keyword . '%')
        ->orWhere('brand', 'like', '%' . $keyword . '%')
        ->get();

    $compareProduct = Product::findOrFail($id);

    return view('compareProduct', [
        'product' => $compareProduct,
        'searchResults' => $searchResults
    ]);
}



    public function addToComparisonList($id, $compareId)
    {
        $product = Product::findOrFail($id);
        $comparedProduct = Product::findOrFail($compareId);

        // Check if the comparison already exists before inserting
        $existingComparison = Compare::where('product_id', $product->id)
            ->where('compared_product_id', $comparedProduct->id)
            ->first();

        if (!$existingComparison) {
            // Create a new comparison entry
            Compare::create([
                'product_id' => $product->id,
                'compared_product_id' => $comparedProduct->id,
            ]);
        }

        // 更新第二个比较产品为添加的比较产品
        $secondComparedProduct = $comparedProduct;

        return view('compareProduct', [
            'product' => $product,
            'secondComparedProduct' => $secondComparedProduct
        ]);
    }

    public function index(Request $request)
    {
        $product_id = $request->input('product_id');
        $product = Product::findOrFail($product_id);

        $comparisonProducts = [];

        return view('compareProduct', ['product' => $product, 'comparisonProducts' => $comparisonProducts]);
    }
}
