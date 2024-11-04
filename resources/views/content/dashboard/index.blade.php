@extends('layouts.app') 
@section('content')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">University Dashboard</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard 1</li>
                            </ol>
                            <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <a href="{{route('product')}}" style="color: inherit; text-decoration: none;">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Product</h5>
                                <div class="text-end"> <span class="text-muted">Total produk</span>
                                    <h2><sup></sup>{{ count(DB::select("SELECT * FROM products")) }}</h2>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <a href="{{route('brand')}}" style="color: inherit; text-decoration: none;">
                            <div class="card-body">                               
                                <h5 class="card-title text-uppercase">Brand</h5>
                                <div class="text-end"> <span class="text-muted">Total Brand</span>
                                    <h2><sup></sup> {{ count(DB::select("SELECT * FROM brand")) }}</h2>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <a href="{{route('kategori')}}" style="color: inherit; text-decoration: none;">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Kategori</h5>
                                <div class="text-end"> <span class="text-muted">Total kategori</span>
                                    <h2><sup></sup>{{ count(DB::select("SELECT * FROM kategori")) }} </h2>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <a href="{{ route('unit') }}" style="color: inherit; text-decoration: none;">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase">Unit</h5>
                                    <div class="text-end">
                                        <span class="text-muted">Total Unit</span>
                                        <h2><sup></sup> {{ count(DB::select("SELECT * FROM unit")) }}</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- End Info box -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Over Visitor, Our income , slaes different and  sales prediction -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title text-uppercase">University Earnings<br><small class="text-muted">All Earnings are in million $</small></h5>
                                    <div class="ms-auto">
                                        <ul class="list-inline font-12">
                                            <li><i class="fa fa-circle text-dark"></i> Arts</li>
                                            <li><i class="fa fa-circle text-info"></i> Commerse</li>
                                            <li><i class="fa fa-circle text-success"></i> Science</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="morris-bar-chart" style="height:375px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card m-b-15">
                                    <div class="card-body">
                                        <h5 class="card-title text-uppercase">Earning From Medical college</h5>
                                        <div class="row">
                                            <div class="col-6 m-t-30">
                                                <h1 class="text-info">$64057</h1>
                                                <p class="text-muted">APRIL 2017</p> <b>(150 Sales)</b> </div>
                                            <div class="col-6">
                                                <div id="sparkline2dash" class="text-end"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card bg-info m-b-15">
                                    <div class="card-body">
                                        <h5 class="text-white card-title text-uppercase">Earning From Engineering college</h5>
                                        <div class="row">
                                            <div class="col-6 m-t-30">
                                                <h1 class="text-white">$30447</h1>
                                                <p class="text-white">APRIL 2017</p> <b class="text-white">(110 Sales)</b> </div>
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div id="sales1" class="text-end"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        @endsection

        @push('scripts')
              <!--morris JavaScript -->
        <script src="{{asset('../assets/node_modules/raphael/raphael-min.js')}}"></script>
        <script src="{{asset('../assets/node_modules/morrisjs/morris.min.js')}}"></script>
        <script src="{{asset('../assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <!-- Popup message jquery -->
        <script src="{{asset('../assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
        <!-- Chart JS -->
        <script src="{{asset('dist/js/dashboard1.js')}}"></script>
        @endpush