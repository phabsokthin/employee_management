@extends('layout.layout')
@section('content')
    <div class="container">

        @if (Session::has('success'))
            <script>
                toastr.options = {
                    "progressBar": true,
                    "closeButton": true
                }

                toastr.success("{{ Session::get('success') }}")
            </script>
        @elseif (count($errors) > 0)
            <script>
                toastr.options = {
                    "progressBar": true,
                    "closeButton": true
                }

                toastr.error("Make sure as image, png and jpg");
            </script>
        @elseif (Session::has('delete'))
            <script>
                toastr.options = {
                    "progressBar": true,
                    "closeButton": true
                }

                toastr.success("{{ Session::get('delete') }}")
            </script>

        @elseif (Session::has('update'))
            <script>
                toastr.options = {
                    'progressBar': true,
                    'closeButton': true
                }
                toastr.success("{{ Session::get('update') }}")
            </script>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h6><i class='bx bx-user'></i>បញ្ចូលឈ្មោះបុគ្គលិក</h6>
                    </div>
                    <form method="POST" enctype="multipart/form-data" action="{{ route('save_employee') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">ឈ្មោះបុគ្គលិក</label>
                                    <input type="tex" name="empname" required class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">អាយុ</label>
                                    <input type="text" name="age" required class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">ភេទ</label>
                                    <select name="gender"  required class="form-control" id="">
                                        <option selected disabled value="">--ជ្រើសរើស--</option>
                                        <option value="ប្រុស">ប្រុស</option>
                                        <option value="ស្រី">ស្រី</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">លេខទូរស័ព្ទ</label>
                                    <input type="text" required name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">អុីម៉ែល</label>
                                    <input type="text" required name="email" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">ថ្ងៃខែឆ្នាំកំណើត</label>
                                    <input type="text" required name="dob" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="">អាស័យដ្ឋាន</label>
                                    <textarea name="address" required class="form-control"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <label for="">រូបថត</label>
                                    <input type="file" id="file" required name="photo" class="form-control">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success mt-3">រក្សាទុក</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>តារាងឈ្មោះ</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">

                            <head>
                                <tr>
                                    <th>#</th>
                                    <th>ឈ្មោះបុគ្គលិក</th>
                                    <th>អាយុ</th>
                                    <th>ភេទ</th>
                                    <th>លេខទូរស័ព្ទ</th>
                                    <th>អុីម៉ែល</th>
                                    <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                                    <th>អាស័យដ្ឋាន</th>
                                    <th>រូបថត</th>
                                    <th>Action</th>
                                </tr>
                            </head>
                            <tbody>
                                @foreach ($employee as $item)
                                    <tr>
                                        <td>{{ $item->emp_id }}</td>
                                        <td>{{ $item->emp_name }}</td>
                                        <td>{{ $item->age }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->dob }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>
                                            <img src="./upload/{{ $item->photo }}" width="50px" class="img-thumbnail"
                                                alt="">
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#update{{ $item->emp_id }}">Edit</button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $item->emp_id }}">Delete</button>
                                        </td>
                                    </tr>

                                    {{-- delete --}}
                                    <div class="modal fade" id="delete{{ $item->emp_id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">លុប</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Are you sure delete <span
                                                            class="text-danger">{{ $item->emp_name }}</span>?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('delete_emp', $item->emp_id) }}"
                                                        class="btn btn-danger">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- update --}}

                                    <div class="modal fade" id="update{{ $item->emp_id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">កែប្រែរ</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form  method="POST" enctype="multipart/form-data" action="{{ route('emp_update', $item->emp_id) }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <label for="">ឈ្មោះបុគ្គលិក</label>
                                                                <input type="tex" name="empname"
                                                                    value="{{ $item->emp_name }}" required
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="">អាយុ</label>
                                                                <input type="text" name="age"
                                                                    value="{{ $item->age }}" required
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <label for="">ភេទ</label>
                                                                <select  name="gender"  required class="form-control"
                                                                    id="">
                                                                    @if ($item->emp_id == $item->emp_id)
                                                                        <option  value="{{ $item->gender }}">
                                                                            {{ $item->gender }}</option>

                                                                        <option value="ប្រុស">ប្រុស</option>
                                                                        <option value="ស្រី">ស្រី</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label for="">លេខទូរស័ព្ទ</label>
                                                                <input type="text" value="{{ $item->phone }}"
                                                                    required name="phone" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <label for="">អុីម៉ែល</label>
                                                                <input type="text" value="{{ $item->email }}"
                                                                    required name="email" class="form-control">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="">ថ្ងៃខែឆ្នាំកំណើត</label>
                                                                <input type="text" value="{{ $item->dob }}"
                                                                    required name="dob" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="">អាស័យដ្ឋាន</label>
                                                                <textarea name="address" required class="form-control">{{ $item->address }}</textarea>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="">រូបថត</label>
                                                                <input id="file" type="file"  name="photo"
                                                                    class="form-control">

                                                                <p>រូបភាពចាស់</p>
                                                                <img src="upload/{{ $item->photo }}" width="100px"
                                                                    alt="">
                                                                <input type="hidden" name="photo1" value="{{ $item->photo }}">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" type="button"
                                                            class="btn btn-primary">រក្សាទុក</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#file').bind('change', function() {
                var fileSize = this.files[0].size / 1024 / 1024;
                if (fileSize > 2) { // 2M
                    alert('File is too big!');
                    $('#file').val('');
                }
            });
        });

    </script>
@endsection
