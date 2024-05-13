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
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#SL</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Check in</th>
                                            <th class="text-center">Check out</th>
                                            <th class="text-center">Total Hours</th>
                                            <th class="text-center">Actions</th>


                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($data as $key => $employee)
                                            <tr>
                                                <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $employee->user_name }}</td>
                                                <td class="text-center">
                                                    {{ $employee->date ? date('d-M-Y', strtotime(@$employee->date)) : 'N/A' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $employee->check_in ? date('h:i A', strtotime(@$employee->check_in)) : 'N/A' }}
                                                    @if ($employee->check_in_remark)
                                                        - ({{ $employee->check_in_remark }})
                                                    @endif
                                                <td class="text-center">
                                                    {{ $employee->check_out ? date('h:i A', strtotime(@$employee->check_out)) : 'N/A' }}
                                                    @if ($employee->check_out_remark)
                                                        - ({{ $employee->check_out_remark }})
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($employee->check_out && $employee->check_in)
                                                        <?php
                                                        $checkIn = strtotime($employee->check_in);
                                                        $checkOut = strtotime($employee->check_out);
                                                        $diffInSeconds = $checkOut - $checkIn;
                                                        $diffInHours = floor($diffInSeconds / 3600); // Get the whole hours
                                                        $diffInMinutes = round(($diffInSeconds % 3600) / 60); // Round the remaining minutes
                                                        echo $diffInHours . 'h ' . $diffInMinutes . 'm'; // Display the difference in hours and minutes
                                                        ?>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    @if (!$employee->check_in_remark || !$employee->check_out_remark)
                                                    <a href="#" class="btn btn-primary btn-sm openModal"
                                                        title="Attendance Details" data-toggle="modal"
                                                        data-target="#remarkModal" data-id="{{ $employee->id }}">
                                                        <i class="fa fa-list"></i>
                                                        <span>Remark</span>
                                                    </a>


                                                    @endif


                                                    <!-- Reconciliation Button -->
                                                    <a href="#" class="btn btn-primary btn-sm openModalre"
                                                        title="Attendance Details" data-toggle="modal"
                                                        data-target="#reconciliationModal" data-id={{ $employee->id }}>
                                                        <i class="fa fa-list"></i>
                                                        <span>Reconciliation</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->


    <!-- Remark Modal -->
    <div class="modal fade" id="remarkModal" tabindex="-1" role="dialog" aria-labelledby="remarkModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="remarkModalLabel">Remark</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your input fields for Remark -->
                    <input type="hidden" id="employeeId">
                    <input type="text" id="checkInRemark" class="form-control" placeholder="Check In Remark">
                    <input type="text" id="checkOutRemark" class="form-control" placeholder="Check Out Remark">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveRemark()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reconciliation Modal -->
    <div class="modal fade" id="reconciliationModal" tabindex="-1" role="dialog"
        aria-labelledby="reconciliationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reconciliationModalLabel">Reconciliation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your input fields for Reconciliation -->
                    <input type="hidden" id="employeeId">
                    <input type="text" id="timeIn" class="form-control" placeholder="Check In ">
                    <input type="text" id="timeOut" class="form-control" placeholder="Check Out">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveRecon()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
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


        $('.openModal').click(function() {
            var employee = $(this).data('id');
            $('#employeeId').val(employee);
        });

        function saveRemark() {
            var employeeId = $('#employeeId').val();
            var checkInRemark = $('#checkInRemark').val();
            var checkOutRemark = $('#checkOutRemark').val();

            $.ajax({
                url: '{{ route('save.remark') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    employee_id: employeeId,
                    check_in_remark: checkInRemark,
                    check_out_remark: checkOutRemark,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success response
                    $('#remarkModal').modal('hide');
                    iziToast.success({
                        title: 'Success',
                        message: 'Remark Update successfully.',
                        position: 'topRight',
                    });
                    location.reload();
                    // console.log(response);

                },
                error: function(error) {
                    iziToast.error({
                        title: 'Error',
                        message: 'Remark Update failed.',
                        position: 'topRight',
                    });
                    console.log(error);
                }
            });
        }

        $('.openModalre').click(function() {
            var employee = $(this).data('id');
            $('#employeeId').val(employee);
        });


        function saveRecon() {
            var employeeId = $('#employeeId').val();
            var checkIn = $('#timeIn').val();
            var checkOut = $('#timeOut').val();

            $.ajax({
                url: '{{ route('save.recon') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    employee_id: employeeId,
                    check_in_remark: checkIn,
                    check_out_remark: checkOut,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success response
                    $('#reconciliationModal').modal('hide');
                    iziToast.success({
                        title: 'Success',
                        message: 'ReConilation Update successfully.',
                        position: 'topRight',
                    });
                    location.reload();
                    // console.log(response);

                },
                error: function(error) {
                    iziToast.error({
                        title: 'Error',
                        message: 'ReConilation Update failed.',
                        position: 'topRight',
                    });
                    console.log(error);
                }
            });
        }
    </script>
@endpush
