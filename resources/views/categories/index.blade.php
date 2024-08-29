@extends('template.master')
@section('content')
    <div class="card">
        <div class="d-flex justify-content-end pt-2" style="padding-right: 25px">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#smallModal">
                <i class='bx bxs-plus-circle'></i> Add Category
            </button>
        </div>
        <div class="table-responsive text-nowrap">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert" style="width: 50%; margin: auto; margin-left: 1%;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert" style="width: 55%; margin: auto; margin-left: 1%;">
                {{ session('error') }}
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
                        <th>Category Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if (count($categories) < 1)
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-center" style="padding-top: 50px;">Data not found</td>
                        </tr>
                    </tbody>
                @else
                @foreach ($categories as $item)
                <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('task.index', ['categories_id' => $item->id]) }}"
                                    style="color:black">
                                    {{ $item->name }}
                                </a>
                            </td>
                            <td>
                                {{-- <a href="/categories/edit/$cate->id" class="btn btn-primary">Ubah</a> --}}
                                <a href="{{ route('categories.edit', $item->id) }}"
                                    class="btn btn-primary">Edit</a>
                                {{-- <a href="{{ route('category_task.destroy',$item->id) }}" class="btn btn-danger">delete</a> --}}
                                <form action="{{ route('categories.destroy', $item->id) }}" method="POST"
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
        @include('categories.create')
    </div>
@endsection
