@extends('layouts.app')

@section('content')
<div class="page-wrapper">
<div class="container">
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Tambah brand Button -->
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addbrandModal">
                        Tambah brand
                    </button>

                    <!-- brand Table -->
                    <table class="table table-striped table-bordered yajra-datatable">
                        <thead>
                            <tr>
                                <th>ID brand</th>
                                <th>Nama brand</th>
                                <th>Code brand</th>
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

<!-- Modal for Adding New brand -->
<div class="modal fade" id="addbrandModal" tabindex="-1" aria-labelledby="addbrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addbrandModalLabel">Add New brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Input Nama brand -->
                <input value="{{ old('nama_brand') }}" type="text" class="mt-3 form-control nama_brand" placeholder="Enter brand Name">
                <span class="text-danger error_nama_brand"></span>

                <!-- Input Code brand -->
                <input value="{{ old('code_brand') }}" type="text" class="mt-3 form-control code_brand" placeholder="Enter brand Code">
                <span class="text-danger error_code_brand"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-success" id="btnSave">Save</button>
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

            // Show brand List with Yajra Datatable
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('brand.manage') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'nama_brand', name: 'nama_brand' },
                    { data: 'code_brand', name: 'code_brand' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                columnDefs: [
                    {
                        targets: '_all',
                        className: 'text-center'
                    }
                ]
            });

            // brand Insert
            jQuery("#btnSave").click(function() {
                var nama_brand = jQuery(".nama_brand").val();
                var code_brand = jQuery(".code_brand").val();

                if (nama_brand === "" || code_brand === "") {
                    alert('Nama brand dan Code brand harus diisi!');
                    return;
                }

                $.ajax({
                    url: "{{ route('brand.store') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        nama_brand: nama_brand,
                        code_brand: code_brand
                    },
                    success: function(response) {
                        table.ajax.reload();
                        jQuery(".error_nama_brand").text("");
                        jQuery(".error_code_brand").text("");
                        jQuery(".nama_brand").val("");
                        jQuery(".code_brand").val("");
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
                            jQuery(".error_nama_brand").text(error.responseJSON.errors.nama_brand);
                            jQuery(".error_code_brand").text(error.responseJSON.errors.code_brand);
                        }
                    }
                });
            });

            // brand Edit
            jQuery(document).on("click", ".btn-edit", function(e) {
                var id = jQuery(this).val();
                jQuery(".btn-update").val(id);

                var baseUrl = `{{ url('/') }}`
                var urlEdit = baseUrl + '/brand/edit/' + id;

                $.ajax({
                    url: urlEdit,
                    type: "GET",
                    dataType: "JSON",
                    success: function(response) {
                        jQuery("#nama_brand").val(response.brand.nama_brand);
                        jQuery("#code_brand").val(response.brand.code_brand);
                    }
                });
            });

            // brand Update
            jQuery(document).on("click", ".btn-update", function(e) {
                var id = jQuery(this).val();

                var nama_brand = jQuery("#nama_brand").val();
                var code_brand = jQuery("#code_brand").val();

                var baseUrl = `{{ url('/') }}`
                var urlUpdate = baseUrl + '/brand/update/' + id;

                $.ajax({
                    url: urlUpdate,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _method: 'PUT',
                        nama_brand: nama_brand,
                        code_brand: code_brand
                    },
                    success: function(response) {
                        table.ajax.reload();
                        jQuery("#editModal").modal("hide");
                        jQuery("#error_nama_brand").text("");
                        jQuery("#error_code_brand").text("");
                        jQuery("#nama_brand").val("");
                        jQuery("#code_brand").val("");
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
                            jQuery("#error_nama_brand").text(error.responseJSON.errors.nama_brand);
                            jQuery("#error_code_brand").text(error.responseJSON.errors.code_brand);
                        }
                    }
                });
            });

            // Listen for the modal being hidden
            jQuery("#editModal").on("hidden.bs.modal", function() {
                jQuery("#nama_brand").val("");
                jQuery("#code_brand").val("");
                jQuery("#nama_brand").text("");
                jQuery("#code_brand").text("");
            });

            // brand Delete
            jQuery(document).on("click", ".btn-delete", function(e) {
                var id = jQuery(this).val();
                jQuery(".delete").val(id);
            });

            jQuery(document).on("click", ".delete", function(e) {
                var id = jQuery(this).val();

                var baseUrl = `{{ url('/') }}`
                var urlDelete = baseUrl + '/brand/delete/' + id;

                $.ajax({
                    url: urlDelete,
                    type: "GET",
                    dataType: "JSON",
                    success: function(response) {
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

