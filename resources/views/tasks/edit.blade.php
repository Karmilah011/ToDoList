@extends('template.master')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">edit Task</div>
                <div class="card-body">
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
                    <form action="{{ route('task.update',$task->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="desc">Category :</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $item)
                                <option value="{{$item->id}}" @if($categoryID == $item->id) @selected(true) @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">title :</label>
                            <input type="text" name="title" class="form-control"  value="{{$task->title}}" required>
                        </div>
                        <div class="form-group">
                            <label for="desc">desc :</label>
                            <textarea name="desc" id="desc" cols="30" rows="10" required class="form-control">{{$task->desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="due_date">due_date :</label>
                            <input type="date" name="due_date" class="form-control" required value="{{$task->due_date}}">
                        </div>
                        {{-- <input type="hidden" name="category_id" value="1"> --}}
                        {{-- <input type="hidden" name="category_id" value="{{$category->id}}"> --}}
                        <button type="submit" class="btn btn-primary">Edit Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
@endsection