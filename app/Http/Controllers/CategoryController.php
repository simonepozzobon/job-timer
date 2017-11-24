<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $category = new Category;
        $category->title = $request->title;
        $category->project_id = $request->project_id;
        $category->save();

        return response()->json([
          'success' => true,
          'category' => $category
        ],200);
    }

    public function create_from_json(Request $request)
    {
        $category = new Category;
        $category->title = $request['title'];
        $category->project_id = $request['project_id'];
        $category->save();

        return response($category, 200)->header('Content-Type', 'application/json');
    }
}
