<?php
defined("BASEPATH") or exit("Go To Hell");

class Go extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper(["url","html"]);
        $this->load->library(["session","encryption","form_validation"]);
        $this->load->database("qn_db");
    }
    function index($user="default"){
        
        if($this->input->method()=="post"){
            if($this->session->has_userdata("temp_user")){
                $this->form_validation->set_rules("text_head","Note Heading","required|trim");
                $this->form_validation->set_rules("text_body","Note Body","required|trim");
                $this->form_validation->set_rules("text_submit"," ","required|trim");

                if($this->form_validation->run()){
                    $data["note_head"]=$this->input->post("text_head");
                    $data["note_body"]=$this->input->post("text_body");
                    $data["owner"] = $this->session->userdata("temp_user")[0]->user_id;
                    $data["ip"]= $_SERVER["REMOTE_ADDR"];
                    $data["note_temp"]="1";
                    if($this->quickNote->save($data)!=false){
                        $this->load->view("tempNote/submitted");
                    }
                }
            }
        }
        else{ 
            if($user!="default"){
                $temp_user = $this->quickNote->get_user($user,"user_username");
                if($temp_user)
                {
                    $this->session->set_userdata("temp_user",$temp_user)  ;
                    $this->load->view("tempNote/mynote.php");
                }
                else{
                    $this->output->set_status_header('404'); 
                }   
            } 
        }
         
    }
}
 ?>
