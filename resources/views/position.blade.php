@extends('layout.layout')
@section('content')
    <div class="container">

        @if (Session::has('success'))
            <script>
                toastr.options = {
                    'progressBar': true,
                    'closeButton': true
                }
                toastr.success("{{ Session::get('success') }}")
            </script>
        @elseif (count($errors) > 0)
            <script>
                toastr.options = {
                    "progressBar": true,
                    "closeButton": true
                }

                toastr.error("សូមបំពេញឱគ្រប់ចម្លោះ");
            </script>
        @elseif (Session::has('delete'))
            <script>
                toastr.options = {
                    'progressBar': true,
                    'closeButton': true
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
            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="card-header">
                        <p><i class='bx bx-repost'></i> មុខដំណែង</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('save_position') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">បុគ្គលិក</label>
                                    <select name="emp_name" class="form-control" id="">
                                        <option selected disabled value="">--ជ្រើសរើស--</option>
                                        @foreach ($employee as $item)
                                            <option value="{{ $item->emp_id }}">{{ $item->emp_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-12">
                                    <label for="">មុខដំណែង</label>
                                    <input type="text" name="position" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success mt-3">រក្សាទុក</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">
                        <p>បញ្ជីបុគ្គលិក</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>បុគ្គលិក</th>
                                    <th>មុខដំណែង</th>
                                    <th>ថ្ងៃទី</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($position as $item)
                                    <tr>
                                        <td>{{ $item->no }}</td>
                                        <td>{{ $item->emp_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $item->no }}">Delete</button>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $item->no }}">Edit</button>
                                        </td>
                                    </tr>

                                    <!-- update -->
                                    <div class="modal fade" id="edit{{ $item->no }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="{{ route('update_pos', $item->no) }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                            <label for="">បុគ្គលិក</label>
                                                            <select name="emp_name" class="form-control"  id="">
                                                                @foreach ($employee as $value )
                                                                    @if($item->emp_id == $value->emp_id)
                                                                        <option selected  value="{{ $value->emp_id }}">{{ $value->emp_name }}</option>
                                                                        @else
                                                                        <option value="{{ $value->emp_id }}">{{ $value->emp_name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <label for="">មុខដំណែង</label>
                                                            <input type="text" value="{{ $item->name }}" name="position" class="form-control">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button class="btn btn-primary btn-sm">រក្សាទុក</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete -->
                                    <div class="modal fade" id="delete{{ $item->no }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Are you sure delete <span
                                                            class="text-danger">{{ $item->emp_name }}</span></h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('delete_pos', $item->no) }}"
                                                        class="btn btn-danger btn-sm">Yes</a>
                                                </div>
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
@endsection
