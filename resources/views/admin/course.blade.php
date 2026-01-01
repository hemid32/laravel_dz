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



          <form id="courseForm" method="POST" action="{{ route('coursesave') }}">
              @csrf
            <div class="mb-3">
              <label class="form-label">Title Course</label>
              <input type="text" name="title" class="form-control" placeholder="Enter title" required >
            </div>


     <div class="mb-3">
    <label class="form-label">Course Type</label>
    <select name="type_course_id" class="form-select" required>
        <option value="">-- Select Course Type --</option>

        @foreach ($typeCourses as $type)
            <option value="{{ $type->id }}">
                {{ $type->title }}
            </option>
        @endforeach
    </select>
</div>

 <div class="mb-3">
               <label class="form-label">image</label>
               <input type="file" name="image" class="form-control" accept="image/*"  >
            </div>

             <div class="mb-3">
               <label class="form-label">stage</label>
               <input type="number" name="stage" class="form-control"  required >
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




