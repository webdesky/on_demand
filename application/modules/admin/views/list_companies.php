<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Companies List </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/companies')?>"><i class="fa fa-th-list">&nbsp;Add Comapny </i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                        <thead>
                            <tr class="bg-primary">
                                <th>Sr.No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Zip</th>
                                <th>Phone</th>
                                <th>VAT</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; if(!empty($companies)) {  foreach ($companies as  $value) {?>
                            <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td class="center">
                                    <?php echo ucwords($value->name); ?>
                                </td>
                                
                                <td class="center">
                                    <?php echo $value->description;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->email;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->address;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->zip;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->phone;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->vat;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->created_at;  ?>
                                </td>
                                <td class="center">
                                    <?php if($value->is_active==1){echo '<b style="color:green">Active</b>';}else{echo '<b style="color:red">Inavtive</b>';}?>
                                </td>
                                <td class="center">
                                    <a href="<?php echo base_url('admin/companies/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                    <a href="javascript:void(0)" onclick="delete_record('<?php echo $value->id?>','<?php echo $count;?>','companies')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> |
                                    <a title="Change Status" href="javascript:void(0)" onclick="change_status('<?php echo $value->id?>','companies','<?php echo $value->is_active?>')"><i class="fa fa-power-off" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php $count++; }}?>
                        </tbody>
                    </table>
                </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>

<script type="text/javascript">
   $("#notice").DataTable({responsive:!0,aoColumnDefs:[{bSortable:!1,aTargets:[-1]}]});
</script>