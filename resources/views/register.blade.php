@extends('layout.layout')
@section('content')

    <div class="container">

        @if(count($errors) > 0)

        <script>
            toastr.options ={
                'progressBar': true,
                'closeButton': true
            }
            toastr.error("សូមបំពេញគ្រប់ចន្លោះ")
        </script>


        @elseif(Session::has('success'))

            <script>

                toastr.options = {
                    'progressBar': true,
                    'closeButton': true
                }

                toastr.success("{{ Session::get('success') }}")
            </script>


        @endif

        <div class="row d-flex justify-content-center">
            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-header">
                        <p><i class='bx bxs-user-account'></i> User Account</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register_post') }}">
                            @csrf
                            <label for="">ឈ្មោះអ្នកប្រើប្រាស់</label>
                            <input type="text" name="name" class="form-control">
                            <label for="">អុីម៉ែល</label>
                            <input type="email" name="email" class="form-control">
                            <label for="">លេខសម្ងាត់</label>
                            <input type="text" name="password" class="form-control">
                            <button type="submit" class="btn btn-success mt-3 ">ចុះឈ្មោះប្រើប្រាស់</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
