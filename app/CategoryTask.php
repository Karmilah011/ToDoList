<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTask extends Model
{
    protected $table = 'category_task';
    protected $fillable = [
        'id',
        'categories_id',
        'task_id'
    ];
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}
