<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    
    <!-- Logo / Title -->
    <a class="navbar-brand" href="#">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <!-- Toggle button (mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbarNav">
      
      <!-- Left links -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#">
            <i class="bi bi-house-door"></i> Home
          </a>
        </li>
      </ul>

      <!-- Right buttons -->
      <div class="d-flex gap-2">

        <!-- Custom button -->
      

        <!-- Logout button -->
        <form method="GET"  action=" {{ route('logout') }}">
          <button type="submit" class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i> تسجيل الخروج
          </button>
        </form>

      </div>

    </div>
  </div>
</nav>
