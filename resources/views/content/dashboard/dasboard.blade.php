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
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">HTML Course</h5>
                                <div class="text-end"> <span class="text-muted">Monthly Fees</span>
                                    <h2><sup><i class="ti-arrow-up text-success"></i></sup> $1200</h2>
                                </div>
                                <span class="text-success">20%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" style="width: 20%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Web Development Course</h5>
                                <div class="text-end"> <span class="text-muted">Monthly Fees</span>
                                    <h2><sup><i class="ti-arrow-down text-primary"></i></sup> $5000</h2>
                                </div>
                                <span class="text-primary">30%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" style="width: 30%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Web Designing Course</h5>
                                <div class="text-end"> <span class="text-muted">Monthly Fees</span>
                                    <h2><sup><i class="ti-arrow-up text-info"></i></sup> $8000</h2>
                                </div>
                                <span class="text-info">60%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" style="width: 40%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">App Development Course</h5>
                                <div class="text-end"> <span class="text-muted">Yearly Fees</span>
                                    <h2><sup><i class="ti-arrow-up text-inverse"></i></sup> $12000</h2>
                                </div>
                                <span class="text-inverse">80%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-inverse" style="width: 40%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                </div>
                            </div>
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
                <!-- Comment - table -->
                <!-- ============================================================== -->
                <!-- row -->
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <img class="img-responsive" alt="user" src="dist/images/big/c2.jpg">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Web Designing</h5>
                                <div class="m-b-30">
                                    <a class="link list-icons" href="#">
                                        <i class="ti-alarm-clock"></i> 2 Year
                                    </a>
                                    <a class="link list-icons m-l-10 m-r-10" href="#">
                                        <i class="fa fa-heart-o"></i> 38
                                    </a>
                                    <a class="link list-icons m-l-10 m-r-10" href="#">
                                        <i class="fa fa-usd"></i> 50
                                    </a>
                                </div>
                                <p>
                                    <span><i class="ti-alarm-clock"></i> Duration: 6 Months</span>
                                </p>
                                <p>
                                    <span><i class="ti-user"></i> Professor: Jane Doe</span>
                                </p>
                                <p>
                                    <span><i class="fa fa-graduation-cap"></i> Students: 200+</span></span>
                                </p>
                                <button class="btn btn-success text-white btn-rounded waves-effect waves-light m-t-10">More Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <img class="img-responsive" alt="user" src="dist/images/big/c1.jpg">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ios Development</h5>
                                <div class="m-b-30">
                                    <a class="link list-icons" href="#">
                                        <i class="ti-alarm-clock"></i> 2 Year
                                    </a>
                                    <a class="link list-icons m-l-10 m-r-10" href="#">
                                        <i class="fa fa-heart-o"></i> 38
                                    </a>
                                    <a class="link list-icons m-l-10 m-r-10" href="#">
                                        <i class="fa fa-usd"></i> 50
                                    </a>
                                </div>
                                <p>
                                    <span><i class="ti-alarm-clock"></i> Duration: 6 Months</span>
                                </p>
                                <p>
                                    <span><i class="ti-user"></i> Professor: Jane Doe</span>
                                </p>
                                <p>
                                    <span><i class="fa fa-graduation-cap"></i> Students: 200+</span></span>
                                </p>
                                <button class="btn btn-success text-white btn-rounded waves-effect waves-light m-t-10">More Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <img class="img-responsive" alt="user" src="dist/images/big/c4.jpg">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Android Development</h5>
                                <div class="m-b-30">
                                    <a class="link list-icons" href="#">
                                        <i class="ti-alarm-clock"></i> 2 Year
                                    </a>
                                    <a class="link list-icons m-l-10 m-r-10" href="#">
                                        <i class="fa fa-heart-o"></i> 38
                                    </a>
                                    <a class="link list-icons m-l-10 m-r-10" href="#">
                                        <i class="fa fa-usd"></i> 50
                                    </a>
                                </div>
                                <p>
                                    <span><i class="ti-alarm-clock"></i> Duration: 6 Months</span>
                                </p>
                                <p>
                                    <span><i class="ti-user"></i> Professor: Jane Doe</span>
                                </p>
                                <p>
                                    <span><i class="fa fa-graduation-cap"></i> Students: 200+</span></span>
                                </p>
                                <button class="btn btn-success text-white btn-rounded waves-effect waves-light m-t-10">More Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <img class="img-responsive" alt="user" src="dist/images/big/c3.jpg">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Web Development</h5>
                                <div class="m-b-30">
                                    <a class="link list-icons" href="#">
                                        <i class="ti-alarm-clock"></i> 2 Year
                                    </a>
                                    <a class="link list-icons m-l-10 m-r-10" href="#">
                                        <i class="fa fa-heart-o"></i> 38
                                    </a>
                                    <a class="link list-icons m-l-10 m-r-10" href="#">
                                        <i class="fa fa-usd"></i> 50
                                    </a>
                                </div>
                                <p>
                                    <span><i class="ti-alarm-clock"></i> Duration: 6 Months</span>
                                </p>
                                <p>
                                    <span><i class="ti-user"></i> Professor: Jane Doe</span>
                                </p>
                                <p>
                                    <span><i class="fa fa-graduation-cap"></i> Students: 200+</span></span>
                                </p>
                                <button class="btn btn-success text-white btn-rounded waves-effect waves-light m-t-10">More Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        @endsection
