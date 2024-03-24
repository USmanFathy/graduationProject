<?php

namespace App\Helpers;

use App\Models\Category;
class Categoray
{
    public  static function getCategoriesWithSubcategories()
    {
        return  Category::with('subcategories')->with('products')->get();
    }
}
