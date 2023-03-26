<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("location:../index.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>网上选课系统</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./theme_file/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./theme_file/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./theme_file/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./theme_file/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./theme_file/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./theme_file/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./theme_file/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="./theme_file/plugins/summernote/summernote-bs4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="./theme_file/plugins/toastr/toastr.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="./theme_file/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link href="https://fonts.font.im/css?family=Lobster" rel="stylesheet" />
    <link href="https://fonts.font.im/css?family=Dancing+Script" rel="stylesheet" />
    <!-- DataTables -->
    <link rel="stylesheet" href="./theme_file/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./theme_file/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./theme_file/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="./theme_file/dist/img/AdminLTELogo.png" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="admin_dashboard.php" class="nav-link">首页</a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">

                </li>
                <li class="nav-item">
                    <a href="../logout.php" class="btn btn-info">登出</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="admin_dashboard.php" class="brand-link">
                <img src="./theme_file/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">网上选课系统</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">

                    </div>
                    <div class="info">
                        <a href="#" class="d-block">你好,
                            <?php echo $_SESSION['username'] ?>
                        </a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item <?php echo $admin_drop_menu ?>">
                            <a href="#" class="nav-link <?php echo $admin_menu ?>">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    管理员功能
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="admin_profile.php" class="nav-link <?php echo $admin_profile_menu ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>你的资料</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="admin_add_user.php" class="nav-link <?php echo $admin_add_user_menu ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>添加管理员</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?php echo $student_drop_menu ?> ">
                            <a href="#" class="nav-link <?php echo $student_menu ?>">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
                                    学生功能
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="admin_add_student.php" class="nav-link <?php echo $add_student_menu ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>添加学生</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="admin_search_student.php"
                                        class="nav-link <?php echo $add_student_search_menu ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>搜索学生</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  <?php echo $course_drop_menu ?>">
                            <a href="#" class="nav-link <?php echo $course_menu ?>">
                                <i class="nav-icon fas fa-solid fa-graduation-cap"></i>
                                <!-- <i class="fa-solid fa-graduation-cap"></i> -->
                                <p>
                                    课程功能
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="admin_add_course.php" class="nav-link  <?php echo $add_course_menu ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>添加课程</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="admin_all_course.php" class="nav-link <?php echo $all_course_menu ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>所有课程</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/forms/advanced.html"
                                        class="nav-link <?php echo $course_Details_menu ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>课程详情</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?php echo $teacher_drop_menu ?>">
                            <a href="#" class="nav-link  <?php echo $teacher_menu ?>">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    老师功能
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="admin_add_teacher.php" class="nav-link  <?php echo $teacher_add_menu ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>添加老师</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="admin_all_teacher.php" class="nav-link  <?php echo $all_teacher_menu ?>">
                                        <i class=" far fa-circle nav-icon"></i>
                                        <p>所有老师 </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"
                                style="font-family: 'Lobster', cursive;text-shadow: -4px -1px 4px rgba(150, 150, 150, 1);">
                                <?php echo $breadcrumb_name ?>
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">首页</a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo $breadcrumb_name ?>
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">