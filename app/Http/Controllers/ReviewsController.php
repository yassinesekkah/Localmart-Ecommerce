<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Http\Request as FacadesRequest;

class ReviewsController extends Controller
{
    public function createReview(FacadesRequest $request, $productId){
        //product_id = 5
        $product = Product::findOrFail($productId);
        $validated = $request->validate([
            'comment'       => 'required|string|min:5',
        ]);

        Reviews::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'comment' => $validated['comment'],
        ]);

        $reviews = Reviews::with('user')
                ->where('product_id', $product->id)
                ->latest()
                ->get();
        if (!$reviews) {
            return response()->json(['message' => 'aucun review'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $reviews
        ], 200);
    }
}
