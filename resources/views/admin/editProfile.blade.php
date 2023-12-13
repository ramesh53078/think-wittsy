@extends('admin.layouts.master')
@section('title','Edit-Profile')
@section('content')

<div class="row m-5">
    <div class="col-2">

    </div>
    <div class="col-6 justify-content-center">
        <div class="card card-info m-5">
          <div class="card-header">
            <h3 class="card-title">Edit Profile</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.update.profile') }}" method="POST">
              @csrf
              <!-- Name Field -->
              <div class="form-group">
                <label>Name:</label>
                <input type="text" value="{{ $user->name }}" placeholder="Enter Name" class="form-control" name="name">
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <!-- /.form group -->

              <!-- Email Field -->
              <div class="form-group">
                <label>Email:</label>

                <div class="input-group">
                  <input type="email" value="{{ $user->email }}" placeholder="Enter Email" class="form-control" name="email">
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
      </div>

</div>
@endsection
