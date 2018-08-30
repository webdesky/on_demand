<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add PromoCode</h1>
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
                        if(!empty($categories[0])){
                            $url = base_url('admin/promocode/'.$promocode[0]->id);
                        }else{
                            $url = base_url('admin/promocode/');
                        }
                    ?>
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo $url; ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-2">Coupon Code *</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" placeholder="Promo Code" name="promo_code" autocomplete="off" id="promo_code" required="required" value="<?php if(!empty($promocode[0]->promo_code)){ echo $promocode[0]->promo_code;}else{ echo set_value('promo_code');} ?>">
                                        <span class="red" id="old">
                                            <?php echo form_error('promo_code'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Description</label>
                                    <div class="col-lg-6">
                                        <textarea name="description" id="description" class="form-control" placeholder="Promocode Short Description"><?php if(!empty($promocode[0]->description)){ echo $promocode[0]->description;}else{ echo set_value('description');} ?></textarea>
                                        <span class="red" id="new">
                                            <?php echo form_error('description'); ?></span>
                                    </div>
                                </div>
                                <br />
                                <div class="clearfix"></div>
                                <br />
                                <div class="form-group"> <label class="col-md-2">Discount Type *</label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="discount_type" id="discount_type" required="required">
                                            <option value="">Select</option>
                                            <option value="percent" <?php if(!empty($promocode[0]->discount_type)){ if($promocode[0]->discount_type=='percent'){ echo "selected";}}else{ echo "";}?> >Percentage</option>
                                            <option value="fixed" <?php if(!empty($promocode[0]->discount_type)){ if($promocode[0]->discount_type=='fixed'){ echo "selected";}}else{ echo "";}?> >Fixed Amount</option>
                                        </select>
                                        <span class="red" id="old">
                                            <?php echo form_error('discount_type'); ?></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class="col-md-2">Discount Amount *</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" placeholder="Discount Amount" name="discount_amount" autocomplete="off" id="discount_amount" required="required" value="<?php if(!empty($promocode[0]->discount_amount)){ echo $promocode[0]->discount_amount;}else{ echo set_value('discount_amount');} ?>">
                                        <span class="red" id="old">
                                            <?php echo form_error('discount_amount'); ?></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group"> <label class="col-md-2">Validity Type *</label>
                                    <div class="col-lg-6">
                                        <input type="radio" name="validity_type" id="validity_type_0" value="permanent" onclick="get_active_date()" checked="checked" <?php if(!empty($promocode[0]->validity_type)){ if($promocode[0]->validity_type=='permanent'){ echo "checked";}}else{ echo "";}?>>Permanent <input type="radio" name="validity_type" id="validity_type_1" value="custom" onclick="get_active_date()" <?php if(!empty($promocode[0]->validity_type)){ if($promocode[0]->validity_type=='custom'){ echo "checked";}}else{ echo "";}?>>Custom </div>
                                    <span class="red" id="old">
                                        <?php echo form_error('validity_type'); ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <?php 
                                if(!empty($promocode[0]->validity_type))
                                { ?>
                                <div class="form-group" id="active_date_div" <?php if($promocode[0]->validity_type=='permanent') { echo 'style="display: none" ';}?> > <label class="col-md-2">Activation Date *</label>
                                    <div class="col-lg-6">
                                        <input class="form-control date" type="text" placeholder="Activation Date" name="active_date" autocomplete="off" id="active_date" value="<?php if(!empty($promocode[0]->active_date)){ echo $promocode[0]->active_date;}else{ echo set_value('active_date');} ?>">
                                    </div>
                                    <span class="red" id="old">
                                        <?php echo form_error('active_date'); ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group" id="expiry_date_div" <?php if($promocode[0]->validity_type=='permanent') { echo 'style="display: none" ';}?>> <label class="col-md-2">Expiry Date *</label>
                                    <div class="col-lg-6">
                                        <input class="form-control date" type="text" placeholder="Expiry Date" name="expiry_date" autocomplete="off" id="expiry_date" value="<?php if(!empty($promocode[0]->expiry_date)){ echo $promocode[0]->expiry_date;}else{ echo set_value('expiry_date');} ?>">
                                    </div>
                                    <span class="red" id="old">
                                        <?php echo form_error('expiry_date'); ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <?php }else{?>
                                <div class="form-group" id="active_date_div" style="display: none"> <label class="col-md-2">Activation Date *</label>
                                    <div class="col-lg-6">
                                        <input class="form-control date" type="text" placeholder="Activation Date" name="active_date" autocomplete="off" id="active_date" value="<?php if(!empty($promocode[0]->active_date)){ echo $promocode[0]->active_date;}else{ echo set_value('active_date');} ?>">
                                    </div>
                                    <span class="red" id="old">
                                        <?php echo form_error('active_date'); ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group" id="expiry_date_div" style="display: none"> <label class="col-md-2">Expiry Date *</label>
                                    <div class="col-lg-6">
                                        <input class="form-control date" type="text" placeholder="Expiry Date" name="expiry_date" autocomplete="off" id="expiry_date" value="<?php if(!empty($promocode[0]->expiry_date)){ echo $promocode[0]->expiry_date;}else{ echo set_value('expiry_date');} ?>">
                                    </div>
                                    <span class="red" id="old">
                                        <?php echo form_error('expiry_date'); ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <?php
                                }
                                ?>
                                <div class="form-group"> <label class="col-md-2">Usage Limit *</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" placeholder="Usage Limit" name="usage_limit" autocomplete="off" id="usage_limit" required="required" value="<?php if(!empty($promocode[0]->usage_limit)){ echo $promocode[0]->usage_limit;}else{ echo set_value('usage_limit');} ?>">
                                    </div>
                                    <span class="red" id="old">
                                        <?php echo form_error('usage_limit'); ?></span>
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

    function get_active_date() {
        if (document.getElementById('validity_type_0').checked == true) {
            $("#active_date_div").hide();
            $("#expiry_date_div").hide();
        } else {
            $("#active_date_div").show();
            $("#expiry_date_div").show();
        }
    }
</script>