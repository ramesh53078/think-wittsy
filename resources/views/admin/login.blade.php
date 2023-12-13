<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{url('admin/assets/img/think_wittsy_logo.png')}}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url('admin/assets/css/login.min.css')}}" type="text/css">

    <title>Think Wittsy Login</title>
</head>
<style>
    .mt-5, .my-5 {
    margin-top: 6rem!important;
}
</style>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card py-3 px-2 mt-5">
                    <p class="text-center mb-3 mt-2">SIGN IN WITH</p>
                    <div class="division">
                        <div class="row">
                            <div class="col-3"><div class="line l"></div></div>
                            <div class="col-6"><span>OR WITH MY EMAIL</span></div>
                            <div class="col-3"><div class="line r"></div></div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.authentication') }}">
                        @csrf
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{session('error')}}</strong> 
                            </div>
                         @endif
                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="@error('email') {{ $message }} @else Email @enderror" />
                          </div>
                         <div class="form-group">
                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="@error('password') {{ $message }} @else Password @enderror" />
                          </div>
                          <div class="row">
                              <div class="col-md-6 col-12">
                                  <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                  </div>
                              </div>
                              <div class="col-md-6 col-12 bn">Forgot password?</div>
                          </div>
                          <div class="form-group mt-3">
                              <button type="submit" class="btn btn-block btn-primary btn-lg"><small><i class="far fa-user pr-2"></i>Login</small></button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="{{url('admin/assets/demo/demo.js')}}"></script>

  <script>
    @if(session('success'))
            demo.showNotification('top','right','2','{{ session('success') }}')
        @endif

        @if(session('error'))
        demo.showNotification('top','right','4','{{ session('error') }}')
        @endif
  </script>
</html>