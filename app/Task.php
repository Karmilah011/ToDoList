<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['id','user_id', 'desc', 'title','due_date','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function category_task()
    {
        return $this->hasMany(CategoryTask::class, 'id', 'task_id');
    }
}
