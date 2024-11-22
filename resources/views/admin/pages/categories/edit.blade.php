@extends('admin.layouts.master')
@section('title')
    EditCategories
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('categories') }}">Categories</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h5 class="page-title">Edit Category</h5>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="mb-4">
                                    <span class="badge badge-default"> Edit Category </span>

                                </h2>
                                @include('admin.layouts.partials.error')
                                <form action="{{ route('categories.update', $cate->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="d-block">ID</label>
                                        <input class="form-control" type="text" name="id"
                                            value="{{ $cate->id }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Name</label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $cate->name }}">
                                    </div>
                                    <button type="submit" class="btn btn-warning waves-effect waves-light float-right"
                                        name="btn-edit">
                                        Edit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
