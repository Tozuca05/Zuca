<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    public function index(): JsonResponse
    {
        // Obtener productos en stock
        $products = ProductResource::collection(Product::where('stock', '>', 0)->get());

        // Responder con JSON
        return response()->json($products, 200);
    }

    public function show(string $id): JsonResponse
    {
        $product = new ProductResource(Product::findOrFail($id));

        return response()->json($product, 200);
    }
}
