        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"><span class="hide-menu">Prof. Mark</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-wallet"></i> My Balance</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-small-cap">--- PERSONAL</li>
                        <li> <a class="waves-effect waves-dark" href="{{route('dashboard.index')}}"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                        <li> <a class="waves-effect waves-dark" href="{{route('product')}}"><i class="fa-solid fa-barcode"></i></i><span class="hide-menu">Product</span></a>
                        <li> <a class="waves-effect waves-dark" href="#"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                        <li> <a class="waves-effect waves-dark" href="#"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                        <li> <a class="waves-effect waves-dark" href="#"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Setting</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('kategori')}}">Kategori</a></li>
                                <li><a href="{{route('brand')}}">Brand</a></li>
                                <li><a href="{{route('unit')}}">Unit</a></li>
                            </ul>
                        </li>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->