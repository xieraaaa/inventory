@extends('layouts.app')

@section('content')

<div class="page-wrapper">
<div class="container">
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Tambah unit Button -->
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addunitModal">
                        Tambah unit
                    </button>

                    <!-- unit Table -->
                    <table class="table table-striped table-bordered yajra-datatable">
                        <thead>
                            <tr>
                                <th>ID unit</th>
                                <th>Nama unit</th>
                                <th>Code unit</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding New Unit -->
<div class="modal fade" id="addunitModal" tabindex="-1" aria-labelledby="addUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUnitModalLabel">Add New Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUnitForm">
                <div class="modal-body">
                    <!-- Input Nama Unit -->
                    <input value="{{ old('nama_unit') }}" type="text" class="mt-3 form-control nama_unit" placeholder="Enter Unit Name">
                    <span class="text-danger error_nama_unit"></span>

                    <!-- Input Code Unit -->
                    <input value="{{ old('code_unit') }}" type="text" class="mt-3 form-control code_unit" placeholder="Enter Unit Code">
                    <span class="text-danger error_code_unit"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="btnSave">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>




    <!-- <div class="container">
        <div class="row mt-2">
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header text-success text-center">Add New unit</h5>
                    <div class="card-body">
                        <input value="{{ old('nama_unit') }}" type="text" class="mt-3 form-control nama_unit" placeholder="Enter unit Name">
                        <span class="text-danger error_nama_unit"></span>
                        <button class="btn btn-success form-control mt-3" id="btnSave">Save</button>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-bordered yajra-datatable">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Nama unit</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
  <!-- Edit Unit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUnitForm">
                <div class="modal-body">
                    <!-- Input Nama Unit -->
                    <input id="nama_unit" type="text" class="mt-3 form-control" placeholder="Enter Unit Name">
                    <span class="text-danger" id="error_nama_unit"></span>

                    <!-- Input Code Unit -->
                    <input id="code_unit" type="text" class="mt-3 form-control" placeholder="Enter Unit Code">
                    <span class="text-danger" id="error_code_unit"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn-update btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation Message</h5>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this unit?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button value="" type="button" class="delete btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        jQuery(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Show unit List with Yajra Datatable
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('manage') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'nama_unit', name: 'nama_unit' },
                    { data: 'code_unit', name: 'code_unit' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                columnDefs: [
                    {
                        targets: '_all',
                        className: 'text-center'
                    }
                ]
            });

            // unit Insert
            jQuery("#btnSave").click(function() {
                var nama_unit = jQuery(".nama_unit").val();
                var code_unit = jQuery(".code_unit").val();

                if (nama_unit === "" || code_unit === "") {
            alert('Nama unit dan Code unit harus diisi!');
            return;
        }

                $.ajax({
                    url: "{{ route('unit.store') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        nama_unit: nama_unit,
                        code_unit: code_unit
                    },
                    success: function(response) {
                        table.ajax.reload();
                        jQuery(".error_nama_unit").text("");
                        jQuery(".error_code_unit").text("");
                        jQuery(".nama_unit").val("");
                        jQuery(".code_unit").val("");
                        swal({
                            title: "Success!",
                            text: response.status,
                            icon: "success",
                            timer: 2000,
                            button: false,
                        });
                    },
                    error: function(error) {
                        if (error) {
                            jQuery(".error_nama_unit").text(error.responseJSON.errors.nama_unit);
                            jQuery(".error_code_unit").text(error.responseJSON.errors.code_unit);
                        }
                    }
                });
            });

            // unit Edit
            jQuery(document).on("click", ".btn-edit", function(e) {
                var id = jQuery(this).val();
                jQuery(".btn-update").val(id);

                var baseUrl = `{{ url('/') }}`
                var urlEdit = baseUrl + '/unit/edit/'+id;

                $.ajax({
                    url: urlEdit,
                    type: "GET",
                    dataType: "JSON",
                    success: function(response) {
                        jQuery("#nama_unit").val(response.unit.nama_unit);
                        jQuery("#code_unit").val(response.unit.code_unit);
                    }
                });
            });

            // unit Update
            jQuery(document).on("click", ".btn-update", function(e) {
                var id = jQuery(this).val();

                var nama_unit = jQuery("#nama_unit").val();
                var code_unit = jQuery("#code_unit").val();

                var baseUrl = `{{ url('/') }}`
                var urlUpdate = baseUrl + '/unit/update/'+id;

                $.ajax({
                    url: urlUpdate,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                       
                        nama_unit: nama_unit,
                        code_unit: code_unit
                    },
                    success: function(response) {
                        table.ajax.reload();
                        jQuery("#editModal").modal("hide");
                        jQuery("#error_nama_unit").text("");
                        jQuery("#error_code_unit").text("");
                        jQuery("#nama_unit").val("");
                        jQuery("#code_unit").val("");
                        swal({
                            title: "Success!",
                            text: response.status,
                            icon: "info",
                            timer: 2000,
                            button: false,
                        });
                    },
                    error: function(error) {
                        if (error) {
                            jQuery("#error_nama_unit").text(error.responseJSON.errors.nama_unit);
                            jQuery("#error_code_unit").text(error.responseJSON.errors.code_unit);
                        }
                    }
                });
            });


            // Listen for the modal being hidden
            jQuery("#editModal").on("hidden.bs.modal", function () {
                jQuery("#nama_unit").val("");
                jQuery("#code_unit").val("");
                jQuery("#nama_unit").text("");
                jQuery("#code_unit").text("");
            });

            // unit Delete
            jQuery(document).on("click", ".btn-delete", function (e) {
                var id = jQuery(this).val();
                jQuery(".delete").val(id);
            });

            jQuery(document).on("click", ".delete", function (e) {
                var id = jQuery(this).val();

                var baseUrl = `{{ url('/') }}`
                var urlDelete = baseUrl + '/unit/delete/'+id;

        $.ajax({        
                    url: urlDelete,
                    type: "GET",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status != "success") {
                            table.ajax.reload();
                            jQuery("#delete").modal("hide");
                            //swal ( "Oops!" ,  response.msg ,  "error" );
                            swal({
                                title: "Oops!",
                                text: response.msg,
                                icon: "error",
                                timer: 2000,
                                button: false,
                            });
                        }
                        else {
                            table.ajax.reload();
                            jQuery("#deleteModal").modal("hide");
                            //swal("Success!", response.msg, "warning");
                            swal({
                                title: "Success!",
                                text: response.msg,
                                icon: "warning",
                                timer: 2000,
                                button: false,
                            });
                        }    
                    }
                });
            });
        });
    </script>
@endpush
