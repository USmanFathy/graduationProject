<?php



use App\Models\Category;
if (!function_exists('getCategoriesWithSubcategories')) {
    function getCategoriesWithSubcategories()
    {
        return Category::with('subcategories')->with('products')

            ->get();
    }
}
