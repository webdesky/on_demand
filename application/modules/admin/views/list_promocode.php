<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">PromoCode List </h1>
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
                    <a class="btn btn-primary" href="<?php echo base_url('admin/promocode')?>"><i class="fa fa-th-list">&nbsp;Add PromoCode </i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                        <thead>
                            <tr class="bg-primary">
                                <th>Sr.No</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <!-- <th>Validity</th> -->
                                <th>Active from</th>
                                <th>Active till</th>
                                <th>No of Usage</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; if(!empty($promocode)) {  foreach ($promocode as  $value) {?>
                            <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td class="center">
                                    <?php echo ucwords($value->promo_code); ?>
                                </td>
                                
                                <td class="center">
                                    <?php echo $value->description;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->discount_type;  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->discount_amount;  ?>
                                </td>
                                <!-- <td class="center">
                                    <?php //echo $value->validity_type;  ?>
                                </td> -->
                                <td class="center">
                                    <?php if($value->active_date!='0000-00-00' && $value->active_date!='1970-01-01'){ echo date('Y-m-d',strtotime($value->active_date));}else{ echo "";}  ?>
                                </td>
                                <td class="center">
                                    <?php  if($value->expiry_date!='0000-00-00' && $value->expiry_date!='1970-01-01'){ echo date('Y-m-d',strtotime($value->expiry_date));}else{ echo "";}  ?>
                                </td>
                                <td class="center">
                                    <?php echo $value->usage_limit;  ?>
                                </td>
                                <td class="center">
                                    <?php if($value->is_active==1){ echo "active";}else{echo "inactive"; }  ?>
                                </td>
                                <td class="center">
                                    <a href="<?php echo base_url('admin/promocode/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                    <a href="javascript:void(0)" onclick="delete_record('<?php echo $value->id?>','<?php echo $count;?>','promo_code')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> |
                                    <a title="Change Status" href="javascript:void(0)" onclick="change_status('<?php echo $value->id?>','promo_code','<?php echo $value->is_active?>')"><i class="fa fa-power-off" aria-hidden="true"></i></a>
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