<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function articleCount($onlyActives = false)
    {
        return $onlyActives
            ? $this->hasMany('App\Models\ArticleModel', 'category_id', 'id')->whereStatus(1)->count()
            : $this->hasMany('App\Models\ArticleModel', 'category_id', 'id')->count();
    }
}
