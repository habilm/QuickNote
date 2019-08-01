<?php
defined("BASEPATH") or exit("go Hell");

?>
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-5 mx-auto ">
            <div style="margin-top:38%;">
            <?php echo  validation_errors('
                <div class="alert alert-warning alert-dismissible" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning!</strong> ',
                '</div>');
                echo isset($error)?$error:""; ?>
            </div>
            <div class="border_2 qn_shadow main_door login-box" id="log_form" style="margin-top:5%;padding: 20px">
            
                <h1 class="text-center">Login</h1>
                <br>
                <?php echo form_open("me/login",array("calss"=>"loginFrom")); ?>
                    <div class="form-group qn_form_group input_email">
                        <?php echo form_input(["type"=>"emafil","class"=>"qn_input f-c_bule","autofocus"=>"autofocus","autocomplete"=>"off","name"=>"email","placeholder"=>"Email Address"]); ?>
                        <div class="input-bottom-bodr"></div>
                    </div>
                    <div class="form-group qn_form_group input_password">
                        <?php echo form_input(["type"=>"password","class"=>"qn_input f-c_bule","autofocus"=>"autofocus","autocomplete"=>"off","name"=>"password","placeholder"=>"Password"]); ?>
                        <div class="input-bottom-bodr"></div>
                    </div>
                    <!-- <div class="form-group">
                        <?php //echo form_input(["type"=>"checkbox","value"=>"remember","class"=>"qn_checkbox","name"=>"remember","style"=>"border:none"]); ?><lable for="remember">Remember me</lable>
                    </div>-->
                    <div class="form-group text-center"> 
                        <?php echo form_submit("login","Login",["class"=>"btn btn-center btn-primary"]); ?>
                        
                    </div>
                <?php echo form_close(); ?>
                <div class="row">
                    <p class="col-6 text-left hover-blue"><a href="#forget" id="forget" >Forget password</a></p>
                <p class="col-6 text-right hover-blue"><a href="#" id="CreateNew">Create New Account</a></p>
                </div>
            </div>
        </div> 
    </div>
</div>