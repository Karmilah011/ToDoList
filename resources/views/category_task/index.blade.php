@extends('template.master')
@section('content')
    <div class="card">
        <div class="d-flex justify-content-end pt-2" style="padding-right: 25px">
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                   {{$category->name}}
                </button>
                <ul class="dropdown-menu" style="">
                    @foreach ($categories as $item)
                        <li><a class="dropdown-item" href="{{route('category_task.allTask',$item->id)}}">{{$item->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert"
                    style="width: 50%; margin: auto; margin-left: 1%;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @foreach ($categoryTask as $item)
                <tbody>
                    <tr>
                        <td>{{ $item->task->title }}</td>
                        <td>{{ $item->task->desc }}</td>
                        <td>
                            {{($item->task->completed == 0) ? "ToDo" : "Completed" }}
                        </td>
                    </tr>
                </tbody>
                @endforeach                            
            </table>
        </div>
    </div>
@endsection
