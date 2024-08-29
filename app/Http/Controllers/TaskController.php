<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\CategoryTask;
use App\Task;
use Auth;
class TaskController extends Controller
{
    public function index(Request $request)
    {
        // $task = Task::all();
        $userId = Auth::user()->id;
        $task = CategoryTask::with('task')->with('category')
        ->whereHas('category', function ($query) use ($userId) { $query->where('user_id', $userId);
        });

        if (!empty($request->categories_id)) {
            $task = $task->whereHas('category', function ($query) use ($request) { $query->where('id', $request->categories_id);});            
        }

        $task = $task->get();
        return view('tasks.index', compact('task'));
    }

    public function create()
    {
        $categories = Category::all();
        $categoryID = Auth::user()->id;
        return view('tasks.create',compact('categories','categoryID'));
    }

    public function store(Request $request)
    {
        $task =  new Task();
        $task->title = $request->title;
        $task->desc = $request->desc;
        $task->due_date = $request->due_date;
        $task->user_id = Auth::user()->id;
        // $task->user_id = 1;
        $task->save();

        $categoyTask = new CategoryTask();
        $categoyTask->task_id = $task->id;
        $categoyTask->categories_id = $request->category_id;
        $categoyTask->save();
        return redirect()->route('task.index')->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $task = Task::find($id);
        $categories = Category::all();
        $categoryID = Auth::user()->id;
        return view('tasks.edit', compact('task','categories','categoryID'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->title = $request->title;
        $task->desc = $request->desc;
        $task->due_date = $request->due_date;
        // $task->user_id = Auth::user()->id;
        $task->user_id = Auth::user()->id;
        $task->save();

        // $getCategoryTask = 
        // $categoyTask = CategoryTask::find();
        // $categoyTask->task_id =$id;
        // $categoyTask->category_id = $request->category_id;
        // $categoyTask->save();
        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
            $CategoryTask = CategoryTask::find($id);
            Task::destroy($CategoryTask->task_id);
            $CategoryTask->delete();
            return redirect()->route('task.index')->with('success', 'Task deleted successfully.');
    }
}