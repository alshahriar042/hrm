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
                        <h4 class="page-title">Attendence Details</h4>
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
                                        <th class="text-center">Month - Year</th>
                                        {{-- @if (Auth::user()->hasPermission('users.show') || Auth::user()->hasPermission('users.edit') || Auth::user()->hasPermission('users.destroy')) --}}
                                        <th class="text-center">Actions</th>
                                        {{-- @endif --}}
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($attendances as $key => $attendance)
                                        <tr>
                                            <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                            <td class="text-center">{{ date('F', mktime(0, 0, 0, $attendance->month, 1)) }} - {{ $attendance->year }}</td>
                                            <td class="text-center">
                                                {{-- @if (Auth::user()->hasPermission('users.edit')) --}}
                                                    <a href="{{ route('my.attendance.report',['month' => $attendance->month, 'year' => $attendance->year]) }}" class="btn btn-primary btn-sm" title="Edit">
                                                        <i class="fa fa-list"></i>
                                                        <span>Attendence Report</span>
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
