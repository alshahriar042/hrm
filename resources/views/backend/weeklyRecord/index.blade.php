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
                                        <th class="text-center">SL</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Weekly Hours</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($weeklyData as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->name }}</td>

                                            @if ($data->total_weekly_hours == null)
                                                <td style="color: red">0 Hours 0 Minute</td>
                                            @else
                                                <td>{{ $data->total_weekly_hours }}</td>
                                            @endif


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
@push('js')
<script>
    $('#datatable').dataTable({
        "lengthMenu": [30, 50, 100],
        "ordering": false,
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'csv', 'excel', 'pdf', 'copy', 'colvis'
        ]
    });
    </script>
@endpush
