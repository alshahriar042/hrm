@extends('backend.master')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <ol class=" float-right">
                            <a href="{{ route('reconciliations.index') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-list"></i>
                                View
                            </a>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card m-b-30">
                        <div class="card-body shadow">
                            <h4 class="m-2 text-center header-title">Create Reconciliation</h4>
                            <form action="{{ route('calculateAttendance') }}" method="get">
                                @csrf
                                <div class="form-group">
                                    <label for="startOfWeek">Start Date:</label>
                                    <input type="date" id="startOfWeek" name="startOfWeek" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="endOfWeek">End Date:</label>
                                    <input type="date" id="endOfWeek" name="endOfWeek" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Generate Report</button>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
    <script>
        $('#file').dropify();
        $('#summernote').summernote({
            height: 300
        });
    </script>
@endpush
