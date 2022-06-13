<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = 'comments';

    public function article()
    {
        return $this->hasOne('App\Models\ArticleModel', 'id', 'article_id');
    }
}
