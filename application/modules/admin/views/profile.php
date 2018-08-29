<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
         <?php if ($info_message = $this->session->flashdata('success_msg')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <?php if ($error_message = $this->session->flashdata('error')): ?>
            <div id="form-messages" class="alert alert-danger" role="alert">
                <?php echo $error_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/profile') ?>" class="registration_form1" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group"> <label class="col-md-2">First Name:* </label>
                                    <div class="col-lg-6"> <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="<?php echo $users[0]->first_name;?>"> <span class="red">
                                            <?php echo form_error('first_name'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Last Name: * </label>
                                    <div class="col-lg-6"> <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="<?php echo $users[0]->last_name;?>"> <span class="red">
                                            <?php echo form_error('last_name'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Email: * </label>
                                    <div class="col-lg-6"> <input type="text" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $users[0]->email;?>"> <span class="red">
                                            <?php echo form_error('email'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Mobile : * </label>
                                    <div class="col-lg-6"> <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile" value="<?php echo $users[0]->mobile;?>"> <span class="red">
                                            <?php echo form_error('mobile'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Phone no : * </label>
                                    <div class="col-lg-6"> <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" value="<?php echo $users[0]->phone_no;?>"> <span class="red">
                                            <?php echo form_error('phone'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Country : *</label>
                                    <div class="col-lg-6"> <select class="form-control" name="country" id="country" onchange="get_state(this.value)"><option>--Select Country--</option><?php foreach($country as $countries){?>
                                            <option value="<?php echo $countries->id?>"<?php if(!empty($users[0]->country_id) && ($countries->id===$users[0]->country_id)){echo 'selected';}?>><?php echo $countries->name?></option>
                                            <?php }?></select> <span class="red"><?php echo form_error('country'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">State : *</label>
                                    <div class="col-lg-6"> <select class="form-control" name="state" id="state" onchange="get_city(this.value)"><option>--Select State--</option>
                                        </select><span class="red">
                                            <?php echo form_error('state'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">City : *</label>
                                    <div class="col-lg-6"> <select class="form-control" name="city" id="city"><option>--Select City--</option>
                                        </select> <span class="red"><?php echo form_error('city'); ?></span> </div>
                                </div>
                                
                                <div class="form-group"> <label class="col-md-2">Zip : *</label>
                                    <div class="col-lg-6"> <input type="text" class="form-control" name="zip" placeholder="Enter ZipCode" value="<?php echo $users[0]->zip;?>"><span class="red">
                                            <?php echo form_error('zip'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Street : *</label>
                                    <div class="col-lg-6"> <textarea class="form-control" name="street" placeholder="Enter Street"><?php echo $users[0]->street;?></textarea> <span class="red">
                                            <?php echo form_error('street'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Profile Pic: </label>
                                    <div class="col-lg-6"> <input type="file" name="image" class="form-control"> <span class="red">
                                            <?php echo form_error('image'); ?></span> </div>
                                </div>
                                <?php if(!empty($users[0]->profile_pic)){?>
                                <div class="col-md-6" align="center">
                                    <div class="form-group">
                                        <img src="<?php echo base_url('asset/uploads/').$users[0]->profile_pic ?>" style="max-width: 100px;max-height: 100px;">
                                    </div>
                                </div>
                                <?php }?>
                                <div class="clearfix"></div>
                                <div class="col-md-12" align="center">
                                    <input type="submit" name="submit" value="Save" class="btn btn-success">&nbsp; <button type="reset" class="btn btn-default">Reset</button>
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