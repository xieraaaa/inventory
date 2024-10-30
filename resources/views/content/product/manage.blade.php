@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Product</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                   
                </div>
            </div>
        </div>
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="mb-3">
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Create product</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="card-body">
            <table class="table table-striped table-bordered yajra-datatable" id="product">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>product name</th>
                        <th>slug</th>
                        <th>secondary name</th>
                        <th>weight</th>
                        <th>barcode</th>
                        <th>brand</th>
                        <th>kategori</th>
                        <th>unit</th>
                        <th>price</th>
                        <th>image</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Bootstrap product model -->
    <div class="modal fade" id="product-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="productModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="productForm" name="productForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="nama_product" class="col-sm-8 mb-2 control-label">nama product</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama_product" name="nama_product"
                                    placeholder="product Name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-sm-8 mb-2 control-label">slug</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="slug" name="slug"
                                    placeholder="slug" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secondary_name" class="col-sm-8 mb-2 control-label">secondary name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="secondary_name" name="secondary_name"
                                    placeholder="Code of secondary_name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="weight" class="col-sm-8 mb-2 control-label">weight</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="weight" name="weight"
                                    placeholder="Code of weight" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="barcode" class="col-sm-8 mb-2 control-label">Barcode</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="barcode" name="barcode" required>
                                    <option value="">-- Select Barcode Type --</option>
                                    <option value="Code25">Code25</option>
                                    <option value="Code39">Code39</option>
                                    <option value="Code128">Code128</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_brand" class="col-sm-8 mb-2 control-label">brand</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="id_brand" name="id_brand" required>
                                    <option value="">-- Select Kategori --</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->nama_brand }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_kategori" class="col-sm-8 mb-2 control-label">Kategori</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="id_kategori" name="id_kategori" required>
                                    <option value="">-- Select Kategori --</option>
                                    @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_unit" class="col-sm-8 mb-2 control-label">unit</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="id_unit" name="id_unit" required>
                                    <option value="">-- Select Kategori --</option>
                                    @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-sm-8 mb-2 control-label">price</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="price" name="price"
                                    placeholder="Code of price" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-sm-8 mb-2 control-label">Image</label>
                            <div class="col-sm-12">
                                <input type="file" name="image" accept="image/*">
                                @if(isset($product->image))
                                <img src="{{ Storage::url($product->image) }}" alt="Product Image" style="max-width: 200px; margin-top: 10px;">
                                @endif
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
        $('#product').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('product') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nama_product',
                    name: 'nama_product'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'secondary_name',
                    name: 'secondary_name'
                },
                {
                    data: 'weight',
                    name: 'weight'
                },
                {
                    data: 'barcode',
                    name: 'barcode'
                },
                {
                    data: 'brand',
                    name: 'brand'
                },
                {
                    data: 'kategori',
                    name: 'kategori'
                },
                {
                    data: 'unit',
                    name: 'unit'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
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
        $('#productForm').trigger("reset");
        $('#productModal').html("Add product");
        $('#product-modal').modal('show');
        $('#id').val('');
    }

    function editFunc(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('edit-product') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                $('#productModal').html("Edit product");
                $('#product-modal').modal('show');
                $('#id').val(res.id);
                $('#nama_product').val(res.nama_product);
                $('#slug').val(res.slug);
                $('#secondary_name').val(res.secondary_name);
                $('#weight').val(res.weight);
                $('#barcode').val(res.barcode);
                $('#id_brand').val(res.id_brand);
                $('#id_kategori').val(res.id_kategori);
                $('#id_unit').val(res.id_unit);
                $('#price').val(res.price);
                $('#image').val(res.image);
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
                    url: "{{ url('delete-product') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#product').DataTable().ajax.reload(null, false);
                        Swal.fire("Deleted!", "Your record has been deleted.", "success");
                    }
                });
            }
        });
    }

    $('#productForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ url('store-product') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#product-modal").modal('hide');
                $('#product').DataTable().ajax.reload(null, false);
                Swal.fire("Success!", "product has been saved successfully.", "success");
            },
            error: function(data) {
                Swal.fire("Error!", "Something went wrong.", "error");
            }
        });
    });
</script>
@endpush