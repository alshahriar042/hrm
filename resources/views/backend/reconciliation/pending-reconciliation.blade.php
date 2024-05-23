@extends('backend.master')

@push('css')
<style>
    #remark_body {
        border: 1px solid #dfdada;
        padding: 5px 15px;
        border-radius: 14px;
        background: lavender;
        min-height: 200px;
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
                        <h4 class="page-title">Pending Reconciliation Manage</h4>
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
                                        {{-- <th class="text-center">ID</th> --}}
                                        <th class="text-center">Name</th>
                                        {{-- <th class="text-center">Designation</th> --}}
                                        <th class="text-center">In Time</th>
                                        <th class="text-center">Out Time</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($pending_reconciliations as $pending_reconciliation)
                                    {{-- @dd($pending_reconciliation) --}}
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ @$pending_reconciliation->employee->emp_id }}</td> --}}
                                            <td>{{ @$pending_reconciliation->employee->name }}</td>
                                            {{-- <td>{{ @$pending_reconciliation->employee->designation }}</td> --}}
                                            <td>{{ date('h:i A', strtotime($pending_reconciliation->in_time)) }}</td>
                                            <td>{{ date('h:i A', strtotime($pending_reconciliation->out_time)) }}</td>
                                            <td>{{ date('d-M-Y', strtotime($pending_reconciliation->date)) }}</td>
                                            <td>
                                                @if ($pending_reconciliation->approval_status == "pending")
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif ($pending_reconciliation->approval_status == "approved")
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif ($pending_reconciliation->approval_status == "rejected")
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('approve.reconciliation', $pending_reconciliation->id) }}"
                                                    class="btn btn-sm btn-success" onclick="return confirm('Are you sure want approve?')">
                                                    <i class="fa fa-check"></i>
                                                    Approve
                                                </a>

                                                <a href="#" class="btn btn-sm btn-danger remark"
                                                    data-toggle="modal" data-target="#rejectModal" data-id="{{$pending_reconciliation->id}}">
                                                    <i class="fa fa-ban"></i>
                                                    Reject
                                                </a>

                                                <a href="{{ route('reconciliations.show', $pending_reconciliation->id) }}"
                                                    class="btn btn-sm btn-info show"
                                                    data-toggle="modal" data-target="#showModal" data-id="{{$pending_reconciliation->id}}">
                                                    <i class="fa fa-comment"></i>
                                                    Reason
                                                </a>
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

    <!-- Modal Form-->
    <div class="modal fade" id="rejectModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Remark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reject.reconciliation') }}" method="POST">
                        @csrf

                        <input type="hidden" id="reconciliation_id" name="reconciliation_id" value="">

                        <div class="card" style="width: 100%;">
                            <textarea name="remark" class="form-controll" id="" cols="30" rows="10" placeholder="Type here..."></textarea>
                        </div>
                        <button class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">{{ Auth::user()->role_id == 2 ? "Remark" : "Reason" }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 100%;" id="modal_body">
                        <p id="remark_body"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).on('click','.remark', function(){
            let id = $(this).data('id');
            $('#reconciliation_id').val(id);
        });

        $(document).on('click','.show', function(){
            let id = $(this).data('id');
            $.get("reconciliations/remark/"+id, function(data){
                $('#remark_body').text(data);
            });
        });
    </script>
@endpush
