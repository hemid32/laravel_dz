<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container">
  <div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-4">

      <div class="card shadow">
        <div class="card-body">
          <h3 class="text-center mb-4">Login</h3>


@if(session()->has('message'))

    <div class="alert alert-danger" role="alert">
 {{ session('message') }}</div>
 @endif



          <form id="loginForm" method="POST" action="{{ route('loginadmin') }}">
              @csrf
            <!-- Email -->
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter email" required >
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter password" required >
            </div>

            <!-- Remember me -->
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox">
              <label class="form-check-label">
                Remember me
              </label>
            </div>

            <!-- Button -->
            <button type="submit" class="btn btn-primary w-100">
              Login
            </button>
          </form>
<div id="alert-container"></div>

        </div>
  
    </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>




