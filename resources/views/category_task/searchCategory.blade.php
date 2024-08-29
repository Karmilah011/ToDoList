@extends('template.master')
@section('content')
    <div class="card">
        <div class="d-flex justify-content-end pt-2" style="padding-right: 25px">
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                   Select Category
                </button>
                <ul class="dropdown-menu" style="">
                    @foreach ($categories as $item)
                        <li><a class="dropdown-item" href="{{route('category_task.allTask',$item->id)}}">{{$item->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>     
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>                   
            </table>
        </div>
    </div>
@endsection
