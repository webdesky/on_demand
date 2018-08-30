<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/register/')?>"><i class="fa fa-th-list">&nbsp;Add User</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="users">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Sr no.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $i=1;if(!empty($users)){ foreach($users as $users_list){?>
                                        <tr id="tr_<?php echo $i;?>">
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo ucfirst($users_list->full_name);?>
                                            </td>
                                            <td>
                                                <?php echo $users_list->email;?>
                                            </td>
                                            <td>
                                                <?php echo $users_list->phone_no;?>
                                            </td>
                                            <td>
                                                <?php echo ucfirst($users_list->gender);?>
                                            </td>
                                            <td class="center">
                                                <a title="Edit" href="<?php echo base_url('admin/register/'.$users_list->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a title="Delete" href="javascript:void(0)" onclick="delete_record('<?php echo $users_list->id?>','<?php echo $i;?>','users')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> |
                                                <a title="Change Status" href="javascript:void(0)" onclick="change_status('<?php echo $users_list->id?>','users','<?php echo $users_list->is_active;?>')"><i class="fa fa-power-off" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++;}}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
</div>
</div>
<script type="text/javascript">
    $('#users').DataTable({
        responsive: true,
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': [-1] /* 1st one, start by the right */
        }]
    });

    function delete_user(id, tr_id) {
        swal({
            title: "Are you sure?",
            text: "want to delete?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, Delete it!",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "<?php echo base_url('admin/delete')?>",
                data: {
                    id: id,
                    table: 'users'
                },
                type: "POST",
                success: function() {
                    swal("Done!", "It was succesfully deleted!", "success");
                    $('#tr_' + tr_id).remove();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    swal("Error deleting!", "Please try again", "error");
                }
            });
        });
    }
</script>