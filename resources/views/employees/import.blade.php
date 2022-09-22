@extends('layouts.master')

@section('title', 'Aarons Department | Import')

@section('js')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@stop

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@stop

@section('content')

<body>
    <div class="container">
        <div class=" d-flex align-items-center justify-content-center" style="height:90vh;">
                <div class="card-body text-center" style="">
                    <div>
                        <h5 class="card-title">Import</h5>
                        <i class='bx bx-import text-blue fs-1 mb-5'></i>
                    </div>
                    <form id="dropzone" action="#"
                        enctype="multipart/form-data" class="btn btn-outline-info dropzone rounded" style="border: 2px #0dcaf0 solid;">
                        @csrf
                    </form>
                </div>
        </div>

    </div>

<script>
  Dropzone.options.myGreatDropzone = { // camelized version of the `id`
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 5, // MB
    accept: function(file, done) {
      if (file.name == "test.jpg") {
        done("test");
      }
      else { done(); }
    }
  };
</script>
</body>
@stop
