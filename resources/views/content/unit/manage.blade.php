
@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container mt-2">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>unit</h2>
                </div>
                <div class="pull-right mb-2">
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
            <table class="table table-bordered" id="unit">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>code_unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- boostrap unit model -->
    <div class="modal fade" id="unit-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                                <input type="text" class="form-control" id="nama_unit" name="nama_unit"
                                    placeholder="unit name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Kode</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="code_unit" name="code_unit"
                                    placeholder="code_unit of unit" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->
        

</div>
   
@endsection

@push('scripts')
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
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nama_unit',
                    name: 'nama_unit'
                },
                {
                    data: 'code_unit',
                    name: 'code_unit'
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
        $('#unitForm').trigger("reset");
        $('#unitModal').html("Add unit");
        $('#unit-modal').modal('show');
        $('#id').val('');
    }

    function editFunc(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('edit-unit') }}",
            data: {
                id: id
            },
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
        if (confirm("Delete record?") == true) {
            var id = id;
            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('delete-unit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#unit').DataTable().ajax.reload(null, false);

                }
            });
        }
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
                $("#btn-save").html('Submit');
                $("#btn-save").attr("disabled", false);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>
@endpush



