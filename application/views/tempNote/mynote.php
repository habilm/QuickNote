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
        <section class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mx-auto w-100 content-box" >
                        <form id="mynote" method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="text_head" placeholder="Heading" style="font-size:20px;font-weight: 600;color: #007bff;">
                            </div>
                            <input type="hidden" value="">
                            <div class="form-group">
                                <textarea rows="7" name="text_body" class="form-control" placeholder="Your Note"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="text_submit" value="Save Note" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </section>
        <section class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mx-auto w-100 content-box" >
                        <p class="text-right"><a href="">Login</a> <a href="#">Signup</a> <a href="#">Help</a></p>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>