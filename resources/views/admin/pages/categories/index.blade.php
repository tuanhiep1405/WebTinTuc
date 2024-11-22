@extends('admin.layouts.master')
@section('title')
    CategoriesAdmin
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item active">Categories</li> --}}
                    </ol>
                </div>
                <h5 class="page-title">Categories</h5>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="mb-4">
                                    <span class="badge badge-default"> Add Category </span>
                                </h2>
                                <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="d-block">Name</label>
                                        <input class="form-control" type="text" placeholder="Name Category..."
                                            name="name">
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light float-right"
                                        name="btn-add">
                                        Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h2 class="mb-4">
                                    <span class="badge badge-default"> Categories </span>
                                </h2>
                               
                                <div class="d-flex justify-content-between mb-4" style="width: 100%">
                                    <div>
                                        
                                    </div>
                                    <div></div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            @foreach ($data as $index => $category)
                                                <tr>
                                                    <th>{{ $index + 1 }}</th>
                                                    <td>{{ $category['name'] }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <button title="Edit" class="btn btn-warning mr-2">
                                                                <a href="{{ route('user.edit', $category->id) }}"><i
                                                                        class="fa-solid fa-pen" style="color: white"></i></a>
                                                            </button>
                                                            <form action="{{ route('user.lock', $category->id) }}" method="POST">
                                                                @csrf
                                                                <button title="Look" class="btn btn-danger"><i
                                                                    class="fa-solid fa-eye-slash" style="color: white"></i></button>
                                                            </form>
                                                            
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
