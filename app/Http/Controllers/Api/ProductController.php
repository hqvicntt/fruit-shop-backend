<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Return the products as a JSON response with HTTP status 200 (OK)
        return response()->json([
            'success' => true,
            'message' => 'Lấy danh sách trái cây thành công',
            'data' => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate basic input data
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|numeric',
        ]);

        // Function for Admin to add new fruits to the stock
        $product = Product::create($request->all());

        // Return the created product with HTTP status 201 (Created)
        return response()->json([
            'success' => true,
            'message' => 'Thêm trái cây mới thành công',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the product by its ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy loại trái cây này'
            ], 404); // 404 Not Found
        }

        // Return the specific product details
        return response()->json([
            'success' => true,
            'message' => 'Lấy thông tin chi tiết trái cây thành công',
            'data' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the product by its ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy loại trái cây này để cập nhật'
            ], 404);
        }

        // Validate basic input data
        $request->validate([
            'name' => 'sometimes|required|string',
            'price' => 'sometimes|required|integer',
            'stock' => 'sometimes|required|numeric',
        ]);

        // Update the product data in the database
        $product->update($request->all());

        // Return the updated product data
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thông tin trái cây thành công',
            'data' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the product by its ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy loại trái cây này để xóa'
            ], 404);
        }

        // Delete the product from the database
        $product->delete();

        // Return a success message
        return response()->json([
            'success' => true,
            'message' => 'Xóa trái cây thành công'
        ], 200);
    }
}
