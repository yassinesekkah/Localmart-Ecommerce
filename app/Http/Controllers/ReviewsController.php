<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Http\Request as FacadesRequest;

class ReviewsController extends Controller
{
    public function createReview(FacadesRequest $request, $productId)
    {
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

        $reviews = Product::with('reviews.user', 'category')
            ->where('id', $product->id)
            ->latest()
            ->findOrFail($productId);

        $reviews = Reviews::with('user')
            ->where('product_id', $productId)
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

    function show($productId)
    {
        $reviews = Product::with(['reviews.user', 'likes', 'favorites' => function ($query) {
            $query->select('product_id', 'rating', 'created_at')
                ->with('user:name');
        }])
            ->withCount('favorites')
            ->withAvg('favorites', 'rating')
            ->find($productId);
        if (!$reviews) {
            return response()->json(['message' => 'aucun review'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $reviews
        ], 200);
    }

    function delete($reviewId)
    {
        try {
            $review = Reviews::find($reviewId);
            
            if (!$review) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This review not exist!'
                ], 404);
            }
            $review->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Review supprimée avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }
}
