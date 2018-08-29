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
                                 <a href="<?php echo base_url('admin/companies/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                 <a href="javascript:void(0)" onclick="delete_record('<?php echo $value->id?>','<?php echo $count;?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

function delete_record(id, tr_id) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "<?php echo base_url('admin/delete')?>",
            type: "POST",
            data: {
                id: id,
                table: 'companies',
            },
            success: function () {
                swal("Done!", "It was succesfully deleted!", "success");
                 $('#tr_' + tr_id).remove();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
            }
        });
    });
}
   

// $(document).ready(function() {
//     $('#notice').DataTable( {
//         responsive: {
//             details: {
//                 display: $.fn.dataTable.Responsive.display.modal( {
//                     header: function ( row ) {
//                         var data = row.data();
//                         return 'Details for '+data[1];
//                     }
//                 } ),
//                 renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
//                     tableClass: 'table'
//                 } )
//             }
//         }
//     } );
// });

</script>