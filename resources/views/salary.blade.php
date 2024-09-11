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
                    'progressBar': true,
                    'closeButton': true
                }

                toastr.error("សូមបំពេញឱគ្រប់ចម្លោះ")
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
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <p><i class='bx bx-money'></i> បញ្ចូលប្រាក់ខែបុគ្គលិក</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('save_salary') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">ចំនួន</label>
                                    <input type="text" name="amount" class="form-control">
                                </div>
                                <div class="col-md-5">
                                    <label for="">បុគ្គលិក</label>
                                    <select name="emp_name" class="form-control" id="">
                                        <option value="">--ជ្រើសរើស--</option>
                                        @foreach ($employee as $item)
                                            <option value="{{ $item->emp_id }}">{{ $item->emp_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">មុខដំណែង</label>
                                    <select class="form-control" name="position" id="">
                                        <option value="">--ជ្រើសរើស--</option>
                                        @foreach ($position as $value)
                                            <option value="{{ $value->no }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">រយ:ពេល</label>
                                    <textarea name="period" class="form-control" rows="6" cols="8"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <button type="submit" name="submit" class="btn btn-success">រក្សាទុក</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p>បញ្ជីប្រាក់ខែបុគ្គលិក</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ចំនួន</th>
                                    <th>បុគ្គលិក</th>
                                    <th>មុខដំណែង</th>
                                    <th>រយ:ពេល</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salary as $item)
                                    <tr>
                                        <td>{{ $item->sid }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->emp_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->period }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $item->sid }}">Edit</button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $item->sid }}">Delete</button>
                                        </td>
                                    </tr>

                                    {{-- update --}}

                                    <div class="modal fade" id="edit{{ $item->sid }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="POST" enctype="multipart/form-data"
                                                    action="{{ route('update_salary', $item->sid) }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="">ចំនួន</label>
                                                                <input type="text" name="amount"
                                                                    value="{{ $item->amount }}" class="form-control">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label for="">បុគ្គលិក</label>
                                                                <select name="emp_name" class="form-control" id="">

                                                                    @foreach ($employee as $items)
                                                                        @if ($item->emp_id == $items->emp_id)
                                                                            <option selected value="{{ $items->emp_id }}">
                                                                                {{ $items->emp_name }}</option>
                                                                        @else
                                                                            <option value="{{ $items->emp_id }}">
                                                                                {{ $items->emp_name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="">មុខដំណែង</label>
                                                                <select class="form-control" name="position" id="">

                                                                    @foreach ($position as $values)
                                                                        @if ($item->no == $values->no)
                                                                            <option selected value="{{ $values->no }}">
                                                                                {{ $values->name }}</option>
                                                                        @else
                                                                            <option value="{{ $values->no }}">
                                                                                {{ $values->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">រយ:ពេល</label>
                                                                <textarea name="period" class="form-control" rows="6" cols="8">{{ $item->period }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm">រក្សាទុក</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="delete{{ $item->sid }}" data-bs-backdrop="static"
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
                                                    <a href="{{ route('delete_salary', $item->sid) }}"
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
