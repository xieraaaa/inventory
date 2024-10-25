@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="pull-left">
                    <h2>unit</h2>
                </div>
                <div class="mb-3">
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Create unit</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-striped table-bordered yajra-datatable" id="unit">
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
    <!-- Bootstrap unit model -->
    <div class="modal fade" id="unit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="unitModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="unitForm" name="unitForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="mt-3 form-control" id="nama_unit" name="nama_unit"
                                    placeholder="unit Name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Kode</label>
                            <div class="col-sm-12">
                                <input type="text" class="mt-3 form-control" id="code_unit" name="code_unit"
                                    placeholder="Code of unit" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success" id="btn-save">Save Changes
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
        $('#unit').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('unit') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nama_unit', name: 'nama_unit' },
                { data: 'code_unit', name: 'code_unit' },
                { data: 'action', name: 'action', orderable: false },
            ],
            order: [[0, 'desc']]
        });
    });

    function add() {
        $('#unitForm').trigger("reset");
        $('#unitModal').html("Add unit");
        $('#unit-modal').modal('show');
        $('#id').val('');
    }

    function editFunc(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('edit-unit') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res) {
                $('#unitModal').html("Edit unit");
                $('#unit-modal').modal('show');
                $('#id').val(res.id);
                $('#nama_unit').val(res.nama_unit);
                $('#code_unit').val(res.code_unit);
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
                    url: "{{ url('delete-unit') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res) {
                        $('#unit').DataTable().ajax.reload(null, false);
                        Swal.fire("Deleted!", "Your record has been deleted.", "success");
                    }
                });
            }
        });
    }

    $('#unitForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ url('store-unit') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#unit-modal").modal('hide');
                $('#unit').DataTable().ajax.reload(null, false);
                Swal.fire("Success!", "unit has been saved successfully.", "success");
            },
            error: function(data) {
                Swal.fire("Error!", "Something went wrong.", "error");
            }
        });
    });
</script>
@endpush
