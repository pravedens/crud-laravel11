<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodApiController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 15;
        $foods = Food::when($request->search, function($query, $search) {
            $query->where('name', 'like', '%'. $search .'%');
        })->paginate($paginate);

        return $this->sendResponse(FoodResource::collection($foods)->resource, 'Successfully', 200);
    }
}
