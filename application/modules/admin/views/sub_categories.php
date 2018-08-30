<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Sub Category</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if ($info_message = $this->session->flashdata('success_msg')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <?php if ($error_message = $this->session->flashdata('error')): ?>
            <div id="form-messages" class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="row">
                    <?php 
                        if(!empty($sub_categories[0])){
                            $url = base_url('admin/sub_categories/'.$sub_categories[0]->id);
                        }else{
                            $url = base_url('admin/sub_categories/');
                        }
                    ?>

                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo $url; ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group"> <label class="col-md-2">Choose Category *</label>
                                    <div class="col-lg-6"> <select class="form-control" name="cat_id">
                                        <option value=""> --Select Category--</option>
                                        <?php foreach($categories as $category){?>
                                        <option value="<?php echo $category->id?>" <?php if(!empty($sub_categories[0]->cat_id) && $sub_categories[0]->cat_id==$category->id){ echo 'selected';}?>><?php echo $category->name?> </option>
                                        <?php }?>
                                    </select>
                                            <?php echo form_error('cat_id'); ?></span> </div>
                                </div>

                                <div class="form-group"> <label class="col-md-2">Sub Category name *</label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" placeholder="Sub Category name" name="name" autocomplete="off" id="name" required="required" value="<?php if(!empty($sub_categories[0]->name)){ echo $sub_categories[0]->name;}else{ echo set_value('name');} ?>">
                                    <span class="red" id="old">
                                            <?php echo form_error('name'); ?></span> </div>
                                </div>
                              
                                <div class="form-group"> <label class="col-md-2">Short Description </label>
                                    <div class="col-lg-6"> <textarea name="description" id="description" class="form-control" placeholder="Category Short Description"><?php if(!empty($sub_categories[0]->description)){ echo $sub_categories[0]->description;}else{ echo set_value('description');} ?></textarea><span class="red" id="new">
                                            <?php echo form_error('description'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Images </label>
                                    <div class="col-lg-6"> <input name="image[]" class="form-control" type="file">
                                        <?php   
                                        if(!empty($sub_categories[0]->image)){
                                            $image = explode(',',$sub_categories[0]->image); 
                                            for($i=0;$i<count($image);$i++){?>
                                        <img src="<?php echo base_url('asset/uploads/'.trim($image[$i]));?>" width="100px" height="100px">
                                        <?php }}?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12" align="center">
                                    <input type="submit" id="submit" name="submit" class="btn btn-success" value="Save">&nbsp; <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </form>
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

<script>
  CKEDITOR.replace('description');
</script>