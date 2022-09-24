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
        <div>
                <div class="card-body text-center" style="">
                    <div>
                        <h5 class="card-title">Import</h5>
                        <i class='bx bx-import text-blue fs-1 mb-5'></i>
                    </div>
                    <form id="dropzone" action="{{route('import.import')}}"
                        enctype="multipart/form-data" class="btn btn-outline-info dropzone rounded" style="border: 2px #0dcaf0 solid;">
                        @csrf
                    </form>
                </div>
        </div>

    </div>

    <script type="text/javascript">
    var totalsize = 0.0;
        // Configuration for DropzoneJS
        Dropzone.options.dropzone = {
            dictDefaultMessage: "Drop CSV files or click here!", // Introducing a more straight forward message to the user
            paramName: "shifts", // Name used for file transfer
            maxFilesize: 2, // Max size for upload in MB
            timeout: 180000,
            init: function() {
                dropzone = this;
                this.on("addedfile", function(file) { // Event when file is added
                    // Front end validation on the what type the file is, in the process making sure it is CSV
                    if (file.type != "text/csv") {
                        // In case the file isn't CSV display an error notification with iziToast
                        iziToast.error({
                            title: 'Error',
                            message: "Only CSV is accepted. Your file is " + file.type,
                        });
                        done();
                    } else {
                        // If the file type is CSV, continue importing and display a message to the user
                        iziToast.info({
                            title: 'Importing',
                            message: "The file is being imported, don't refresh the page.",
                        });
                    }
                });
                this.on("error", function(file, response,xhr) {
                    // Checking what the error is
                    let message = "";
                    if (response.errors) {
                        message = response.errors[0];
                    } else if (response.error) {
                        message = response.error;
                    } else {
                        message = "Importing failed. Make sure your file follows the given rules."
                    }
                    // In case errors happen with uploading, show the user what the error is with a notificaction through iziToast
                    iziToast.error({
                        title: 'Error',
                        message: message,
                    });
                });
                this.on("success", function(file, response) {
                    // If the file is good and is imported, display successful notification through iziToast and write the given message from back-end
                    iziToast.success({
                        title: 'Success',
                        message: response,
                    });
                });

            }
        };
    </script>
</body>
@stop
