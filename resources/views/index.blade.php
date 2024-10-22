@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Tambah Kategori Button -->
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
                        Tambah Kategori
                    </button>

                    <!-- Kategori Table -->
                    <table class="table table-striped table-bordered yajra-datatable">
                        <thead>
                            <tr>
                                <th>ID Kategori</th>
                                <th>Nama Kategori</th>
                                <th>Code Kategori</th>
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

<!-- Modal for Adding New Kategori -->
<div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKategoriModalLabel">Add New Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Input Nama Kategori -->
                <input value="{{ old('nama_kategori') }}" type="text" class="mt-3 form-control nama_kategori" placeholder="Enter Kategori Name">
                <span class="text-danger error_nama_kategori"></span>

                <!-- Input Code Kategori -->
                <input value="{{ old('code_kategori') }}" type="text" class="mt-3 form-control code_kategori" placeholder="Enter Kategori Code">
                <span class="text-danger error_code_kategori"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-success" id="btnSave">Save</button>
            </div>
        </div>
    </div>
</div>



    <!-- <div class="container">
        <div class="row mt-2">
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header text-success text-center">Add New Kategori</h5>
                    <div class="card-body">
                        <input value="{{ old('nama_kategori') }}" type="text" class="mt-3 form-control nama_kategori" placeholder="Enter Kategori Name">
                        <span class="text-danger error_nama_kategori"></span>
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
                                    <th>Nama Kategori</th>
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

    
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                </div>
                <div class="modal-body">
                    <input id="nama_kategori" type="text" class="mt-3 form-control">
                    <input id="code_kategori" type="text" class="mt-3 form-control">
                    <span class="text-danger" id="error_nama_kategori"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button value="" type="button" class="btn-update btn btn-success">Update</button>
                </div>
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
                    Are you sure want to delete this Kategori?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button value="" type="button" class="delete btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('body-scripts')
    <script>
        jQuery(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Show Kategori List with Yajra Datatable
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'nama_kategori', name: 'nama_kategori' },
                    { data: 'code_kategori', name: 'code_kategori' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                columnDefs: [
                    {
                        targets: '_all',
                        className: 'text-center'
                    }
                ]
            });

            // Kategori Insert
            jQuery("#btnSave").click(function() {
                var nama_kategori = jQuery(".nama_kategori").val();
                var code_kategori = jQuery(".code_kategori").val();

                if (nama_kategori === "" || code_kategori === "") {
            alert('Nama Kategori dan Code Kategori harus diisi!');
            return;
        }

                $.ajax({
                    url: "{{ route('kategori.store') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        nama_kategori: nama_kategori,
                        code_kategori: code_kategori
                    },
                    success: function(response) {
                        table.ajax.reload();
                        jQuery(".error_nama_kategori").text("");
                        jQuery(".error_code_kategori").text("");
                        jQuery(".nama_kategori").val("");
                        jQuery(".code_kategori").val("");
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
                            jQuery(".error_nama_kategori").text(error.responseJSON.errors.nama_kategori);
                            jQuery(".error_code_kategori").text(error.responseJSON.errors.code_kategori);
                        }
                    }
                });
            });

            // Kategori Edit
            jQuery(document).on("click", ".btn-edit", function(e) {
                var id = jQuery(this).val();
                jQuery(".btn-update").val(id);

                var baseUrl = `{{ url('/') }}`
                var urlEdit = baseUrl + '/kategori/edit/'+id;

                $.ajax({
                    url: urlEdit,
                    type: "GET",
                    dataType: "JSON",
                    success: function(response) {
                        jQuery("#nama_kategori").val(response.kategori.nama_kategori);
                        jQuery("#code_kategori").val(response.kategori.code_kategori);
                    }
                });
            });

            // Kategori Update
            jQuery(document).on("click", ".btn-update", function(e) {
                var id = jQuery(this).val();

                var nama_kategori = jQuery("#nama_kategori").val();
                var code_kategori = jQuery("#code_kategori").val();

                var baseUrl = `{{ url('/') }}`
                var urlUpdate = baseUrl + '/kategori/update/'+id;

                $.ajax({
                    url: urlUpdate,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                       
                        nama_kategori: nama_kategori,
                        code_kategori: code_kategori
                    },
                    success: function(response) {
                        table.ajax.reload();
                        jQuery("#editModal").modal("hide");
                        jQuery("#error_nama_kategori").text("");
                        jQuery("#error_code_kategori").text("");
                        jQuery("#nama_kategori").val("");
                        jQuery("#code_kategori").val("");
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
                            jQuery("#error_nama_kategori").text(error.responseJSON.errors.nama_kategori);
                            jQuery("#error_code_kategori").text(error.responseJSON.errors.code_kategori);
                        }
                    }
                });
            });


            // Listen for the modal being hidden
            jQuery("#editModal").on("hidden.bs.modal", function () {
                jQuery("#nama_kategori").val("");
                jQuery("#code_kategori").val("");
                jQuery("#nama_kategori").text("");
                jQuery("#code_kategori").text("");
            });

            // Kategori Delete
            jQuery(document).on("click", ".btn-delete", function (e) {
                var id = jQuery(this).val();
                jQuery(".delete").val(id);
            });

            jQuery(document).on("click", ".delete", function (e) {
                var id = jQuery(this).val();

                var baseUrl = `{{ url('/') }}`
                var urlDelete = baseUrl + '/kategori/delete/'+id;

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
