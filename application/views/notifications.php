<div class="container-fluid main-container" style="padding-top:10px;padding-bottom:10px">
    <div class="row">
        <div class="col-sm-4">
            <div class="qn_shadow h-100" >
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <div class="noti_list" >
                            <div class="temp-note-box" style="max-height:none;height: 100%;">
                                <?php foreach($notifications as $notification)
                                {  ?>
                                    <a href="<?php echo '#goto_'.$notification->note_id ?>" class="dropdown-temp-notes-list">
                                        <span class="f_c_blue" style="font-size:12px">Your New QuickNote</span><br>
                                        <b><?php echo (strlen($notification->note_head)>=30)?substr($notification->note_head,0,30)."...":$notification->note_head; ?></b><br>
                                        <p style="word-break: break-all;"><?php echo (strlen($notification->note_body)>=70)?substr($notification->note_body,0,70)."...":$notification->note_body; ?></p>
                                    </a>
                                <?php } ?>  
                            </div>
                        
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="qn_shadow h-100 temp-note-frame" style="overflow: hidden scroll;">
                <div class="temp_note_info">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="#" class="btn btn-primary temp_note_save" >Save</a>&nbsp;&nbsp;
                            <a href="#" class="btn btn-warning">Its not me</a>&nbsp;&nbsp;</a>
                            <a href="#" class="btn btn-danger temp_note_delete">Delete</a>
                        </div>
                        <div class="col-sm-6 text-right ">
                            <span class="temp_note_created">Created: </span>
                            <span class="temp_note_ip">IP:</span>
                        </div>
                    </div>
            </div>
                
                <hr style="margin:10px 0">
                <h2 class="temp_note_head f_c_blue"></h2>
                <p class="temp_note_body" style="word-break: break-all;"></p> 
                
            </div>
        </div>
    </div>
</div>