
        @extends('layouts.app')

        @section('content')
        <div class="page-wrapper">
            <div class="container mt-2">
        
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>kategori</h2>
                        </div>
                        <div class="pull-right mb-2">
                            <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Create kategori</a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered" id="kategori">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>code_kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- boostrap kategori model -->
            <div class="modal fade" id="kategori-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
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
                                            placeholder="kategori name" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Kode</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="code_kategori" name="code_kategori"
                                            placeholder="code_kategori of kategori" maxlength="50" required="">
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
                $('#kategori').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('kategori') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'nama_kategori',
                            name: 'nama_kategori'
                        },
                        {
                            data: 'code_kategori',
                            name: 'code_kategori'
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
                $('#kategoriForm').trigger("reset");
                $('#kategoriModal').html("Add kategori");
                $('#kategori-modal').modal('show');
                $('#id').val('');
            }
    
            function editFunc(id) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('edit-kategori') }}",
                    data: {
                        id: id
                    },
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
                if (confirm("Delete record?") == true) {
                    var id = id;
                    // ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('delete-kategori') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            $('#kategori').DataTable().ajax.reload(null, false);

                        }
                    });
                }
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



