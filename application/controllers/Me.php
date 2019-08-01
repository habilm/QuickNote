<?php 
defined("BASEPATH") or exit("you Go Hell");

class Me extends Ci_Controller{
    function __construct(){
        parent::__construct();
        $this->load->database("qn_db");
        $this->load->helper(["url","form","html"]);
        $this->load->library(["form_validation","encryption","session"]);
    }

    public function index(){
        redirect("../me/login");
        $this->load->view("templates/site_head");
        $this->load->view("login");
        $this->load->view("templates/site_footer");
    }
    public function login(){
        $data=[];
        $field_rules=array(['field'=>'email','label'=>'Email Address','rules'=>"required|valid_email"],['field'=>'password','label'=>"Password",'rules'=>'required']);
        $this->form_validation->set_message("valid_email","Please enter a valid email address");
        $this->form_validation->set_rules($field_rules);
        if($this->form_validation->run()==true){
            $remember = isset($_POST["remember"])?"remember":"";
            $input = $this->input->post(["email","password",$remember]);
            $login = $this->quickNote->login($input);
            
            if($login == 0){
                $data["error"]='<div class="alert alert-warning alert-dismissible" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning!</strong> Email address or Password is worng
                </div> ';
            }
            elseif($login == 2){
                    $data["error"]='<div class="alert alert-warning alert-dismissible" >
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Warning!</strong> Email address not Varified.<br/><a href="#">Click here to Verify your account.</a>
                    </div> ';
            }
            else{
                redirect("../");
            }
        }
        else{
            
        }
        $this->load->view("templates/site_head");
        $this->load->view("login",$data);
        $this->load->view("templates/site_footer");
    }
    public function logout(){
        $this->session->unset_userdata("user");
        redirect("../");
    }

}