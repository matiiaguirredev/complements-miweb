<!-- ========== Left Sidebar ========== -->
<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a class='logo-light' href='/admin/'>
            <!-- <img src="assets/images/logo-light.png" alt="logo" class="logo-lg" height="28"> -->
            <!-- <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="28"> -->
        </a>

        <!-- Brand Logo Dark -->
        <a class='logo-dark' href='/admin/'>
            <!-- <img src="assets/images/logo-dark.png" alt="dark logo" class="logo-lg" height="28"> -->
            <!-- <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="28"> -->
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='/admin/'>
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboards </span>
                    <span class="badge bg-primary rounded ms-auto">01</span>
                </a>
            </li>

            <li class="menu-title">Custom</li>

            <!-- <li class="menu-item">
                    <a href="#menuProyects" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="fa-duotone fa-book"></i></span>
                        <span class="menu-text"> Proyectos </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuProyects">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a class='menu-link' href='/admin/proyect'>
                                    <span class="menu-text">Lista de Proyectos</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a class='menu-link' href='/admin/create/proyect'>
                                    <span class="menu-text">Nuevo Proyecto</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->


            <li class="menu-item">
                <a href="#menuRoles" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="fa-solid fa-pen-ruler"></i></span>
                    <span class="menu-text"> Roles </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuRoles">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a class='menu-link' href='/admin/roles'>
                                <span class="menu-text">Lista de Roles</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class='menu-link' href='/admin/create/roles'>
                                <span class="menu-text">Nuevos Roles</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item">
                <a href="#menuUsuarios" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="fa-duotone fa-solid fa-users"></i></span>
                    <span class="menu-text"> Usuarios </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuUsuarios">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a class='menu-link' href='/admin/usuarios'>
                                <span class="menu-text">Lista de Usuarios</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class='menu-link' href='/admin/create/usuarios'>
                                <span class="menu-text">Nuevos Usuarios</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item">
                <a href="#menuMultilevel" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-share-alt"></i></span>
                    <span class="menu-text"> Proyectos </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuMultilevel">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a class='menu-link' href='/admin/proyect'>
                                <span class="menu-text">Lista de Proyectos</span>
                            </a>
                        </li>
                        <?php if (isset($can_manage) && $can_manage): ?>
                            <li class="menu-item">
                                <a class='menu-link' href='/admin/create/proyect'>
                                    <span class="menu-text">Nuevo Proyecto</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <!-- <div class="collapse" id="menuProyects"></div> -->
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="#menuMultilevel2" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                                <span class="menu-text"> Categorias </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="menuMultilevel2">
                                <ul class="sub-menu">
                                    <li class="menu-item">
                                        <a href="/admin/categorias" class="menu-link">
                                            <span class="menu-text">Lista de categorias</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/admin/create/categorias" class="menu-link">
                                            <span class="menu-text">Crear categorias</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>


        </ul>
    </div>
</div>

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="page-content">

    <!-- ========== Topbar Start ========== -->
    <div class="navbar-custom">
        <div class="topbar">
            <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

                <!-- Brand Logo -->
                <div class="logo-box">
                    <!-- Brand Logo Light -->
                    <a class='logo-light' href='/admin/'>
                        <img src="assets/images/logo-light.png" alt="logo" class="logo-lg" height="22">
                        <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="22">
                    </a>

                    <!-- Brand Logo Dark -->
                    <a class='logo-dark' href='/admin/'>
                        <img src="assets/images/logo-dark.png" alt="dark logo" class="logo-lg" height="22">
                        <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="22">
                    </a>
                </div>

                <!-- Sidebar Menu Toggle Button -->
                <button class="button-toggle-menu">
                    <i class="mdi mdi-menu"></i>
                </button>
            </div>

            <ul class="topbar-menu d-flex align-items-center gap-4">

                <li class="d-none d-md-inline-block">
                    <a class="nav-link" href="" data-bs-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen font-size-24"></i>
                    </a>
                </li>

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-magnify font-size-24"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end dropdown-lg p-0">
                        <form class="p-3">
                            <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                        </form>
                    </div>
                </li>


                <li class="dropdown d-none d-md-inline-block">
                    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="assets/images/flags/us.jpg" alt="user-image" class="me-0 me-sm-1" height="18">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-bell font-size-24"></i>
                        <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                        <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 font-size-16 fw-semibold"> Notification</h6>
                                </div>
                                <div class="col-auto">
                                    <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                        <small>Clear All</small>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="px-1" style="max-height: 300px;" data-simplebar>

                            <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5>
                            <!-- item-->

                            <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">Datacorp <small class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-info">
                                                <i class="mdi mdi-account-plus"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">Admin <small class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">New user registered</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <h5 class="text-muted font-size-13 fw-normal mt-0">Yesterday</h5>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon">
                                                <img src="assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">Cristina Pride <small class="fw-normal text-muted ms-1">1 day ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <h5 class="text-muted font-size-13 fw-normal mt-0">30 Dec 2021</h5>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">Datacorp</h5>
                                            <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon">
                                                <img src="assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">Karen Robinson</h5>
                                            <small class="noti-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="text-center">
                                <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                            </div>
                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                            View All
                        </a>

                    </div>
                </li>

                <li class="nav-link" id="theme-mode">
                    <i class="bx bx-moon font-size-24"></i>
                </li>

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="" alt="user-image" class="rounded-circle">
                        <span class="ms-1 d-none d-md-inline-block">
                            <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="/admin/perfil" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>Settings</span>
                        </a>

                        <!-- item-->
                        <a class='dropdown-item notify-item' href='/admin/-lock-screen'>
                            <i class="fe-lock"></i>
                            <span>Lock Screen</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a class='dropdown-item notify-item' href='/admin/logout'>
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

            </ul>
        </div>
    </div>
    <!-- ========== Topbar End ========== -->