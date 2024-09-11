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
        @elseif(count($errors) > 0)
            <script>
                toastr.options = {
                    'progressBar': true,
                    'closeButton': true
                }

                toastr.error("សូមបំពេញឲគ្រប់ចន្លោះ")
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
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <p><i class='bx bx-history'></i> បញ្ចូលប្រវត្តិរូបបុគ្គលិក</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('save_history') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">បុគ្គលិក</label>
                                    <select name="emp_name" class="form-control" id="">
                                        <option value="">--ជ្រើសរើស--</option>
                                        @foreach ($history as $item)
                                            <option value="{{ $item->emp_id }}">{{ $item->emp_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">មុខដំណែង</label>
                                    <input type="text" name="position" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">រយ:ពេលធ្វើការ</label>
                                    <input type="text" class="form-control" name="peroid">
                                </div>
                                <div class="col-md-4">
                                    <label for="">ទីតាំង</label>
                                    <textarea name="location" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">កាលបរិច្ឆេតការងារ</label>
                                    <input type="text" name="date_work" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success">រក្សាទុក</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <p>បញ្ជីប្រវត្តិបុគ្គលិក</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>បុគ្គលិក</th>
                                    <th>មុខដំណែង</th>
                                    <th>រយ:ពេលធ្វើការ</th>
                                    <th>ទីតាំង</th>
                                    <th>កាលបរិច្ឆេតការងារ</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($joinHistory as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->emp_name }}</td>
                                        <td>{{ $row->position }}</td>
                                        <td>{{ $row->period }}</td>
                                        <td>{{ $row->work_place }}</td>
                                        <td>{{ $row->year }}</td>
                                        <td>
                                            <a href="{{ route('view_detail', $row->id) }}"><button class="btn btn-warning btn-sm">View</button></a>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $row->id }}">Edit</button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $row->id }}">Delete</button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">លុប</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="POST" enctype="multipart/form-data" action="{{ route('update_history', $row->id) }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="">បុគ្គលិក</label>
                                                                <select name="emp_name" class="form-control" id="">

                                                                    @foreach ($history as $items)
                                                                        @if ($row->emp_id == $items->emp_id)
                                                                            <option selected value="{{ $items->emp_id }}">
                                                                                {{ $items->emp_name }}</option>
                                                                        @else
                                                                            <option value="{{ $items->emp_id }}">
                                                                                {{ $items->emp_name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="">មុខដំណែង</label>
                                                                <input type="text" name="position"
                                                                    value="{{ $row->position }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="">រយ:ពេលធ្វើការ</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $row->period }}" name="peroid">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="">ទីតាំង</label>
                                                                <textarea name="location" class="form-control">{{ $row->work_place }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">កាលបរិច្ឆេតការងារ</label>
                                                                <input type="text" name="date_work"
                                                                    value="{{ $row->year }}" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn btn-success btn-sm">រក្សាទុក</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="delete{{ $row->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">លុប</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Are you sure delete <span
                                                            class="text-danger">{{ $item->emp_name }}</span> </h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('delete_history', $row->id) }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
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
