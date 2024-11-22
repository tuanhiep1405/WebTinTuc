@extends('admin.layouts.master')
@section('title')
    UserAdmin
@endsection
@section('content')
    <div class="float-right page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">SB Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ url('user') }}">Users</a></li>
            <li class="breadcrumb-item active">ListLook</li>
        </ol>
    </div>
    <br>
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">User</h1>
                @include('admin.layouts.partials.error')

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataUser </h6>
                        <button class="btn btn-dark">
                            <a href="{{route('user.index')}}" style="color: white"><i class="fa-solid fa-list"></i></a>
                        </button>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>


                                                <form action="{{ route('user.unlock', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button title="Look" class="btn btn-success"><i
                                                            class="fa-solid fa-lock-open" style="color: white"></i></button>
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
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->



    </div>
@endsection
