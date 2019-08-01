<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper(["url","html"]);
        $this->load->database("qn_db");
        $this->load->library(["session","encryption"]);
        if(!$this->session->has_userdata("user")):
            redirect("../me/index");
        endif;
    }
    public function index(){
        $this->encryption->initialize(array('driver' => 'openssl'));
        $tempNotes=$this->quickNote->getTempNotes();
        $data["notifications"]=$tempNotes;
        $data["user"] = $this->session->user;
        $this->load->view("templates/site_header",$data);
        $this->load->view("home",$data);
        $this->load->view("templates/site_footer");
    }
    public function notifications(){
        $tempNotes=$this->quickNote->getTempNotes();
        $data["notifications"]=$tempNotes;
        $data["user"] = $this->session->user;

        $this->load->view("templates/site_header",$data);
        $this->load->view("notifications");
        $this->load->view("templates/site_footer");
    }
    
}
?>