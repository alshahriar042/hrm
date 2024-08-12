@extends('backend.master')

@push('css')
<style>
    #remark_body {
        border: 1px solid #dfdada;
        padding: 5px 15px;
        border-radius: 14px;
        background: lavender;
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
                        <h4 class="page-title">Weekly Record Manage({{ $startOfWeek }} To {{ $endOfWeek }})</h4>
                    </div>

                    {{-- @if (Auth::user()->role_id == 2)
                        <div class="col-sm-6">
                            <ol class=" float-right">
                                <a href="{{ route('reconciliations.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                    Create
                                </a>
                            </ol>
                        </div>
                    @endif --}}
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

    <!-- Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">Remark</h5>
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
        $(document).on('click','.show', function(){
            let id = $(this).data('id');
            $.get("reconciliations/remark/"+id, function(data){
                $('#remark_body').text(data);
            });
        });
    </script>
@endpush
