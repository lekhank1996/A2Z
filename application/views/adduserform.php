<?php echo $header; ?>
<?php echo $leftmenu; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <section class="content-header">
        <h2>
            <?php echo 'Add New User Form'; ?>
            <small><?php echo 'Edit'; ?></small>
        </h2>
        <ol class="breadcrumb pull-left">
            <li class="pull-left"><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-file"></i> &nbsp;&nbsp;Add User</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="confirm-div" ><?php echo $this->session->flashdata('msg'); ?></div>
                <?php
                if ($this->session->flashdata('message')) {
                    ?>
                    <!--  start message-red -->
                    <div class="box-body">
                        <div class=" alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            <?php echo $this->session->flashdata('message'); ?> 
                        </div>
                    </div>
                    <!--  end message-red -->
                <?php } ?>
                <?php
                if ($this->session->flashdata('success')) {
                    ?>
                    <!--  start message-green -->
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>	<i class="icon fa fa-check"></i> Success!</h4>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <!--  end message-green -->
                <?php } ?>
                <!-- general form elements -->
                <div class="box box-warning">
                    <br>

                    <!-- form start -->

                    <form method="POST" action="<?php echo base_url(); ?>user/add" enctype="multipart/form-data" id="change_pass_form" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-4" id="username_div">
                                        <label>UserName:</label><span style="color: #b94a48;">*</span>    

                                        <input type="text" name="username" id="username" class="form-control" />
                                        <div id="err_msg_op"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group col-md-4" id="password_div">
                                        <label>Password:</label><span style="color: #b94a48;"> *</span> 

                                        <input type="password" name="password" id="password" class="form-control" />
                                        <div id="err_msg_cp"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group col-md-4" id="firstname_div">
                                        <label>First Name:</label><span style="color: #b94a48;">*</span>    

                                        <input type="text" name="firstname" id="firstname" class="form-control" />
                                        <div id="err_msg_op"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group col-md-4" id="lastname_div">
                                        <label>Last Name:</label><span style="color: #b94a48;"> *</span>  

                                        <input type="text" name="lastname" id="lastname" class="form-control" />
                                        <div id="err_msg_np"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group col-md-4">
                                        <label>File:</label>
                                        <input type="file" name="file" id="file" />
                                        <div id="err_msg_np"></div>
                                    </div>
                                </div>
                     
                                <div class="col-md-12">
                                    <div class="form-group col-md-4" id="gender_div">
                                        <label>Gender:</label><span style="color: #b94a48;"> *</span> 
                                       <input type="radio" name="gender" value="Male"   />Male &nbsp;
                                       <input type="radio" name="gender" value="Female"  />Female
                                        <div id="err_msg_cp"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">

                                <input name="btn" id="btnsubmit" class="btn btn-primary" type="submit" value="Submit"   >
                                <a href="<?php echo site_url('user'); ?>"><button class="btn btn-default" type="button">Cancel</button></a>
                            </div>
                    
                        </div><!-- /.box -->
                    </form>
                </div><!--/.col (left) -->
            </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<script>

</script>
<script>

</script>
<?php //echo $footer; ?>


