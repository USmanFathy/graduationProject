<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoriesImport implements ToModel
{
    public function model(array $row)
    {

        // افتراضي أن العمود الأول يحتوي على اسم الفئة
        $category =  Category::create([
            'name' => $row[0],
            'description' => $row[1], // افتراضي أن العمود الثاني يحتوي على الوصف
            'status' => 'active', // تعيين الحالة دائمًا لتكون active
        ]);

        // إذا كان هناك subcategory معينة، قم بتحديد parent_id
        if (isset($row[2]) && !empty($row[2])) {
            $parentCategory = Category::where('name', $row[2])->first();
            if ($parentCategory) {
                $category->parent_id = $parentCategory->id;
            }
        }

        return $category;
    }
}
