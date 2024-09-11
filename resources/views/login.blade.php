<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ចូល</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>
<body>
    <div class="container">

        @if(Session::has('error'))

            <script>
                toastr.options = {
                    'progressBar': true,
                    'closeButton': true,
                }

                toastr.error('{{ Session::get("error") }}')
            </script>

        @elseif (count($errors) >0)
        <script>
            toastr.options = {
                'progressBar': true,
                'closeButton': true,
            }

            toastr.error('សូមបញ្ចូលអុីម៉ែលនិងលេខសម្ងាត់')
        </script>

        @endif

        <div class="row d-flex justify-content-center align-items-center" style="width: 100%; height:100vh" >
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <p>ចូលប្រើប្រាស់</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login_post') }}">
                            @csrf
                            <label for="">អុីម៉ែល</label>
                            <input type="text" name="email" class="form-control">
                            <label for="">លេខសម្ងាត់</label>
                            <input type="password" name="password" class="form-control">
                            <button class="btn btn-success btn-sm mt-3">ចូលប្រើ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
