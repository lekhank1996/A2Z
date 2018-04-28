<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <!-- Favicon -->
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

        <title><?php echo"A2Z" ?> | <?php echo $section_title ?></title>

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- Google Location -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9JX3BZZfx2S6GQieC_PqjuJdUbZ7_wyM&libraries=places" async defer></script>

        <!-- Bootstrap 3.3.4 -->
        <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
        <!-- FontAwesome 4.3.0 -->
        <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <!-- Theme style -->
        <link href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?php echo base_url() ?>assets/plugins/iCheck/flat/_all.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo base_url() ?>assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        

        <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
        
        <!-- Date Picker -->
        <link href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" language="javascript" src="assets/jquery-1.8.3.js"></script>
        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.2 -->
        <script src="<?php echo base_url() ?>assets/jquery-ui.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url() ?>assets/form-validator/jquery.form-validator.min.js"></script> 
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/form-validator/theme-default.min.css" type="text/css"/>

        <!-- Multi Selection -->
        <link href="<?php echo base_url() ?>assets/multiselection/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/multiselection/bootstrap-multiselect.js"></script>

        <!-- CK Editor -->
        <script src="ckeditor/ckeditor.js"></script>
        
        <style>
            @media screen and (max-width: 640px) {
                table {
                    overflow-x: auto;
                    display: block;
                }
            }
        </style>

    </head>
    <body class="skin-blue sidebar-mini">

        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php site_url();?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">A2Z</span>

                    <span class="logo-lg pull-left"><?php echo "A2Z"; ?></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <!--<div id="google_translate_element" style="float:left; margin: -2px 10px;"></div>-->
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <span>
                                        <?php
                                        if ($this->session->userdata('userdetails')) {
                                            echo ucfirst($this->session->userdata['userdetails']['adminname']);
                                        }
                                        ?>
                                        <i class="caret"></i></span>
                                </a>
                                <?php
                                if (!empty($admindata)) {
                                    $adminlogo = $admindata[0]['adminlogo'];
                                    $date = date('M', strtotime($admindata[0]['createddate'])) . '. ' . date('Y', strtotime($admindata[0]['createddate']));
                                    if (!empty($adminlogo)) {
                                        $adminlogo_image = (($adminlogo != '') ? $adminlogo : $this->config->item('noimage'));
                                    } else {
                                        $adminlogo_image = $this->config->item('noimage');
                                    }
                                } else {
                                    $date = "";
                                    $adminlogo_image = $this->config->item('noimage');
                                }
                                ?>
                                <ul class="dropdown-menu">

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a class="btn btn-default btn-flat" href="<?php echo base_url(); ?>changepassword">Change Password</a>
                                        </div>
                                        <div class="pull-right">
                                            <a class="btn btn-default btn-flat" href="<?php echo base_url();?>login/logout">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>