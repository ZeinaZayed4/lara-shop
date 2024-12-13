@extends('dashboard.layout')

@section('title')
    Products
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>

        <a href="{{ url('/admin/product') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            Back to Products
        </a>
    </div>

    <form action="{{ url('/admin/product') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">New Product</h6>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="form-group">
                    <label>Categories</label>
                    <select class="custom-select" name="category_id">
                        <option selected value="">Select Category</option>
                        @foreach($cats as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" value="0">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="text" name="stock" class="form-control" value="0">
                    @error('stock')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="10"></textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Photo</label>
                    <div class="custom-file mb-3">
                        <input type="file" name="photos[]" class="custom-file-input" multiple>
                        <label class="custom-file-label">Choose file...</label>
                        @error('photos')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
