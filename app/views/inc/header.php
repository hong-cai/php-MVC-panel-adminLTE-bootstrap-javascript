<?php $role = checkId(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?php echo SITENAME; ?> </title>
        <!-- daterangepicker -->
        <link rel="stylesheet" type="text/css"
            href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <!-- Theme style -->
        <link href="<?php echo PUBLIC_URL . '/css/adminlte.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- font awesome -->
        <link rel="stylesheet" href=<?php echo PUBLIC_URL . '/css/panel.css'; ?> />
        <script src="https://use.fontawesome.com/2848b72bab.js"></script>

    </head>

    <body>
        <div class="main w-100 h-100">
            <div class="admin-card admin">
                <div class="admin-card-wrapper">
                    <div class='admin-nav-wrapper elevation-4'>
                        <span class="pull-right p-2"><i class="fa fa-times" aria-hidden="true"></i> </span>
                        <div class="my-4 d-flex justify-content-center">
                            <a class="brand-link" href="<?php echo URL; ?>"><span
                                    class="text-secondary font-weight-light">Admin
                                    Panel</span></a>
                        </div>

                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="true">
                            <li class="nav-item">
                                <a class="nav-link admin-nav-tag" href="<?php echo URL . '/users/index'; ?>">
                                    <i class="nav-icon fa fa-tachometer"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link admin-nav-tag" href="<?php echo URL . '/notes'; ?>">
                                    <i class="nav-icon fa fa-sticky-note"></i>
                                    <p>Notes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php
                                        if ($role !== 'admin') {
                                            echo 'javascript:void(0);';
                                        } else {
                                            echo URL . '/notes/add';
                                        }
                                        ?>" class="nav-link admin-nav-tag <?php
                                                                            if ($role !== 'admin') {
                                                                                echo 'bg-light';
                                                                            }
                                                                            ?>" style="<?php
                                                                                            if ($role !== 'admin') {
                                                                                                echo "pointer-events:none;";
                                                                                            }
                                                                                            ?>">
                                    <i class="nav-icon fa fa-plus"></i>
                                    <p>Add a note</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link admin-nav-tag">
                                    <i class="nav-icon fa fa-cog fa-fw"></i>
                                    <p>
                                        Settings
                                        <i class="fa fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item admin-nav-tag">
                                        <a href="<?php echo URL . '/users/profile'; ?>" class="nav-link">
                                            <i class="fa fa-user nav-icon"></i>
                                            <p>Profile</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php
                                                if ($role !== 'admin') {
                                                    echo 'javascript:void(0);';
                                                } else {
                                                    echo URL . '/users/adminCreate';
                                                }
                                                ?>" class="nav-link admin-nav-tag <?php
                                                                                    if ($role !== 'admin') {
                                                                                        echo 'bg-light';
                                                                                    }
                                                                                    ?>" style="<?php
                                                                                                if ($role !== 'admin') {
                                                                                                    echo "pointer-events:none;";
                                                                                                }
                                                                                                ?>">
                                            <i class="fa fa-edit nav-icon"></i>
                                            <p class="<?php
                                                    if ($role !== 'admin') {
                                                        echo 'text-muted';
                                                    }
                                                    ?>">Create Users</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php
                                                if ($role !== 'admin') {
                                                    echo 'javascript:void(0);';
                                                } else {
                                                    echo URL . '/users/editUsers';
                                                }
                                                ?>" class="nav-link admin-nav-tag <?php
                                                                                    if ($role !== 'admin') {
                                                                                        echo 'bg-light';
                                                                                    }
                                                                                    ?>" style="<?php
                                                                                                if ($role !== 'admin') {
                                                                                                    echo "pointer-events:none;";
                                                                                                }
                                                                                                ?>">
                                            <i class="fa fa-edit nav-icon"></i>
                                            <p class="<?php
                                                    if ($role !== 'admin') {
                                                        echo 'text-muted';
                                                    }
                                                    ?>">Edit Users</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                    <div class="admin-content-wrapper">
                        <nav class="navbar navbar-expand">
                            <h4 class="navbar-nav">
                                <button class="btn d-inline d-md-none bg-transparent text-center border-0"> <i
                                        class="fa fa-bars"></i> &nbsp; </button>
                                <?php
                            $currentURL = explode('/', $_GET['url']);

                            echo isset($_GET['url']) ? ucwords($currentURL[0]) : 'Dashboard'; ?>
                            </h4>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item mx-2">Welcome
                                    <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest'; ?>,
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-info btn-sm text-nowrap text-white"
                                        href="<?php
                                                                                            if (isset($_SESSION['user_id'])) {
                                                                                                echo URL . '/users/logout';
                                                                                            } else {
                                                                                                echo URL . '/users/login';
                                                                                            }; ?>"><?php echo isset($_SESSION['user_id']) ? 'Sign out' : 'Login'; ?></a>
                                </li>
                            </ul>
                        </nav>