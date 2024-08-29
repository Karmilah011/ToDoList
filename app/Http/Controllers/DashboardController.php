<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class DashboardController extends Controller
{
    public function dashboard(){
        $user_id = auth()->user()->id;
        $total_true_tasks = Task::where('user_id', $user_id)->where('completed', true)->count();
        $total_false_tasks = Task::where('user_id', $user_id)->where('completed', false)->count();
    
        return view('dashboard', compact('total_true_tasks', 'total_false_tasks'));
    }
}
