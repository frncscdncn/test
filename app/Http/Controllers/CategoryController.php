<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;

class CategoryController extends Controller
{
    public function get() {

        $categories = Category::all()->collect();
        $subcategories = Subcategory::all()->collect();
        $subsubcategories = Subsubcategory::all()->collect();


        foreach ($subcategories as $subcategory) {
            $subcategory->subsubcategories = $subsubcategories->where('subcategory_id', $subcategory->id);
        }

        foreach ($categories as $category) {
            $category->subcategories = $subcategories->where('category_id', $category->id);
        }

        return json_encode($categories);
    }
}
