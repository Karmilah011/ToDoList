<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Category;
use App\CategoryTask;
use Auth;

class CategoryTaskController extends Controller
{
    public function index(){
        // dd(123);
        $userId = Auth::user()->id;
        $categories = Category::where('user_id',Auth::user()->id)->get();
        return view('category_task.searchCategory',compact('categories'));
    }
    

    public function allTask($id){
        $categoryTask = CategoryTask::where('categories_id',$id)->with('category')->with('task')->get();
        $category = Category::find($id);
        $categories = Category::where('user_id',Auth::user()->id)->get();
        return view('category_task.index',compact('categoryTask','category','categories'));
    }
    public function createCategoryTask($id){
        $categories = Category::all();
        $category = Category::find($id);
        $categoryID = $category->id;
        return view('category_task.create_task',compact('categories','categoryID'));

    }
    public function storeCategoryTask(Request $request){
        $task =  new Task();
        $task->title = $request->title;
        $task->user_id = Auth::user()->id;
        $task->desc = $request->desc;
        $task->due_date = $request->due_date;
        $task->save();
        
        $categoryTask = new CategoryTask();
        $categoryTask->task_id = $task->id;
        $categoryTask->categories_id = $request->category_id;
        $categoryTask->save();

        return redirect()->route('category_task.allTask',$request->category_id)->with('success', 'CategoryTask created successfully.');
    }
    public function destroy($id){
        $CategoryTask = CategoryTask::find($id);
        Task::destroy($CategoryTask->task_id);
        $CategoryTask->delete();
        return redirect()->route('category_task.allTask',$CategoryTask->categories_id)->with('success', 'CategoryTask deleted successfully.');
    }
    public function edit($id){
        $categories = Category::all();
        $categoryTask = CategoryTask::where('id',$id)->with('category')->with('task')->first();
        // dd($categoryTask);
        return view('category_task.edit',compact('categories','categoryTask'));
    }
    public function update(Request $request, $id){
        $task = Task::find($request->task_id);
        $task->title = $request->title;
        $task->desc = $request->desc;
        $task->due_date = $request->due_date;
        $task->user_id = Auth::user()->id;
        // $task->user_id = 1;
        $task->save();


        $categoryTask = CategoryTask::where('id',$id)->with('category')->with('task')->first();
        $categoryTask->task_id = $request->task_id;
        $categoryTask->categories_id = $request->category_id;
        $categoryTask->save();

        return redirect()->route('category_task.allTask',$request->category_id)->with('success', 'CategoryTask updated successfully.');
    }
    public function updateStatus(Request $request,$id){
        $task = Task::find($id);
        $task->completed = $request->updateStatus;
        $task->save();
        return redirect()->back()->with('success', 'CategoryTask status updated successfully.');
    }    
}