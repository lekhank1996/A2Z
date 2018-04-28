<!--User List View From Non-Admin Login-->
<?php echo $header; ?>
<?php echo $leftmenu; ?>
<div class="content-wrapper">
    <aside class="side">
        <section class="content-header">
            <h2>
                <?php echo 'User List'; ?>
            </h2>
            <ol class="breadcrumb pull-left">
                <li class="pull-left"><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><i class="fa fa-list"></i> &nbsp;&nbsp;User List</li>
            </ol>
        </section>
    </aside>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="box-header" align="center">
                            <a href="<?php echo base_url(); ?>user/adduser"><button class="btn btn-default btn-success" type="button">Add user</button></a>
                            <a href="<?php echo site_url('dashboard'); ?>"><button class="btn btn-default btn-warning" type="button">Cancel</button></a>
                            </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>      
                                    <th>User Name</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($h->result() as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row->username; ?></td>
                                        <td><?php echo $row->firstname; ?>
                                            <?php echo $row->lastname; ?></td>
                                        <td><?php echo $row->gender; ?></td>
                                        <td><?php echo $row->image; ?></td>                  
                                        <td><a href=" <?php echo site_url('user').'/edit/'.$row->user_id; ?>" class='btn btn-info btn-lg'><span class='fa fa-pencil'></span></a>&nbsp;&nbsp;
                                            <a href="<?php echo site_url('user').'/delete/'.$row->user_id; ?>" onclick=\"return confirm('Are You Sure You Want To Delete?')\" class='btn btn-danger btn-lg'><span class='fa  fa-trash'></span></a></td>       
                                        
                                    </tr>
                                <?php }
                                ?>   

                            </tbody>
                        </table>
                         
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
// echo $footer;?>