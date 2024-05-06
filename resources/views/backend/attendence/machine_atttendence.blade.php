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
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Check in</th>
                                        <th class="text-center">Check out</th>

                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($data as $key => $employee)
                                        <tr>
                                            <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $employee->user_name }}</td>
                                            <td class="text-center">
                                                {{ date('d-M-Y h:i A', strtotime(@$employee->check_in)) }}</td>
                                            <td class="text-center">
                                                {{ $employee->check_out ? date('d-M-Y h:i A', strtotime(@$employee->check_out)) : 'N/A' }}
                                            </td>

                                            {{-- {{ date('d-M-Y h:i A', strtotime(@$employee->check_in)) }} --}}
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


        // function Dtable(){
        //     $('.dataTable').DataTable({
        //           "lengthMenu": [100, 300, 500, 1000, 2000],
        //         dom: 'Bfrtip',
        //         buttons: [
        //            'pageLength','csv','excel', 'pdf','copy','colvis'
        //         ]
        //     });
        // }
    </script>
@endpush
