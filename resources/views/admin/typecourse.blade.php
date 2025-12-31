<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

   <x-navbar />
   <div class="row justify-content-center align-items-center vh-100"> 
   <div class="col-md-4">
   <div class="card shadow" >
   <div class="card-body">


@if(session()->has('message'))

    <div class="alert alert-danger" role="alert">
 {{ session('message') }}</div>
 @endif

 <form id="typeform" method="POST" action="{{ route('typesave') }}" enctype="multipart/form-data">
     @csrf
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" name="title" class="form-control" placeholder="Enter title course" required >
            </div>
             <div class="mb-3">
              <label class="form-label">Description</label>
              <input type="text" name="description" class="form-control" placeholder="Enter title course" required >
            </div>
           <div class="mb-3">
               <label class="form-label">Image</label>
               <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
                   <button type="submit" class="btn btn-primary w-100">حفظ</button>

    </form>


       </div>


    </div>
</div>
   </div>
</body>
</html>