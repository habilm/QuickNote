<?php $this->load->view("templates/site_head"); ?>
<header class='container-fluid' style="padding-left: 5px; padding-right: 5px;">
<nav class="navbar navbar-expand-lg navbar-light" style="border-radius:10px;-moz-box-shadow: 0px 10px 0px rgba(0, 0, 0, 0.137); -webkit-box-shadow: 0px 10px 0px rgba(0, 0, 0, 0.137); box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.137); border-radius: 10px;">
  <a class="navbar-brand" href="">QuickNote</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user"> </i>  <?php echo ucwords($user["Name"]); ?>   
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#"><i class="fa fa-cog"> </i> Settings</a>
          <a class="dropdown-item" href="#"><i class="fa fa-id-card"> </i> Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="me/logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>
      
    </ul>
    
    <ul class="navbar-nav ">
        <li class="nav-item dropdown  ">
            <a class="nav-link dropdown-toggle dropdown-toggle-temp-note text-white" href="#" id="temp_note_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>&nbsp;<span><?php echo count($notifications) ?></span>
            </a>
            <div class="dropdown-menu dropdown-temp-notes" >
                <div class="temp-note-box">
                    <h5 class="text-right">Notifications</h5>
                    <?php foreach($notifications as $notification)
                    { 
                        ?>
                        <a href="<?php echo base_url().'home/notifications#goto_'.$notification->note_id ?>" class="dropdown-temp-notes-list">
                            <span class="f_c_blue" style="font-size:12px">Your New QuickNote</span><br>
                            <b><?php echo (strlen($notification->note_head)>=30)?substr($notification->note_head,0,30)."...":$notification->note_head; ?></b><br>
                            <?php echo (strlen($notification->note_body)>=70)?substr($notification->note_body,0,70)."...":$notification->note_body; ?>
                        </a>
                    <?php } ?>
                        
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="home/notifications"><i class="fa fa-sign-out-alt"></i> View All</a>
            </div>
        </li>
    </ul>
    
  </div>
</nav>
</header>
