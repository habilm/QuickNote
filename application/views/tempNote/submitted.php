<!DOCTYPE html> 
<html>
    <head>
        <title>Create Your Quick Note</title>
        <meta name="viewport" content="width:device-width, initial-scale=1.0"
        <?php 
        echo link_tag(base_url()."assets/css/fa/fontawesome-all.css");
        echo link_tag(base_url()."assets/css/bootstrap.min.css");
        echo link_tag(base_url()."assets/css/main.css");
        ?>
        <style>
            
            body{
                background-color: #f4f4f4;
            }
            .content-box{
                max-width: 768px;
            }
            .mw-400{
                width: 100%;
                max-width: 400px;
            }
            .form-group input::placeholder{ 
                color: #007bff;
                opacity: 0.6; /* Firefox */
            }
            .qn-alert-box{
                margin:10% auto;
            }
        </style>
    </head>
    <body>
        <section class="container">
            <div class="row" style="margin:50px 0">
                <div class="col-sm-12">
                    <div class="mx-auto w-100 content-box text-center" >
                        <img src="<?php echo base_url().'assets/images/logo.png' ?>" class="image-fluid mw-400">
                    </div>
                </div>
            </div>
            
        </section>
        <div class="mx-auto" >
            <div class="qn-alert-box border_2 pad" style="display: block;">
                <h3 class="qn-alert-heading">Saved.</h3>
                <p class="qn-alert-text">Your note sent to your account.</p>
                <div class="row">
                <div class="col-12" id="qn-alert-btns"><a href=""><button class="btn btn-primary  w-25" type="button">Create New</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() ?> "><button class="btn btn-success w-25" type="button">Sign in</button></div>
                <div class="co"></div>
                </div>
            </div>
        </div>
       
    </body>
</html>