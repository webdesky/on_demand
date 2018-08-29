<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Product</h1>
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
                        if(!empty($products[0])){
                            $url = base_url('admin/products/'.$products[0]->id);
                        }else{
                            $url = base_url('admin/products/');
                        }
                    ?>
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo $url; ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group"> <label class="col-md-2">Site Mail *</label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" placeholder="Site Mail" name="site_mail" autocomplete="off" id="site_mail" required="required" value="<?php if(!empty($products[0]->site_mail)){ echo $products[0]->site_mail;}else{ echo set_value('site_mail');} ?>"> <span class="red" id="old"><?php echo form_error('site_mail'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Site Phone * </label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" name="site_phone" id="site_phone" placeholder="Price" autocomplete="off" required="required" value="<?php if(!empty($products[0]->site_phone)){ echo $products[0]->site_phone;}else{ echo set_value('site_phone');} ?>"> 
                                    <span class="red"><?php echo form_error('site_phone'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Site Alternative Phone * </label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" name="site_phone" id="site_phone" placeholder="Price" autocomplete="off" required="required" value="<?php if(!empty($products[0]->site_phone)){ echo $products[0]->site_phone;}else{ echo set_value('site_phone');} ?>"> 
                                    <span class="red"><?php echo form_error('site_phone'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Logo </label>
                                    <div class="col-lg-6"> <input type="file" id="site_logo" class="form-control">
                                    <span class="red" id="new"><?php echo form_error('site_logo'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Facebook Page Url </label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" name="site_phone" id="site_phone" placeholder="Price" autocomplete="off" required="required" value="<?php if(!empty($products[0]->site_phone)){ echo $products[0]->site_phone;}else{ echo set_value('site_phone');} ?>">
                                    <span class="red" id="new"><?php echo form_error('brief_description'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Linked Page Url </label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" name="site_phone" id="site_phone" placeholder="Price" autocomplete="off" required="required" value="<?php if(!empty($products[0]->site_phone)){ echo $products[0]->site_phone;}else{ echo set_value('site_phone');} ?>">
                                    <span class="red" id="new"><?php echo form_error('brief_description'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Google+ Page Url </label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" name="site_phone" id="site_phone" placeholder="Price" autocomplete="off" required="required" value="<?php if(!empty($products[0]->site_phone)){ echo $products[0]->site_phone;}else{ echo set_value('site_phone');} ?>">
                                    <span class="red" id="new"><?php echo form_error('brief_description'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Pinterest Page Url </label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" name="site_phone" id="site_phone" placeholder="Price" autocomplete="off" required="required" value="<?php if(!empty($products[0]->site_phone)){ echo $products[0]->site_phone;}else{ echo set_value('site_phone');} ?>">
                                    <span class="red" id="new"><?php echo form_error('brief_description'); ?></span> </div>
                                </div>
                               <!--  <div class="form-group"> <label class="col-md-2">Ref Number *</label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" name="site_phone" id="site_phone" placeholder="Price" autocomplete="off" required="required" value="<?php if(!empty($products[0]->site_phone)){ echo $products[0]->site_phone;}else{ echo set_value('site_phone');} ?>">
                                    <span class="red" id="old"><?php echo form_error('ref_no'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Quantity *</label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" placeholder="Quantity" name="quantity" autocomplete="off" id="quantity" required="required" value="<?php if(!empty($products[0]->quantity)){ echo $products[0]->quantity;}else{ echo set_value('quantity');} ?>"> 
                                    <span class="red" id="old"><?php echo form_error('quantity'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Images </label>
                                    <div class="col-lg-6"> <input name="images[]" class="form-control" type="file" multiple="multiple">
                                        <?php   
                                        if(!empty($products[0]->images)){
                                            $images = explode(',',$products[0]->images); 
                                            for($i=0;$i<count($images);$i++){?>
                                        <img src="<?php echo base_url('asset/uploads/'.trim($images[$i]));?>" width="100px" height="100px">
                                        <?php }}?>
                                    </div>
                                </div> -->
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
    CKEDITOR.replace('brief_description');
</script>