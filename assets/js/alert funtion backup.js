function qn_alert(heading,text,btn_txt1="",btn_txt2="",yes=function(){}){
        $(".qn-alert-background").fadeIn("fast",function(){
            $(".qn-alert-heading").html(heading);
            $(".qn-alert-text").html(text);
            $btns="";
            if(btn_txt1!=""){
                $btns+="<button type='button' class='btn btn-danger qn-alert-delete'>"+btn_txt1+"</button>&nbsp;&nbsp;&nbsp;";
            }
            else{
                $btns="";
            }
            if(btn_txt2!=""){
                $btns+="<button type='button' class='btn btn-primary qn-alert-cancel'>"+btn_txt2+"</button>";
            }
            else{
                $btns+="<button type='button' class='btn btn-primary qn-alert-cancel'>&nbsp;&nbsp;&nbsp;&nbsp; Ok &nbsp;&nbsp;&nbsp;&nbsp;</button>";
            }
            $("#qn-alert-btns").html($btns);
            $(".qn-alert-box").fadeIn();
        });
        $(document).on("click",".qn-alert-delete",function(){
            $(".qn-alert-background").fadeOut();
            alert(yes());
            
        });
        $(".qn-alert-background").click(function(){
            $(".qn-alert-background").fadeOut;
        });
    }
    $(document).on("click",".qn-alert-cancel",function(){
        $(".qn-alert-background").fadeOut();
        alert("canceld");
        
    });