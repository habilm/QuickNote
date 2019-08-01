$(document).ready(function(){
    var nowEditingId=0;
    var idForDelete,idForStar;
    var id;
    setTimeout(function(){
        var title_text=$("#qn_title");
        title_text.fadeOut("slow",function(){
        title_text.html("Your QuickNote's");
        title_text.fadeIn("slow");

        });
    },5000);
    $(".btn-search").click(function(){
        $(".qn-taglist").fadeOut();
        $(".btn-listTag,.btn-stared,.btn-trash,#qn_title").removeClass("f_c_blue");
        $(".qn-search").toggle(500);
        $(".qn-search").focus();
        $(this).toggleClass("f_c_blue");
    });
    $(".btn-listTag").click(function(){
        $(".qn-search").hide();
        $(".btn-search,.btn-stared,.btn-trash,#qn_title").removeClass("f_c_blue");
        $(".qn-tagList").animate({height:'toggle'});
        $(this).toggleClass("f_c_blue");    
    });
    $(".btn-stared").click(function(){
        $(".btn-listTag,.btn-search,.btn-trash,#qn_title").removeClass("f_c_blue");
        $(".qn-search,.qn-tagList").hide();
        $(this).toggleClass("f_c_blue");    
        
    });
    $(".btn-trash").click(function(){
        $(".btn-listTag,.btn-search,.btn-stared,#qn_title").removeClass("f_c_blue");
        $(".qn-search,.qn-tagList").hide();
        $(this).toggleClass("f_c_blue"); 
    });
    $("#qn_title").click(function(){
        $(".btn-listTag,.btn-search,.btn-stared,.btn-trash").removeClass("f_c_blue");
        $(".qn-search,.qn-tagList").hide();
        $(this).addClass("f_c_blue");
    });
    //delete Note --------
    $(document).on("click",".qn-delete",function(){
        if($(this).data("id")){
           idForDelete = $(this).data("id");
           qn_alert("","Are you sure?","Delete The quickNote","Delete","Cancel","delete_note");
       }
       else{
        if(nowEditingId){
            qn_alert("","Are you sure?","Delete The quickNote","Delete","Cancel","delete_note");
            idForDelete=nowEditingId;
        }
       }
        
    });
    $(document).on("click",".qn_star",function(){
        if($(this).data("id")){
            idForStar = $(this).data("id");
        }
        else{
            if(nowEditingId){
                idForStar=nowEditingId;
            }
            else{}
        }
        var success=0;
        runAjax("ajax/setStar",{"id":idForStar},function(data){
            if(data==1){
                $(".qn_star[data-id="+idForStar+"]").toggleClass("f_c_blue");
                $(".qn_note_details[data-id="+idForStar+"] .qn_star").toggleClass("f_c_blue");
                var optionsStar = $(".qn_note_details[data-id="+idForStar+"] .qn-options .qn_star");
                var bottomStar = $(".qn_notes[data-qnid="+idForStar+"] .bottom-star");
                if(bottomStar.html()=='<i class="fa fa-star"></i>'){
                    bottomStar.html("");
                }
                else{
                    bottomStar.html('<i class="fa fa-star"></i>');
                }
            }
            idForStar=0;
        }); 
    });
    $(document).on("click",".qn-alert-delete.delete_note",function(){
        deleteAll()
    });
    function deleteAll(){
        var deletingNote= $(".qn_notes[data-qnid="+idForDelete+"]");
        deletingNote.find(".qn-panel").css("background-color","rgba(225,0,0,0.1)");
        $(".qn-alert-background").fadeOut();
        runAjax("ajax/delete",{"id":idForDelete},function(data){
            if(data==1){
                deletingNote.animate({height:0},400,function(){$(this).hide()});
                if(nowEditingId==idForDelete){
                    submit = true;
                    newNote();
                }
            }
            else{
                alert("unable to delete :\n" + data);
            }
        });
    }

    //-------- end delete note
    //delete tag
    $(".qn_note_details .tags .tags-delete").click(function(){
        qn_alert("","Delete This Tag?","Are you sure to remove this tag!","Delete","Cancel","delete_tag");
    });
    $(document).on("click",".qn-alert-delete.delete_tag",function(){
        $(".qn-alert-background").fadeOut();
        
    });
    //------------end delete tag
    //alert function start -----
    function qn_alert(border,heading,text,btn_txt1="",btn_txt2="",which){
        $(".qn-alert-background").fadeIn("fast",function(){
            $(".qn-alert-heading").html(heading);
            $(".qn-alert-text").html(text);
            $btns="";
            if(btn_txt1!=""){
                $btns+="<button type='button' class='btn btn-danger qn-alert-delete "+which+"'>"+btn_txt1+"</button>&nbsp;&nbsp;&nbsp;";
            }
            else{
                $btns="";
            }
            if(btn_txt2!=""){
                $btns+="<button type='button' class='btn btn-primary qn-alert-cancel w-25'>"+btn_txt2+"</button>";
            }
            else{
                $btns+="<button type='button' class='btn btn-primary qn-alert-cancel'>&nbsp;&nbsp;&nbsp;&nbsp; Ok &nbsp;&nbsp;&nbsp;&nbsp;</button>";
            }
            $(document).keydown(function(event){ 
                if(event.which == 13){
                    $(".qn-alert-background,.qn-alert-box").fadeOut();
                    deleteAll();
                    $(this).off(event);
                }
            });
            $(document).keydown(function(event){ 
                if(event.which == 27){
                    $(".qn-alert-background,.qn-alert-box").fadeOut();
                    $(this).off(event);
                }
            });
            $("#qn-alert-btns").html($btns);
            $(".qn-alert-box").addClass(border);
            $(".qn-alert-box").fadeIn();
        });
    }
    $(document).on("click",".qn-alert-cancel",function(){
        $(".qn-alert-background,.qn-alert-box").fadeOut();
       
    });
    $(".qn-alert-background").click(function(){
        $(".qn-alert-background,.qn-alert-box").fadeOut();
    });
    //------------- alert function end
    //note options
    $("#qn_note_details_btn").click(function(){
        $('.qn_box.box_3').css("right","0px"); 
        $(document).click(function(e){    
            if($("body").find(".qn_box.box_3").css("right")=="0px"){
                if (!$(e.target).is('.qn_box.box_3 *')) {
                $(".qn_box.box_3").css("right","100%");	
            } 
        }
           }); 
    });
    var submit=true;
    $(".box_1 *").click(function(){
        if(!submit){
             newNote();
             return false;
        }
    });
    //Click for New note
    $(".btn-newNote").click(function(){newNote();});
    $(".note_canel").click(function(){newNote();});
    function newNote(){
        if($(".qn_box.box_2").css("display")=="none"){
            $(".qn_box.box_1").fadeOut("fast",function(){$(".qn_box.box_2").fadeIn();});
        }
        if(submit){
            $("#saveNote")[0].reset();
            $("#qn_new_note_id").val("");
        }
        else{
            $(".qn-alert-background").fadeIn("fast",function(){
                $(".qn-alert-heading").html("Save?");
                $(".qn-alert-text").html("Do you want to save QuickNote?");
                $btns="";
                $btns+="<button type='button' class='btn btn-primary alert_save_btn'>Save</button>&nbsp;&nbsp;&nbsp;";
                $btns+="<button type='button' class='btn btn-danger edit_cancel'>Don't Save</button>&nbsp;&nbsp;&nbsp;";
                $btns+="<button type='button' class='btn qn-alert-cancel'>Cancel</button>";
                
                $("#qn-alert-btns").html($btns);
                $(".qn-alert-box").fadeIn();

            });
        }
        nowEditingId=0;
    }
    $(document).on("click",".edit_cancel",function(){
        submit = true;
        newNote();
    });
    $(document).on("click",".alert_save_btn",function(){
        $("#saveNote").submit();
    });

    //note hide view when click any notes and work ajax
    $(document).on("click",".qn_notes",function(e){
       if(!$(e.target).is(".qn-panel-action *")){
            if($(".qn_box.box_2").css("display")=="none"){
                $(".qn_box.box_1").fadeOut("fast",function(){$(".qn_box.box_2").fadeIn();});
            }
            $(".qn_notes .qn-panel").css({"border-width" : "1px","border-color" : "rgba(0, 0, 0, 0.282)"});
            $(this).children(".qn-panel").css({"border-width" : "2px" , "border-color" : "#007bff"});
            var id=$(this).data("qnid");
            $(".qn-alert-background").show();
            runAjax("ajax/getNoteContents",{"id" : id},function(data){ 
                if(data=="0" || data=="[]"){
                    qn_alert("border_red","Oh Crap!","Somting Error");
                }
               
                var note = JSON.parse(data);
                
                $("#qn_new_note_body").val(note[0].note_body);
                $("#qn_new_note_title").val(note[0].note_head);
                $("#qn_new_note_id").val(id);
                $(".qn_note_details").attr("data-id",id);
                $(".qn_note_details .c-date").html("Create: "+note[0].note_created);
                $(".qn_note_details .u-date").html("Last Update: "+note[0].note_update);
                if(note[0].note_star == 1){
                    $(".qn_note_details .qn-options .qn_star").addClass("f_c_blue");
                }
                else{
                    $(".qn_note_details .qn-options .qn_star").removeClass("f_c_blue")
                }
                nowEditingId=id;
                $(".qn-alert-background").hide(); 
             });
        }
    });
    $("#saveNote").submit(function(){
        var isNew=false;
        var newEditinghead=$(this).find("input[name=head]").val();
        var newEidtingbody=$(this).find("textarea[name=body]").val();
        if(!$("#qn_new_note_id").val()){
            isNew = true;
        }
        if(!newEidtingbody<=0 || !newEditinghead<=0){
            runAjax("ajax/saveNote",$(this).serialize(),function(data){
                if(Number(data)){
                    nowEditingId = data;
                    $("#qn_new_note_id").val(data);
                    if(isNew)
                    {
                        $(".qn_note_list").prepend('<div class="col-sm-12 qn_notes " data-qnid="'+data+'" > <div class="qn-panel" > <h5 >'+htmlToText(newEditinghead)+'</h5> <hr/> <p >'+htmlToText(newEidtingbody)+'</p> <p class="bottom-star"></p> <div class="qn-panel-action"> <div class="row " style="margin-bottom: 10px"> <div class="col-4"> </div> <div class="col-3 qn_star" style="padding-bottom:3px" data-id="'+data+'" data-toggle="tooltip" data-placement="top" title="Stred"> <i class="fa fa-star" ></i> </div> <div class="col-3 qn-delete" data-id="'+data+'" data-toggle="tooltip" data-placement="top" title="Trash"> <i class="fa fa-trash"></i> </div> <div class="col-2"> </div> </div> </div> </div> </div>');
                        var prepend= $(".qn_notes[data-qnid="+data+"]");
                        prepend.hide();
                        prepend.show(1000);
                    }
                }
                else{
                    qn_alert("","Oh Crapp!",data,"","ok");
                }
            });
        }
        submit=true;//for block window closing without save
        return false;
    });
    //--- Note Body(textarea) block window closing on textarea changed
    function htmlToText(data)
    {
        data = data.replace(/[\<]/gi,"&lt;");
        return data = data.replace(/[\>]/gi,"&gt;");
    }
    $("#qn_new_note_body").keyup(function(){
        var qnBody = $(".qn_notes[data-qnid="+nowEditingId+"] p:first");
        var len=$(this).val().length;
        if(len<155){
            qnBody.text($(this).val());
        }
        submit=false;
    });
    $("#qn_new_note_title").keyup(function(){
        var qnNote = $(".qn_notes[data-qnid="+nowEditingId+"] h5");
        var len=$(this).val().length;
        if(len<35){
            qnNote.text($(this).val());
        }
        submit=false;
    });
    window.addEventListener("beforeunload", function (e) {
        if(!submit && $("#qn_new_note_body").val().trim()!="")
        {
            var confirmationMessage = "\o/";
            (e || window.event).returnValue = confirmationMessage;     
            return confirmationMessage;  
        }                   
      });
    //--------------- Login -----------------------
 
   
    //------------------- end Login ----------------

    $(".qn_note_list").scroll(function(a){
        var percentage_of_scroll=0;
        percentage_of_scroll=($(this).scrollTop() / ($(this)[0].scrollHeight - $(this)[0].clientHeight) ) * 100 ;
        var bar_btn_height=(percentage_of_scroll/100)*$(".scroll_bar").width();
     $(".scroll_bar .scroll_bar_handel").width(bar_btn_height);
    });

    //the temp-note


   $(".qn_note_list").css("height","calc(100% - "+($(".qn_list_controls").height()+10)+"px ) ");
   $(".main-container").css("height","calc(100% - "+($("header").height())+"px ) ");

   
   /******************Notification page *******************/
   var id = window.location.hash;
   if( id !=""){
    getTempNote(id.match(/\d+$/)[0]);
   }
   else{
       if($(".noti_list a.dropdown-temp-notes-list:eq(0)").length>0){
           getTempNote($(".noti_list a.dropdown-temp-notes-list:eq(0)").attr("href").match(/\d+$/)[0]);
       }

   }
   $(".noti_list a.dropdown-temp-notes-list").click(function(){
       getTempNote($(this).attr("href").match(/\d+$/)[0]);
   });
   function getTempNote(id=0){
       if(id){
           $(".temp-note-frame").addClass("processing");
            $(".noti_list a.dropdown-temp-notes-list").removeClass("active");
            $(".noti_list ").find("a.dropdown-temp-notes-list[href='#goto_"+id+"']").addClass("active");
           data={"id":id};
           runAjax("ajax/getTempNote",data,function(data){
               var out = JSON.parse(data)[0];
               var temp_note_head = $(".temp-note-frame .temp_note_head");
               if(out != undefined)
               {
                    idForDelete = out.note_id;
                    $(".temp-note-frame").removeClass("processing");
                    $(".temp-note-frame .temp_note_info .temp_Note_created").html("<b>Created On: </b>"+out.note_created);
                    $(".temp-note-frame .temp_note_info .temp_Note_ip").html("<b>IP: </b>"+out.ip);
                    temp_note_head.text(out.note_head);
                    if(out.note_head.length > 150){
                        temp_note_head.css("font-size","18px");
                    }
                    else{
                        temp_note_head.css("font-size","2rem");
                    }
                    $(".temp-note-frame .temp_note_body").text(out.note_body);
                }else{
                    getTempNote($(".noti_list").find("a.dropdown-temp-notes-list:eq(0)").attr("href").match(/\d+$/)[0]);                    
                }

           });
       }
   }
   $(".temp-note-frame .temp_note_delete").click(function(){
        $(".noti_list a.dropdown-temp-notes-list[href='#goto_"+idForDelete+"']").fadeOut("",function(){
            $(this).remove();
            idForDelete = idForDelete * 23 + 44;
            runAjax("ajax/delete",{"id":idForDelete},function(data){
                idForDelete = 0;
                getTempNote($(".noti_list").find("a.dropdown-temp-notes-list:eq(0)").attr("href").match(/\d+$/)[0]);
            });
        });
 
   });
   $(".temp-note-frame .temp_note_save").click(function(){
    $(".noti_list a.dropdown-temp-notes-list[href='#goto_"+idForDelete+"']").fadeOut("",function(){
        $(this).remove();
        runAjax("ajax/saveTempNote",{"id":idForDelete},function(data){
            if(data){
                idForDelete = 0;
                getTempNote($(".noti_list").find("a.dropdown-temp-notes-list:eq(0)").attr("href").match(/\d+$/)[0]);
            }
        });
        return false;
    });

});
}); //end the document.ready


//------ AJAX ---
// $.ajax({
//     url : "ajax/getNoteList",
//     method : "get",
//     error : function($e,$e2){
//         console.log($e);
//         $(".qn_note_list").html('<div class="col-sm-12 qn_notes " ><span style="color:red">Error Feching Data. Please Contact Site Admin</span></div>');
//     },
//     success : function(data){
//         $(".qn_note_list").html(data);
//     }
// });
runAjax("ajax/getNoteList","",function(data){
    $(".qn_note_list").html(data);
});

function runAjax(url,data,out){
    $.ajax({
        url : baseUrl+url,
        method: "post",
        data : data,
        error : function(a,b,c){
            console.log(a);
            console.log(b);
            console.log(c);
        },
        success : out
    });
}


function loader_on(){
    
}
function loader_off(){
    
}

