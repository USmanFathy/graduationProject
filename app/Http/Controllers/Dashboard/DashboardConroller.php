<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DashboardConroller extends Controller
{
    public function index(){
        $booksCount = Product::count();
        $categoriesCount = Category::count();
        $adminsCount = Admin::count();
        $usersCount = User::count();
        return view('Dashboard.index',['booksCount' => $booksCount,'categoriesCount' => $categoriesCount,'adminsCount' => $adminsCount,'usersCount'=>$usersCount]);
    }
}
