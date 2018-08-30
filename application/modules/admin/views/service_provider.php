<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Service Provider</h1>
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
                            if(!empty($service_provider[0])){
                                $url = base_url('admin/service_provider/'.$service_provider[0]->id);
                            }else{
                                $url = base_url('admin/service_provider/');
                            }
                        ?>
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo $url; ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group"> <label class="col-md-2">Company Name *</label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="company_id">
                                            <option value="">--Select Company--</option>
                                            <?php foreach($companies as $company){?>
                                            <option value="<?php echo $company->id;?>" <?php if(!empty($service_provider[0]->company_id) && $company->id==$service_provider[0]->company_id){ echo 'selected';}?>>
                                                <?php echo $company->name;?>
                                            </option>
                                            <?php }?>
                                        </select>
                                        <span class="red" id="old">
                                            <?php echo form_error('company_id'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">First Name *</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="first_name" value="<?php if(!empty($service_provider[0]->first_name)){ echo $service_provider[0]->first_name;}else{ echo set_value('first_name');} ?>">
                                        <span class="red" id="old">
                                            <?php echo form_error('first_name'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Last Name *</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="last_name" value="<?php if(!empty($service_provider[0]->last_name)){ echo $service_provider[0]->last_name;}else{ echo set_value('last_name');} ?>">
                                        <span class="red" id="old">
                                            <?php echo form_error('last_name'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Email *</label>
                                    <div class="col-lg-6"> <input class="form-control" type="email" placeholder="Company Email" name="email" autocomplete="off" id="email" required="required" value="<?php if(!empty($service_provider[0]->email)){ echo $service_provider[0]->email;}else{ echo set_value('email');} ?>">
                                        <span class="red" id="old">
                                            <?php echo form_error('email'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Password *</label>
                                    <div class="col-lg-6"> <input class="form-control" type="password" placeholder="Company password" name="password" autocomplete="off" id="password" required="required" value="<?php if(!empty($service_provider[0]->password)){ echo $service_provider[0]->password;}else{ echo set_value('password');} ?>">
                                        <span class="red" id="old">
                                            <?php echo form_error('password'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Gender *</label>
                                    <div class="col-lg-6"> <input type="radio" name="gender" value="male" <?php if(!empty($service_provider[0]->gender) && $service_provider[0]->gender=="male"){echo 'checked';}?>>Male <input type="radio" name="gender" value="female" <?php if(!empty($service_provider[0]->gender) && $service_provider[0]->gender=="female"){echo 'checked';}?>>Female <span class="red" id="old">
                                            <?php echo form_error('gender'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Images </label>
                                    <div class="col-lg-6"> <input name="image[]" class="form-control" type="file">
                                        <?php   
                                        if(!empty($service_provider[0]->image)){
                                            $image = explode(',',$service_provider[0]->image); 
                                            for($i=0;$i<count($image);$i++){?>
                                        <img src="<?php echo base_url('asset/uploads/'.trim($image[$i]));?>" width="100px" height="100px">
                                        <?php }}?>
                                    </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Country *</label>
                                    <div class="col-lg-6"> <select class="form-control" name="country" id="country" onchange="get_state(this.value)"><option value="">--Select Country--</option>
                                            <?php foreach($countries as $country){?>
                                            <option value="<?php echo $country->id?>" <?php if(!empty($service_provider[0]->country_id) && $service_provider[0]->country_id==$country->id){ echo 'selected';}?>>
                                                <?php echo $country->name?>
                                            </option>
                                            <?php }?>
                                        </select>
                                        <span class="red" id="old"><?php echo form_error('country'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">State *</label>
                                    <div class="col-lg-6"> <select class="form-control" name="state" id="state" onchange="get_city(this.value)">
                                            <option value="">--Select State--</option>
                                            <option value="<?php if(!empty($service_provider[0]->state_id)){ echo $service_provider[0]->state_id;}?>" <?php if(!empty($service_provider[0]->state_id)){ echo 'selected';}?>>
                                                <?php if(!empty($service_provider[0]->state_name)){ echo $service_provider[0]->state_name;}?>
                                            </option>
                                        </select>
                                        <span class="red" id="old">
                                            <?php echo form_error('state'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">City *</label>
                                    <div class="col-lg-6"> <select class="form-control" name="city" id="city">
                                            <option value="">--Select City--</option>
                                            <option value="<?php if(!empty($service_provider[0]->city)){ echo $service_provider[0]->city;}?>" <?php if(!empty($service_provider[0]->city)){ echo 'selected';}?>>
                                                <?php if(!empty($service_provider[0]->city_name)){ echo $service_provider[0]->city_name;}?>
                                            </option>
                                        </select>
                                        <span class="red" id="old">
                                            <?php echo form_error('city'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Zip *</label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" placeholder="Zip" name="zip" autocomplete="off" id="zip" required="required" value="<?php if(!empty($service_provider[0]->zip)){ echo $service_provider[0]->zip;}else{ echo set_value('zip');} ?>">
                                        <span class="red" id="old">
                                            <?php echo form_error('zip'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Address *</label>
                                    <div class="col-lg-6"> <textarea class="form-control" placeholder="Address" name="address" autocomplete="off" id="address" required="required"><?php if(!empty($service_provider[0]->address)){ echo $service_provider[0]->address;}else{ echo set_value('address');} ?></textarea>
                                        <span class="red" id="old">
                                            <?php echo form_error('address'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Phone *</label>
                                    <div class="col-lg-6"> <input class="form-control" type="text" placeholder="Phone" name="phone" autocomplete="off" id="phone" required="required" value="<?php if(!empty($service_provider[0]->phone)){ echo $service_provider[0]->phone;}else{ echo set_value('phone');} ?>">
                                        <span class="red" id="old">
                                            <?php echo form_error('phone'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Profile Description *</label>
                                    <div class="col-lg-6"> <textarea class="form-control" name="description" id="description"><?php if(!empty($service_provider[0]->description)){ echo $service_provider[0]->description;}else{ echo set_value('description');} ?></textarea>
                                        <span class="red" id="old">
                                            <?php echo form_error('description'); ?></span> </div>
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