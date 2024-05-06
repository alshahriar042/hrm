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
                            <form method="POST" action="{{ route('reconciliations.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <label for="in_time">In Time <sup class="text-danger">*</sup></label>
                                        <div>
                                            <input type="time" id="in_time" name="in_time" class="form-control @error('in_time') is-invalid @enderror" value="{{ old('in_time') }}" utocomplete="off" />
                                        </div>

                                        @error('in_time')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="out_time">Out Time <sup class="text-danger">*</sup></label>
                                        <div>
                                            <input type="time" id="out_time" name="out_time" class="form-control @error('out_time') is-invalid @enderror" value="{{ old('out_time') }}" utocomplete="off" />
                                        </div>

                                        @error('out_time')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date <sup class="text-danger">*</sup></label>
                                    <div>
                                        <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" max="{{ date('Y-m-d'); }}" value="{{ old('date') }}" utocomplete="off" />
                                    </div>

                                    @error('date')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="reason">Reason</label>
                                    <div>
                                        <textarea class="form-control @error('reason') is-invalid @enderror" name="reason" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group m-b-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Save
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
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
