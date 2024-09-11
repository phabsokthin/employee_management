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

                toastr.error("សូមបំពេញទាំងអស់")
            </script>
        @elseif (Session::has('delete'))
            <script>
                toastr.options = {
                    'progressBar': true,
                    'closeButton': true
                }

                toastr.success('{{ Session::get('delete') }}')
            </script>
        @elseif (Session::has('edit'))
            <script>
                toastr.options = {
                    'progressBar': true,
                    'closeButton': true
                }

                toastr.success("{{ Session::get('edit') }}")
            </script>
        @endif




        <div class="row">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <p><i class='bx bxs-user-badge'></i> បញ្ចូលវត្តមានបុគ្គលិក</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('save_attancedance') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">ឈ្មោះបុគ្គលិក</label>
                                    <select name="emp_name" class="form-control" id="">
                                        <option value="">--ជ្រើសរើស--</option>
                                        @foreach ($employee as $item)
                                            <option value="{{ $item->emp_id }}">{{ $item->emp_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">មុខដំណែង</label>
                                    <select name="position" class="form-control" id="">
                                        <option value="">--ជ្រើសរើស--</option>
                                        @foreach ($position as $value)
                                            <option value="{{ $value->no }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">ស្ថានភាព</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="">--ជ្រើសរើស--</option>
                                        <option value="ច្បាប់">ច្បាប់</option>
                                        <option value="អត់ច្បាប់">អត់ច្បាប់</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">ផ្សេងៗ</label>
                                    <textarea name="des" rows="6" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mt-3">
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
                        <p><i class='bx bxs-user-detail'></i> បញ្ជីវត្តមានបុគ្គលិក</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ឈ្មោះបុគ្គលិក</th>
                                    <th>មុខដំណែង</th>
                                    <th>ស្ថានភាព</th>
                                    <th>ផ្សេងៗ</th>
                                    <th>កាលបរិច្ឆេត</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attandance as $item)
                                    <tr>
                                        <td>{{ $item->at_id }}</td>
                                        <td>{{ $item->emp_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#update{{ $item->at_id }}">Edit</button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $item->at_id }}">Delete</button>
                                        </td>
                                    </tr>

                                    <!-- edit -->
                                    <div class="modal fade" id="update{{ $item->at_id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="POST" enctype="multipart/form-data" action="{{ route('update_att', $item->at_id) }}">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="">ឈ្មោះបុគ្គលិក</label>
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
                                                            <div class="col-md-6">
                                                                <label for="">មុខដំណែង</label>
                                                                <select name="position" class="form-control" id="">
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
                                                            <div class="col-md-4">
                                                                <label for="">ស្ថានភាព</label>
                                                                <select name="status" class="form-control" id="">
                                                                    <option value="{{ $item->status }}">
                                                                        {{ $item->status }}</option>
                                                                    <option value="ច្បាប់">ច្បាប់</option>
                                                                    <option value="អត់ច្បាប់">អត់ច្បាប់</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">ផ្សេងៗ</label>
                                                                <textarea name="des" rows="6" class="form-control">{{ $item->description }}</textarea>
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

                                    {{-- delete --}}
                                    <div class="modal fade" id="delete{{ $item->at_id }}" data-bs-backdrop="static"
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
                                                            class="text-danger">{{ $item->emp_name }}</span></h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('delete_att', $item->at_id) }}"
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
