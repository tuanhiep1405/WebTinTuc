@extends('admin.layouts.master')
@section('title')
    Edit User
@endsection
@section('content')

<div class="float-right page-breadcrumb">
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">SB Admin</a></li>
       <li class="breadcrumb-item"><a href="{{ url('user') }}">Users</a></li>
       <li class="breadcrumb-item active">Edit</li>
   </ol>
</div>
<br>
    <h1 class="text-center">Edit User</h1>

    
    @include('admin.layouts.partials.error')

    <div class="container">
        <form method="POST" action="{{ route('user.update', $data->id) }}" >
         @csrf
         @method('PUT')
            <div class="mb-3 row">
                <label for="email" class="col-2 col-form-label">Email</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="email" id="email" value="{{ $data->email }}"
                        disabled />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-2 col-form-label">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                        value="{{ $data->name }}" disabled />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-2 col-form-label">Role</label>
                <div class="col-8">
                    <select name="role" id="role" class="form-control">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ $data->role === $role ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Action
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
