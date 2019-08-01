<?php
defined("BASEPATH") or exit("GO Hell");
 ?>

<div class='container-fluid main-container' >
<div class='row ' >
     <div class='qn_box box_1' style='height:100%;'  >
        <div class='qn_shadow' >
            <div class="qn_list_controls">
                <p id='qn_title' class='f_c_blue'>Welcome to QuickNote</p>
                <hr/>
                <div class="row text-center qn-options" style="margin-bottom: 10px">
                    <div class="col-3 btn-search" data-toggle="tooltip" data-placement="top" title="Search">
                        <i class="fa fa-search"></i>
                    </div>
                    <div class="col-3 btn-stared" data-toggle='tooltip' data-placement='top' title="Stared">  
                        <i class="fa fa-star" ></i>
                    </div>
                    <div class="col-3 btn-listTag" data-toggle='tooltip' data-placement='top' title="Tags">
                        <i class="fa fa-tag"></i>
                    </div>
                    <div class="col-3 btn-trash" data-toggle='tooltip' data-placement='top' title="Trash">
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
                <div class='qn-tagList border_2 mrg-btm-10'>
                    <span class="tags">website</span><span class="tags">wordpress</span><span class="tags">javaScript</span>
                    <span class="tags">css</span><span class="tags">html</span><span class="tags">jQuery</span>
                    <span class="tags">WooCommerce</span><span class="tags">windows 10</span><span class="tags">Google</span>
                    <span class="tags">PHP</span><span class="tags">photoshop</span><span class="tags">illustater</span>
                    <span class="tags">design</span><span class="tags">SQL</span><span class="tags">APP</span>
                    <span class="tags">JAVA</span><span class="tags">Software</span><span class="tags">tips</span>
                    
                </div>
                <input type='text' class='qn-search mrg-btm-10' placeholder="Search Your QuickNote's">
                <button class="btn btn-primary btn-block btn-newNote mrg-btm-10  show_only_largeEE" title='Create New QuickNote'><i class="fa fa-plus" style='font-size:20px;'></i></b></button>
                <!--<button class="btn btn-primary btn-block btn-newNote_mob mrg-btm-10 show_only_smoll" title='Create New QuickNote'><i class="fa fa-plus" style='font-size:20px;'></i></b></button>-->
            </div>
            <div class="row qn_note_list" >
               
            </div>
            <div class="scroll_bar" ><div class="scroll_bar_handel"></div></div>
        </div>
     </div>
     <div class='qn_box box_2 show_only_large ' style='height:100%;'>
        <div class='qn_shadow  '  >
            <div class='qn_new_note'>
                <form id="saveNote">
                    <div class='col-sm-12' >
                        <input type="text" id="qn_new_note_title" name="head" class="f_c_blue col-10" style="border:none;font-size:25px;display:inline" placeholder='QuickNote Title'><i class="fa fa-ellipsis-v col-2 show_only_smoll_inine f_c_blue text-right" style="cursor:pointer"  id="qn_note_details_btn"></i>
                        <input type="hidden" id="qn_new_note_id" name="id" value="">
                        <hr/>   
                    </div>
                    
                    <div class="col-sm-12" >
                        <textarea id='qn_new_note_body' name="body"  style="border:none;width:100%;height: calc(100% - 150px);"  placeholder='Type Your QuickNote'></textarea>
                    </div>
                    <div class="col-sm-12" >
                            <hr>
                        <div class='row'>
                            <div class="col-sm-12">
                                    <input type="submit" class="btn btn-primary" value="Save QuickNote">
                                    <button type="button" class="btn btn-outline-primary note_canel">Cancel</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
     </div>
     <div class='qn_box box_3 show_only_large' style="height:100%;" Id="box_3" data-id="" >
        <div class='qn_shadow' >
               <div class='qn_note_details'>
                   <div class='col-sm-12' >
                        <div class="row text-center qn-options" style="margin-bottom: 10px" >
                            <div class="col-3 qn_star" data-toggle='tooltip' data-placement='top' title="Give a Star">  
                                <i class="fa fa-star" ></i>
                            </div>
                            <div class="col-3" data-toggle="tooltip" data-placement="top" title="Share">
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <div class="col-3" data-toggle='tooltip' data-placement='top' title="Print">
                                    <i class="fa fa-print"></i>
                            </div>
                            <div class="col-3 qn-delete" data-toggle='tooltip' data-placement='top' title="Delete">
                                    <i class="fa fa-trash"></i>
                            </div>
                        </div>
                        <hr/>
                        <p class="c-date">Create: 09/24/1995</p>
                        <p class="u-date">Last Update:3/06/2018</p>
                        <hr/>
                        <div class="row">
                            <div class="form-group add-tag" style="width:100%;">
                                <form >
                                    <input type="text" style='border:none;height:20px;' class="col-8" placeholder="Add New Tags"><input type="submit" value=" + " class="btn btn-sm col-4">
                                </form>
                            </div>
                                    <span class="tags">website <span class='tags-delete'>×</span></span><span class="tags">wordpress <span class='tags-delete'>×</span></span><span class="tags">javaScript <span class='tags-delete'>×</span></span>  
                            <hr/>
                       </div>
                       <br/>
                       <button type="button" class="btn btn-sm col-12 btn-danger show_only_smoll" onclick="$('.qn_box.box_3').css('right','100%')" style="margin: 0;padding:0">Close</button>
                    </div>
               </div>
               </div>
        </div>
     </div>
</div> 
<!-- QN Alert -->
<div class="qn-alert qn-alert-background">
    <div class="qn-alert-box border_2 pad">
        <h3 class='qn-alert-heading'>fsd</h3>
        <p class='qn-alert-text'>sdf</p>
        <div class='row'>
        <div class='col-12' id="qn-alert-btns"></div>
        <div class='co'></div>
        </div>
    </div>
</div>