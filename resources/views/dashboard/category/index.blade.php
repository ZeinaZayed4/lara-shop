@extends('dashboard.layout')

@section('title')
    Categories
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>

        <a href="{{ url('/admin/categories/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            New Category
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Categories List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Icon</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if($cats->isNotEmpty())
                            @foreach($cats as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <img src="{{ asset($category->photo) }}" style="width: 200px">
                                    </td>
                                    <td>
                                        <i class="fas fa-{{ $category->icon }}"></i>
                                    </td>
                                    <td>
                                        <form action="{{ url('/admin/categories/' . $category->id) }}" method="post">
                                            <a href="{{ url("admin/categories/$category->id") }}" class="btn btn-sm btn-info">
                                                View
                                            </a>
                                            <a href="{{ url("admin/categories/$category->id/edit") }}" class="btn btn-sm btn-warning">
                                                Edit
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-danger" role="alert">
                                        No Data Found!
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row">
                    <div class="col pt-5 d-flex justify-content-center">
                        {{ $cats->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
