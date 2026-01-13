<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
      <script defer src="https://cdn.jsdelivr.net/npm/mathlive"></script>

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

 <form id="equationForm2" method="POST" action="{{ route('contentexercisesave') }}" enctype="multipart/form-data">
     @csrf


     <div class="mb-3">
    <label class="form-label">shois exercise for this content</label>
    <select name="exercise_id" class="form-select" required>
        <option value="">-- Select Course Type --</option>

        @foreach ($exercises as $type)
            <option value="{{ $type->id }}">
                {{ $type->title }}
            </option>
        @endforeach
    </select>
</div>

           <h1> def one. </h1>



            <div class="mb-3">
              <label class="form-label">def1</label>
              <input type="text" name="def1" class="form-control" placeholder="Enter title course" required >
            </div>


            <div class="mb-3">
         <label>eq1</label>

<math-field id="equationField"
            style="width:100%; border:1px solid #ccc; padding:10px;">
</math-field>

<input type="hidden" name="eq1" id="latex">
            </div>


   
           <div class="mb-3">
               <label class="form-label">img1</label>
               <input type="file" name="img1" class="form-control" accept="image/*" >
            </div>



           <h1> def tow. </h1>
            <div class="mb-3">
              <label class="form-label">def2</label>
              <input type="text" name="def2" class="form-control" placeholder="Enter title course"  >
            </div>


            <div class="mb-3">
         <label>eq2</label>

<math-field id="equationField2"
            style="width:100%; border:1px solid #ccc; padding:10px;">
</math-field>

<input type="hidden" name="eq2" id="latex2">
            </div>


   
           <div class="mb-3">
               <label class="form-label">img2</label>
               <input type="file" name="img2" class="form-control" accept="image/*" >
            </div>



           <h1> def three </h1>
            <div class="mb-3">
              <label class="form-label">def3</label>
              <input type="text" name="def3" class="form-control" placeholder="Enter title course"  >
            </div>


            <div class="mb-3">
         <label>eq3</label>

<math-field id="equationField3"
            style="width:100%; border:1px solid #ccc; padding:10px;">
</math-field>

<input type="hidden" name="eq3" id="latex3">
            </div>


   
           <div class="mb-3">
               <label class="form-label">img3</label>
               <input type="file" name="img3" class="form-control" accept="image/*" >
            </div>










                       <h1> Choices. </h1>


  <div class="mb-3">
         <label>choice1</label>

<math-field id="equationFieldChoice1"
            style="width:100%; border:1px solid #ccc; padding:10px;">
</math-field>

<input type="hidden" name="choice1" id="latexChoice1" >
            </div>

  <div class="mb-3">
         <label>choice2</label>

<math-field id="equationFieldChoice2"
            style="width:100%; border:1px solid #ccc; padding:10px;">
</math-field>

<input type="hidden" name="choice2" id="latexChoice2" >
            </div>


  <div class="mb-3">
         <label>choice3</label>

<math-field id="equationFieldChoice3"
            style="width:100%; border:1px solid #ccc; padding:10px;">
</math-field>

<input type="hidden" name="choice3" id="latexChoice3"  >
            </div>


              <div class="mb-3">
         <label>choice4</label>

<math-field id="equationFieldChoice4"
            style="width:100%; border:1px solid #ccc; padding:10px;">
</math-field>

<input type="hidden" name="choice4" id="latexChoice4"   >
            </div>


                   <button type="submit" class="btn btn-primary w-100">حفظ</button>

    </form>

    <script>
document.getElementById('equationForm2').addEventListener('submit', function (e) {



    const mf = document.getElementById('equationField');
    const mf2 = document.getElementById('equationField2');
    const mf3 = document.getElementById('equationField3');

    const ch1 = document.getElementById('equationFieldChoice1');
    const ch2 = document.getElementById('equationFieldChoice2');
    const ch3 = document.getElementById('equationFieldChoice3');
    const ch4 = document.getElementById('equationFieldChoice4');

    // تأكد أن MathLive محمّل
    if (!mf || typeof mf.getValue !== 'function') {
        alert('MathLive لم يتم تحميله');
        e.preventDefault();
        return;
    }

    const latex = normalizeLatex(mf.getValue('latex'));
    const latex2 = normalizeLatex(mf2.getValue('latex2'));
    const latex3 = normalizeLatex(mf3.getValue('latex3'));


        const choi1 = normalizeLatex(ch1.getValue('latexChoice1'));
        const choi2 = normalizeLatex(ch2.getValue('latexChoice2'));
        const choi3 = normalizeLatex(ch3.getValue('latexChoice3'));
        const choi4 = normalizeLatex(ch4.getValue('latexChoice4'));

    //console.log('LATEX:', latex); // للتأكد

    document.getElementById('latex').value = latex;
    document.getElementById('latex2').value = latex2;
    document.getElementById('latex3').value = latex3;

    document.getElementById('latexChoice1').value = choi1;
    document.getElementById('latexChoice2').value = choi2;
    document.getElementById('latexChoice3').value = choi3;
    document.getElementById('latexChoice4').value = choi4;

});



function normalizeLatex(latex) {
    if (!latex) return latex;

    return latex
        // placeholders
        .replace(/\\placeholder\{\}/g, '\\underline{\\hspace{1cm}}')

        // class (MathLive only)
        .replace(/\\class\{.*?\}\{(.*?)\}/g, '$1')

        // bbox
        .replace(/\\bbox\{.*?\}\{(.*?)\}/g, '$1')

        // spacing غير القياسي
        .replace(/\\kern\s*[\d.]+em/g, '')

        // حذف أوامر فارغة
        .replace(/\\,/g, ' ')
        .replace(/\\!/g, '');
}


</script>

       </div>


    </div>
</div>
   </div>
</body>
</html>

