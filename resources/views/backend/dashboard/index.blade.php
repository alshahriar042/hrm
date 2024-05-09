@extends('backend.master')

@push('css')
<style>
    .in-time-btn{
        height: 120px;
        width: 120px;
        border: 1px solid #ffffff;
        border-radius: 50%;
        display: inline-block;
        font-weight: 600;
        font-size: 16px

    }
    .btn-content{
        border: 5px solid #e9ecef;
        height: 130px;
        width: 130px;
        border-radius: 50%;
    }
</style>

@endpush

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">HRM</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title -->

            @if (Auth::user()->role_id == 1)
            {{-- <div class="row">

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <a href="{{ route('users.index') }}">
                            <div class="card-heading p-4">
                                <div class="mini-stat-icon float-right">
                                    <i class="mdi mdi-cube-outline bg-primary  text-white"></i>
                                </div>
                                <div>
                                    <h5 class="font-16">Total Employee</h5>
                                </div>
                                <h3 class="mt-4">{{ count($employees) }}</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <a href="{{ route('dashboard') }}">
                            <div class="card-heading p-4">
                                <div class="mini-stat-icon float-right">
                                    <i class="mdi mdi-cube-outline bg-success text-white"></i>
                                </div>
                                <div>
                                    <h5 class="font-16">Today's Present</h5>
                                </div>
                                <h3 class="mt-4">{{ count($todayAttendence) }}</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <a href="{{ route('dashboard') }}">
                            <div class="card-heading p-4">
                                <div class="mini-stat-icon float-right">
                                    <i class="mdi mdi-cube-outline bg-warning text-white"></i>
                                </div>
                                <div>
                                    <h5 class="font-16">Today's Absent</h5>
                                </div>
                                <h3 class="mt-4">{{ count($employees) - count($todayAttendence) }}</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <a href="{{ route('departments.index') }}">
                            <div class="card-heading p-4">
                                <div class="mini-stat-icon float-right">
                                    <i class="mdi mdi-cube-outline bg-danger text-white"></i>
                                </div>
                                <div>
                                    <h5 class="font-16">Total Departments</h5>
                                </div>
                                <h3 class="mt-4">{{ count($departments) }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div> --}}
            @endif





            @if (Auth::user()->role_id == 1)
            <!-- START ROW -->
            {{-- <div class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Today's Attendence</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">SL</th>
                                            <th class="text-center" scope="col">Name</th>
                                            <th class="text-center" scope="col">ID</th>
                                            <th class="text-center" scope="col">Department</th>
                                            <th class="text-center" scope="col">Designation</th>
                                            <th class="text-center" scope="col">In Time</th>
                                            <th class="text-center" scope="col">Out Time</th>
                                            <th class="text-center" scope="col" colspan="2">Location</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>

                                            <td class="text-center">
                                                <div>
                                                    <img src="{{ $employee->avatar != null ? asset('upload/user_images/'.$employee->avatar) : asset('backend/assets/images/users/user-2.jpg') }}" alt="" class="thumb-md rounded-circle mr-2"> {{ $employee->name }}
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $employee->employee_id }}</td>
                                            <td class="text-center">{{ $employee->department->name }}</td>
                                            <td class="text-center">{{ $employee->designation }}</td>
                                            <td class="text-center">
                                                @if ($employee->todayAttendance != null)
                                                    @if ($employee->todayAttendance->in_time != null)
                                                        <span class="badge badge-success p-1">{{ date('h:i A', strtotime($employee->todayAttendance->in_time )) }}</span>
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                @else
                                                    <span>N/A</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($employee->todayAttendance != null)
                                                    @if ($employee->todayAttendance->out_time != null)
                                                        <span class="badge badge-danger p-1">{{ date('h:i A', strtotime($employee->todayAttendance->out_time )) }}</span>
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                @else
                                                    <span>N/A</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal_{{ @$employee->todayAttendance->id }}">
                                                    <i class="fa fa-map-marker"></i>
                                                    Map
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- END ROW -->
            @endif
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->

    @foreach ($employees as $employee)
        <!-- Modal -->
        <div class="modal fade" id="exampleModal_{{ @$employee->todayAttendance->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModal11Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                <div class="modal-content map-modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body map-modal-body">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14602.97121232825!2d90.4074325!3d23.7921714!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c798f1804fbd%3A0xc523633fc502d286!2sNEXTGEN%20INNOVATION%20LTD.!5e0!3m2!1sen!2sbd!4v1697005633449!5m2!1sen!2sbd"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"></iframe>
                        {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10039.982789267882!2d{{ @$employee->todayAttendance->in_longitude }}!3d-{{ @$employee->todayAttendance->in_latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad6424f6a33cd89%3A0xd1c09d964276b3b!2sYour%20Location!5e0!3m2!1sen!2sus!4v1697000905442 width="100%" height="550"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                        {{-- <div id="googleMap" style="width:100%;height:400px;"></div> --}}
                        {{-- <div id="map" style="width: 600px; height: 450px;"></div> --}}
                        {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14602.789651223764!2d90.4074325!3d23.7921714!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c14a4786893f%3A0x44b1abfd9c303bd1!2sVivasoft%20Limited!5e0!3m2!1sen!2sbd!4v1697002211385!5m2!1sen!2sbd" width="100%" height="550"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe> --}}

                    </div>
                    <div class="modal-footer modal__footer__content">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('js')

    <script>
        $(document).ready(function () {
            $('#inTimeForm').on('submit', function (e) {
                e.preventDefault();

                var url = $(this).attr('action');
                var formData = $(this).serialize();

                $("#inTimeBtn").css("display", "none");
                $("#inTimeLoadingBtn").css("display", "block");

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function (response) {
                        if (response.status  == 1) {
                            iziToast.success({
                                title: 'Success',
                                message: response.message,
                                position: 'topRight'
                            });
                        }

                        if (response.status  == 0) {
                            iziToast.error({
                                title: 'Error',
                                message: response.message,
                                position: 'topRight'
                            });
                        }
                        setTimeout(function() {
                            location.reload(true);
                            $("#inTimeBtn").css("display", "none");
                            $("#inTimeLoadingBtn").css("display", "none");
                        }, 3000);

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });


            $('#outTimeForm').on('submit', function (e) {
                e.preventDefault();

                var url = $(this).attr('action');
                var formData = $(this).serialize();

                $("#outTimeBtn").css("display", "none");
                $("#outTimeLoadingBtn").css("display", "block");

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function (response) {
                        if (response.status  == 1) {
                            iziToast.success({
                                title: 'Success',
                                message: response.message,
                                position: 'topRight'
                            });
                        }

                        if (response.status  == 0) {
                            iziToast.error({
                                title: 'Error',
                                message: response.message,
                                position: 'topRight'
                            });
                        }
                        setTimeout(function() {
                            location.reload(true);
                            $("#outTimeBtn").css("display", "none");
                            $("#outTimeLoadingBtn").css("display", "none");
                        }, 3000);

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
