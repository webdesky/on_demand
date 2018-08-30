<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add User</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/list_user')?>"><i class="fa fa-th-list">&nbsp;Users List</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                        <?php 
                            if(!empty($users[0])){
                                $url = base_url('admin/register/'.$users[0]->id);
                            }else{
                                $url = base_url('admin/register/');
                            }
                        ?>

                            <form role="form" method="post" action="<?php echo $url ?>" class="registration_form12" enctype="multipart/form-data" id="registration_form">
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">First Name *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" placeholder="First Name" maxlength="30" name="first_name" id="first_name" autocomplete="off" value="<?php if(!empty($users[0]->first_name)){ echo $users[0]->first_name;}else{ echo set_value('first_name');} ?>">
                                            <span class="red"><?php echo form_error('first_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Last Name *</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="last_name" placeholder="Last Name" maxlength="30" autocomplete="off" value="<?php if(!empty($users[0]->last_name)){ echo $users[0]->last_name;}else{ echo set_value('last_name');} ?>">
                                            <span class="red"><?php echo form_error('last_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">E-mail *</label>
                                        <div class="col-md-9">
                                            <input type="text" name="email" class="form-control" placeholder="Email Address" autocomplete="new-password" value="<?php if(!empty($users[0]->email)){ echo $users[0]->email;}else{ echo set_value('email');} ?>">
                                            <span class="red"><?php echo form_error('email'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Password *</label>
                                        <div class="col-md-9">
                                            <input type="Password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="new-password" value="<?php if(!empty($users[0]->password)){ echo $users[0]->password;}else{ echo set_value('password');} ?>">
                                            <span class="red"><?php echo form_error('password'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Country *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="country" id="country" onchange="get_state(this.value)">
                                            <option value="">-- Select Country --</option>
                                            <?php foreach($countries as $country){?>
                                            <option value="<?php echo $country->id?>" <?php if(!empty($users[0]->country_id) && $users[0]->country_id==$country->id){ echo 'selected';}?>>
                                                <?php echo $country->name?>
                                            </option>
                                            <?php }?>
                                        </select>
                                            <span class="red"><?php echo form_error('country'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">State *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="state" id="state" onchange="get_city(this.value)">
                                                <option value="">-- Select State --</option>
                                                <option value="<?php if(!empty($users[0]->state_id)){ echo $users[0]->state_id;}?>" <?php if(!empty($users[0]->state_id)){ echo 'selected';}?>>
                                                <?php if(!empty($users[0]->state_name)){ echo $users[0]->state_name;}?>
                                            </option>
                                            </select>
                                            <span class="red"><?php echo form_error('state'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">City *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="city" id="city">
                                                <option value="">-- Select City --</option>
                                                <option value="<?php if(!empty($users[0]->city)){ echo $users[0]->city;}?>" <?php if(!empty($users[0]->city)){ echo 'selected';}?>>
                                                <?php if(!empty($users[0]->city_name)){ echo $users[0]->city_name;}?>
                                            </option>
                                            </select>
                                            <span class="red"><?php echo form_error('city'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Phone No *</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="phone_no" maxlength="10" placeholder="Phone Number" autocomplete="off" value="<?php if(!empty($users[0]->phone_no)){ echo $users[0]->phone_no;}else{ echo set_value('phone_no');} ?>">
                                            <span class="red"><?php echo form_error('phone_no'); ?></span>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Picture</label>
                                        <div class="col-md-9">
                                            <input type="file" name="images[]" id="image" class="form-control">
                                            <span class="red"><?php echo form_error('image'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Address</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="5" name="address" placeholder="Address"><?php echo set_value('address');?><?php if(!empty($users[0]->address)){ echo $users[0]->address;}else{ echo set_value('address');} ?></textarea>
                                            <span class="red"><?php echo form_error('address'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Gender *</label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender"  value="male" checked>Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender"  value="female">Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Zip *</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="zip" maxlength="10" placeholder="ZIP" autocomplete="off" value="<?php if(!empty($users[0]->zip)){ echo $users[0]->zip;}else{ echo set_value('zip');} ?>">
                                            <span class="red"><?php echo form_error('zip'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12" align="center">
                                    <input type="submit" name="submit" class="btn btn-success" value="Save">&nbsp;
                                    <input type="reset" class="btn btn-default" value="Reset">
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

