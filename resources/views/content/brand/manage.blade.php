        @extends('layouts.app')

        @section('content')
            <div class="page-wrapper">
                <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Brand</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item">setting</li>
                                <li class="breadcrumb-item active">Brand</li>
                            </ol>
                           
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Create Brand</a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <table class="table table-striped table-bordered yajra-datatable" id="brand">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Kode</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- Bootstrap brand model -->
                <div class="modal fade" id="brand-modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="brandModal"></h4>
                            </div>
                            <div class="modal-body">
                                <form action="javascript:void(0)" id="brandForm" name="brandForm" class="form-horizontal"
                                    method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="nama_brand" name="nama_brand"
                                                placeholder="Brand Name" maxlength="50" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Kode</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="code_brand" name="code_brand"
                                                placeholder="Code of Brand" maxlength="50" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" id="btn-save">Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer"></div>
                        </div>
                    </div>
                </div>
                <!-- End bootstrap model -->
            </div>

        @endsection

        @push('scripts')
            <!-- SweetAlert2 CDN -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#brand').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ url('brand') }}",
                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'nama_brand',
                                name: 'nama_brand'
                            },
                            {
                                data: 'code_brand',
                                name: 'code_brand'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false
                            },
                        ],
                        order: [
                            [0, 'desc']
                        ]
                    });
                });

                function add() {
                    $('#brandForm').trigger("reset");
                    $('#brandModal').html("Add Brand");
                    $('#brand-modal').modal('show');
                    $('#id').val('');
                }

                function editFunc(id) {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('edit-brand') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            $('#brandModal').html("Edit Brand");
                            $('#brand-modal').modal('show');
                            $('#id').val(res.id);
                            $('#nama_brand').val(res.nama_brand);
                            $('#code_brand').val(res.code_brand);
                        }
                    });
                }

                function deleteFunc(id) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Delete this record?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ url('delete-brand') }}",
                                data: {
                                    id: id
                                },
                                dataType: 'json',
                                success: function(res) {
                                    $('#brand').DataTable().ajax.reload(null, false);
                                    Swal.fire("Deleted!", "Your record has been deleted.", "success");
                                }
                            });
                        }
                    });
                }

                $('#brandForm').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('store-brand') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $("#brand-modal").modal('hide');
                            $('#brand').DataTable().ajax.reload(null, false);
                            Swal.fire("Success!", "Brand has been saved successfully.", "success");
                        },
                        error: function(data) {
                            Swal.fire("Error!", "Something went wrong.", "error");
                        }
                    });
                });
            </script>
        @endpush
