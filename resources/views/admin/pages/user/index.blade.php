@extends('admin.layouts.master')
@section('title')
    UserAdmin
@endsection
@section('content')

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
                        <br>
                        <button class="btn btn-danger">
                            <a style="color: white" href="{{ url('listLook') }}"><i class="fa-solid fa-user-slash"></i></a>
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
                                                <div class="d-flex">
                                                    <button title="Edit" class="btn btn-warning mr-2">
                                                        <a href="{{ route('user.edit', $item->id) }}"><i
                                                                class="fa-solid fa-pen" style="color: white"></i></a>
                                                    </button>
                                                    <form action="{{ route('user.lock', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button onclick="return confirm('Hide {{ $item->name }}')" title="Look" class="btn btn-danger"><i
                                                                class="fa-solid fa-lock" style="color: white"></i></button>
                                                    </form>
                                                </div>
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
