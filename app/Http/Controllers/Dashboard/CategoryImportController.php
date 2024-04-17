<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

// افترض أنه تم استيراد معالج الاستيراد

class CategoryImportController extends Controller
{

    public function import(Request $request)
    {
        $file = $request->file('file');
        $rules = [
            'Name' => 'required|string|unique:categories,name',
        ];

        $columnHeaders =  ['Name','Description','Parent'];
        $needed_columns = ['Name' => 'name','Description'=>'description','Parent'=>'parent_id']; // Dynamic array of column headers
        $relationNames = ['subcategories' => ['column' => 'name', 'display' => 'Parent', 'foreign_key' => 'parent_id', 'model' => new Category()]]; // Dynamic array of relation names

        try{
            $this->excelService->import($file, $rules,new Category() ,$columnHeaders,$relationNames,$needed_columns  );

            return redirect()->route('categories.index')
                ->with('success' , 'category imported successfully!');
        } catch (\Exception $e) {


            return redirect()->route('categories.index')
                ->with('danger' , 'category import has been crashed!');        }

    }
}
