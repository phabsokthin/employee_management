@extends('layout.layout')
@section('content')

    <div class="container">
        <div class="row  d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <p><i class='bx bxs-user-detail' ></i> មើលប្រវត្តិរូប</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <img src="/upload/{{ $view->photo }}" class="img-thumbnail" style="width: 200px" alt="">
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <p>ឈ្មោះបុគ្គលិក: <b>{{ $view->emp_name }}</b></p>
                            </div>
                            <div class="col-md-6">
                                <p>ថ្ងៃខែឆ្នាំកំណើត: <b>{{ $view->dob }}</b></p>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <p>លេខទូរស័ព្ទ: <b>{{ $view->phone }}</b></p>
                            </div>
                            <div class="col-md-6">
                                <p>ថ្ងៃខែឆ្នាំកំណើត: <b>{{ $view->email }}</b></p>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <p>មុខដំណែង: <b>{{ $view->position }}</b></p>
                            </div>
                            <div class="col-md-6">
                                <p>រយ:ពេលធ្វើការ: <b>{{ $view->period }}</b></p>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <p>កាលបរិច្ឆេតការងារ: <b>{{ $view->year }}</b></p>
                            </div>
                            <div class="col-md-6">
                                <p>ទីតាំង: <b>{{ $view->work_place }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-success" onclick="window.print()"><i class='bx bx-printer' ></i>Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
