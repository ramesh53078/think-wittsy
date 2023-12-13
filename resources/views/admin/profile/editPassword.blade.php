@extends('admin.layouts.master')
@section('title','Edit-Password')
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
            <form action="{{ route('admin.update.password') }}" method="POST">
              @csrf
              <!-- Name Field -->
              <div class="form-group">
                <label>Old Password:</label>
                <input type="password" name="old_password" placeholder="Enter Old Password" class="form-control" name="name">
                @error('old_password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <!-- /.form group -->

              <div class="form-group">
                <label>New Password:</label>
                <div class="input-group">
                  <input type="password" name="new_password" placeholder="Enter New Password" class="form-control" name="name">
                  <div class="input-group-append">
                    <span class="input-group-text  toggle-password" style="color:black" onclick="togglePassword(this)">&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i></span>
                  </div>
                </div>
                @error('new_password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label>Confirm Password:</label>
                <div class="input-group">
                  <input type="password" name="confirm_password" placeholder="Enter Confirm Password" class="form-control" name="email">
                  <div class="input-group-append">
                    <span class="input-group-text toggle-password" style="color:black" onclick="togglePassword(this)">&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i></span>
                  </div>
                </div>
                @error('confirm_password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
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

<script>
  function togglePassword(iconElement) {
    var passwordInput = iconElement.parentElement.previousElementSibling;
    var toggleIcon = iconElement.firstElementChild;
    if (passwordInput) {
      if (passwordInput.getAttribute('type') === 'password') {
        passwordInput.setAttribute('type', 'text');
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.setAttribute('type', 'password');
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }
    }
  }
</script>

@endsection
