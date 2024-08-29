<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['id','name', 'user_id'];

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categoryTask()
    {
        return $this->hasMany(CategoryTask::class, 'categories_id', 'id');
    }
}
