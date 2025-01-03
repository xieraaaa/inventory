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
                            <th width="10px">Id</th>
                            <th width="10px">Name</th>
                            <th width="80px">Code</th>
                            <th width="80px">Slug</th>
                            <th width="100px">Secondary Name</th>
                            <th width="60px">Weight</th>
                            <th width="190px">Barcode</th>
                            <th width="80px">Brand</th>
                            <th width="80px">Kategori</th>
                            <th width="60px">Unit</th>
                            <th width="80px">Price</th>
                            <th width="100px">Image</th>
                            <th width="200px">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- Bootstrap product modal -->
        <div class="modal fade" id="product-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="productModal"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" name="productForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            @foreach (['nama_product' => 'Product Name', 'code_product' => 'Product Code', 'slug' => 'Slug', 'secondary_name' => 'Secondary Name', 'weight' => 'Weight', 'price' => 'Price'] as $field => $label)
                            <div class="form-group">
                                <label for="{{ $field }}" class="col-sm-8 mb-2 control-label">{{ $label }}</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="{{ $field }}" name="{{ $field }}" placeholder="{{ $label }}" maxlength="50" required="">
                                </div>
                            </div>
                            @endforeach
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
                                <label for="id_brand" class="col-sm-8 mb-2 control-label">Brand</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="id_brand" name="id_brand" required>
                                        <option value="">-- Select Brand --</option>
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
                                <label for="id_unit" class="col-sm-8 mb-2 control-label">Unit</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="id_unit" name="id_unit" required>
                                        <option value="">-- Select Unit --</option>
                                        @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                                        @endforeach
                                    </select>
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
                                <button type="submit" class="btn btn-primary" id="btn-save">Save Changes</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
        <!-- End bootstrap modal -->
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
            responsive: true,
            autoWidth: true,
            columns: [
                { data: 'id', width: '10px' },
                { data: 'nama_product', width: '100px' },
                { data: 'code_product', width: '80px' },
                { data: 'slug', width: '80px' },
                { data: 'secondary_name', width: '100px' },
                { data: 'weight', width: '60px' },
                { data: 'barcode', width: '300px', orderable: false, searchable: false },
                { data: 'brand', width: '80px' },
                { data: 'kategori', width: '80px' },
                { data: 'unit', width: '60px' },
                { data: 'price', width: '80px' },
                { data: 'image', width: '100px', orderable: false, searchable: false },
                { data: 'action', width: '200px', orderable: false }
            ],
            order: [[0, 'desc']],
            scrollX: true
        });
    });

    function add() {
        $('#productForm').trigger("reset");
        $('#productModal').html("Add product");
        $('#product-modal').modal('show');
        $('#id').val('');
    }

    function editFunc(id) {
        $.post("{{ url('edit-product') }}", { id: id }, function(res) {
            $('#productModal').html("Edit product");
            $('#product-modal').modal('show');
            $.each(res, function(key, value) {
                $(`#${key}`).val(value);
            });
        }, 'json');
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
                $.post("{{ url('delete-product') }}", { id: id }, function() {
                    $('#product').DataTable().ajax.reload(null, false);
                    Swal.fire("Deleted!", "Your record has been deleted.", "success");
                });
            }
        });
    }

    $('#productForm').submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        $('#btn-save').html('Please Wait...').attr("disabled", true);
        $.ajax({
            type: 'POST',
            url: "{{ url('add-product') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                $('#product-modal').modal('hide');
                $('#product').DataTable().ajax.reload(null, false);
                Swal.fire("Success!", "Product saved successfully.", "success");
                $('#btn-save').html('Save Changes').attr("disabled", false);
            },
            error: function() {
                Swal.fire("Error!", "Failed to save product.", "error");
                $('#btn-save').html('Save Changes').attr("disabled", false);
            }
        });
    });
</script>
@endpush
