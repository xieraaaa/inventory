@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Kategori</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">setting</li>
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                   
                </div>
            </div>
        </div>
        <div class="card p-3 rounded">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="mb-3">
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Create kategori</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        
            <table class="table table-striped table-bordered yajra-datatable" id="kategori">
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
    <!-- Bootstrap kategori model -->
    <div class="modal fade" id="kategori-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="kategoriModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="kategoriForm" name="kategoriForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                    placeholder="kategori Name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Kode</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="code_kategori" name="code_kategori"
                                    placeholder="Code of kategori" maxlength="50" required="">
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
        $('#kategori').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('kategori') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nama_kategori', name: 'nama_kategori' },
                { data: 'code_kategori', name: 'code_kategori' },
                { data: 'action', name: 'action', orderable: false },
            ],
            order: [[0, 'desc']]
        });
    });

    function add() {
        $('#kategoriForm').trigger("reset");
        $('#kategoriModal').html("Add kategori");
        $('#kategori-modal').modal('show');
        $('#id').val('');
    }

    function editFunc(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('edit-kategori') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res) {
                $('#kategoriModal').html("Edit kategori");
                $('#kategori-modal').modal('show');
                $('#id').val(res.id);
                $('#nama_kategori').val(res.nama_kategori);
                $('#code_kategori').val(res.code_kategori);
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
                    url: "{{ url('delete-kategori') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res) {
                        $('#kategori').DataTable().ajax.reload(null, false);
                        Swal.fire("Deleted!", "Your record has been deleted.", "success");
                    }
                });
            }
        });
    }

    $('#kategoriForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ url('store-kategori') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#kategori-modal").modal('hide');
                $('#kategori').DataTable().ajax.reload(null, false);
                Swal.fire("Success!", "kategori has been saved successfully.", "success");
            },
            error: function(data) {
                Swal.fire("Error!", "Something went wrong.", "error");
            }
        });
    });
</script>
@endpush
