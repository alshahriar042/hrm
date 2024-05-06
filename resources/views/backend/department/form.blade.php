@extends('backend.master')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <ol class="d-flex justify-content-between">
                            <div style="font-size: 1.25rem;">{{ @$department ? 'Edit Department' : 'Create Department' }}</div>
                            <a href="{{ route('departments.index') }}" class="float-right btn-shadow mr-3 btn btn-danger">
                                <i class="fa fa-arrow-circle-left"></i>
                                <span>Back to list</span>
                            </a>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="main-card mb-3 card" style="padding: 10px;">
                        <form method="POST"
                            action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            @isset($department)
                                @method('PUT')
                            @endisset

                            <div class="card-body">
                                <h5 class="card-title text-center">Department</h5>

                                <div class="form-group">
                                    <label for="name">Name <sup class="text-danger">*</sup></label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $department->name ?? old('name') }}" placeholder="Enter user name"
                                        autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="status" id="status"
                                            {{ @$department->status == true ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa {{ @$department ? 'fa-arrow-circle-up' : 'fa-plus-circle' }}"></i>
                                        <span>{{ @$department ? 'Update' : 'Save' }}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
@endsection

@push('js')
@endpush
