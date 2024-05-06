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
                        <h4 class="page-title">Departments Manage</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class=" float-right">
                            @if (Auth::user()->hasPermission('users.create'))
                            <a href="{{ route('departments.create') }}" class="btn-shadow btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle"></i>
                                Create
                            </a>
                            @endif
                        </ol>
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
                                        <th class="text-center">Status</th>
                                        @if (Auth::user()->hasPermission('users.show') || Auth::user()->hasPermission('users.edit') || Auth::user()->hasPermission('users.destroy'))
                                        <th class="text-center">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($departments as $key => $department)
                                        <tr>
                                            <td class="text-center text-muted"># {{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $department->name }}</td>
                                            <td class="text-center">
                                                @if($department->status == true)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-center">

                                                @if (Auth::user()->hasPermission('users.edit'))
                                                    <a href="{{ route('departments.edit',$department->id) }}" class="btn btn-success btn-sm" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                @endif

                                                {{-- @if (Auth::user()->hasPermission('departments.destroy'))
                                                    <button type="button" onclick="deleteData({{ $department->id }})" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fa fa-trash-alt"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                @endif

                                                <form id="delete-form-{{ $department->id }}" method="POST" action="{{ route('departments.destroy',$department->id) }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form> --}}
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

@push('js')
    <script>
        $('#datatable').dataTable( {
            "ordering": false
        } );
    </script>
@endpush
