@extends('admin.layouts.master')
@section('title')
    HidenCate
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="/admin/categories">Categories</a></li>
                        <li class="breadcrumb-item active">Hide</li>
                    </ol>
                </div>
                <h5 class="page-title">Categories</h5>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h2 class="mb-4">
                                    <span class="badge badge-default"> Categories Hide </span>
                                </h2>
                                @include('admin.layouts.partials.error')
                                <div class="d-flex justify-content-between mb-4" style="width: 100%">
                                    <div>
                                        <a href="{{url("categories")}}" class="btn btn-secondary mo-mb-2" data-toggle="tooltip"
                                            data-placement="left" title="" data-original-title="List Categories">
                                            <i class="fa-solid fa-list"></i>
                                        </a>
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
                                            @if (isset($message))
                                                <p>{{ $message }}</p>
                                            @else
                                                @foreach ($cateHide as $index => $catesHide)
                                                    <tr>
                                                        <th>{{ $index + 1 }}</th>
                                                        <td>{{ $catesHide->name }}</td>
                                                        <td>
                                                            <form action="{{ route('categories.unlock', $catesHide->id) }}" method="POST">
                                                                @csrf
                                                                <button onclick="return confirm('Eye {{ $catesHide->name }}')"  title="Look" class="btn btn-success"><i
                                                                    class="fa-solid fa-eye" style="color: white"></i></button>
                                                            </form>
                                                            
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
