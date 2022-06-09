<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\ContactModel;

class Dashboard extends Controller
{
    public function index()
    {
        $data = [
            'article_count' => ArticleModel::whereStatus(1)->count(),
            'views' => ArticleModel::sum('hit'),
            'category_count' => CategoryModel::whereStatus(1)->count(),
            'contact_count' => ContactModel::whereStatus(1)->count()
        ];
        return view('admin.dashboard', $data);
    }
}
