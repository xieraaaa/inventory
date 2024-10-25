
@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container mt-2">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>brand</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Create brand</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered" id="brand">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>code_brand</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- boostrap brand model -->
    <div class="modal fade" id="brand-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                                    placeholder="brand name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Kode</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="code_brand" name="code_brand"
                                    placeholder="code_brand of brand" maxlength="50" required="">
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
        $('#brandModal').html("Add brand");
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
                $('#brandModal').html("Edit brand");
                $('#brand-modal').modal('show');
                $('#id').val(res.id);
                $('#nama_brand').val(res.nama_brand);
                $('#code_brand').val(res.code_brand);
            }
        });
    }

    function deleteFunc(id) {
        if (confirm("Delete record?") == true) {
            var id = id;
            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('delete-brand') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#brand').DataTable().ajax.reload(null, false);

                }
            });
        }
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



