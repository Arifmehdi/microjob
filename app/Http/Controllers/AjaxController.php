<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //Get Children From parent
    public function getCategory(Request $request): JsonResponse
    {
        $response = [];
        $request->validate([
            'id' => ['required', 'integer']
        ]);
        $category = Category::query()->find($request->id);
        if ($category) {
            $response = [
                'status' => 200,
                'data'   => $category
            ];
        } else {
            $response = [
                'status' => 200,
                'data'   => []
            ];
        }
        return response()->json($response);
    }
}
