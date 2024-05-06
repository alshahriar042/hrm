@extends('backend.master')

@push('css')
@endpush

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Attendence Manage</h4>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">#SL</th>
                                        <th class="text-center">Employee ID</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Joining Date</th>
                                        <th class="text-center">Status</th>
                                        {{-- @if (Auth::user()->hasPermission('users.show') || Auth::user()->hasPermission('users.edit') || Auth::user()->hasPermission('users.destroy')) --}}
                                        <th class="text-center">Actions</th>
                                        {{-- @endif --}}
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($employees as $key => $employee)
                                        <tr>
                                            <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $employee->employee_id }}</td>
                                            <td class="text-center">{{ $employee->name }}</td>
                                            <td class="text-center">{{ $employee->department->name }}</td>
                                            <td class="text-center">{{ date('d M, Y', strtotime($employee->joining_date)) }}</td>
                                            <td class="text-center">
                                                @if($employee->status == true)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{-- @if (Auth::user()->hasPermission('users.edit')) --}}
                                                    <a href="{{ route('attendance.details',$employee->id) }}" class="btn btn-primary btn-sm" title="Attendence Details">
                                                        <i class="fa fa-list"></i>
                                                        <span>Attendence Details</span>
                                                    </a>
                                                {{-- @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
@endsection
