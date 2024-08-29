@extends('template.master')
@section('content')
    <div class="card">
        <div class="d-flex justify-content-end pt-2" style="padding-right: 25px">
            <a class="btn btn-primary" href="{{route('task.create')}}">
                <i class='bx bxs-plus-circle'></i> Add Task
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert"
                    style="width: 50%; margin: auto; margin-left: 1%;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Error!</strong> Kesalahan validasi. Silakan periksa masukan Anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if (count($task) < 1)
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-center" style="padding-top: 50px; margin-left: -10%">Data not found</td>
                        </tr>
                    </tbody>
                @else
                    @foreach ($task as $value)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->task->title }}</td>
                                <td>{{ $value->category->name }}</td>
                                <td>{{ $value->task->desc }}</td>
                                <td>{{ $value->task->due_date }}</td>
                                <td>{{ $value->task->completed == 0 ? 'ToDo' : 'Completed' }}</td>
                                <td>
                                    <form action="{{ route('category_task.updateStatus', $value->task->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        @if ($value->task->completed == false)
                                            <input type="hidden" name="updateStatus" value="1">
                                            <button type="submit" class="btn btn-info"
                                                onclick="return confirm('Are you sure you want to complete this Task?')">Complete
                                                this task</button>
                                        @else
                                            <input type="hidden" name="updateStatus" value="0">
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to fail complete this Task?')">Failed
                                                Complete this task</button>
                                        @endif
                                    </form>
                                    @if ($value->task->completed == 0)
                                        <a href="{{ route('task.edit', $value->task->id) }}" class="btn btn-primary">Edit</a>
                                    @endif
                                    <form action="{{ route('task.destroy', $value->task->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
@endsection
