<?php
defined("BASEPATH") OR exit("Go Hell");

class Ajax extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->library(["session","encryption","form_validation"]);
        $this->load->database("qn_db");
        if(!$this->session->has_userdata("user")):
            die("0");
        endif;
    }
    public function index(){
        redirect("../");
    }
    public function getNoteList(){
        $starClass=$star="";
        $qn_notes = $this->quickNote->getNotes("qn_notes");
       foreach($qn_notes as $note):
            $id = $note->note_id;
            $id = $this->idenc($note->note_id);
            $head = (strlen($note->note_head)>=35)?substr($note->note_head,0,35)."...":$note->note_head;
            $body = (strlen($note->note_body)>=155)?substr($note->note_body,0,155)."...":$note->note_body;
            if($note->note_star == 1){
                $star = '<i class="fa fa-star"></i>';
                $starClass="f_c_blue";

            }
            echo '<div class="col-sm-12 qn_notes "  data-qnid="'.$id.'">
                     <div class="qn-panel" >
                         <h5 >'.htmlspecialchars($head).'</h5>
                         <hr/>
                        <p >'.htmlspecialchars($body).'</p>
                        <p class="bottom-star">'.$star.'</p>
                        <div class="qn-panel-action">

                             <div class="row " style="margin-bottom: 10px">
                                 <div class="col-4">
                                            
                                 </div>
                                 <div class="col-3 qn_star '.$starClass.'" style="padding-bottom:3px" data-id="'.$id.'" data-toggle="tooltip" data-placement="top" title="Stred">
                                     <i class="fa fa-star" ></i>
                                 </div>
                                 <div class="col-3 qn-delete" data-id="'.$id.'" data-toggle="tooltip" data-placement="top" title="Trash">
                                     <i class="fa fa-trash"></i>
                                 </div>
                                
                                 <div class="col-2">
                                            
                                 </div>
                             </div>
                        </div>
                 </div>
             </div>';
             $star=$starClass="";
             endforeach;
    }
     private function idenc($data){
      return $data * 23 + 44;
    }
    public function getNoteContents(){
        $id = $this->iddec($this->input->post("id"));
        $this->db->where("note_id",$id);
        $this->db->where(["owner"=>$this->session->userdata("user")["id"]]);
        $notes = $this->db->get("qn_notes")->result();

        foreach($notes as $note)
        {
            $note->note_id=$this->idenc($note->note_id);
        }
        echo  json_encode($notes);
    }
    
    private function iddec($data){
        $data = intval($data) - 44;
        $data = $data / 23;
        return $data; 
    }
    function saveNote(){
        $this->form_validation->set_rules("head","Heading","required|max_length[250]");
        if($this->form_validation->run()==false){
            echo validation_errors(); 
            die();
        }
        $a=$this->input->post("id",true);
        if(empty($a)){
            $data=["note_head"=>$this->input->post("head",true), "note_body"=>$this->input->post("body"), "owner"=>$this->session->userdata("user")["id"]];
            echo $this->idenc($this->quickNote->save($data)); 
        }
        else{
            $data=["note_head"=>$this->input->post("head",true), "note_body"=>$this->input->post("body")];
            if($this->quickNote->update($data,["note_id"=>$this->iddec($this->input->post("id",true))])){
                echo $this->input->post("id",true);
            }
            else{
                echo "update Error!";
            }
        }
    }
    function delete(){
        $this->form_validation->set_rules("id","note Id","required|regex_match[/^[0-9]+/]");
        if($this->form_validation->run()){
           echo $this->quickNote->update(["note_trash"=>1],["note_id"=>$this->iddec($this->input->post("id",true))]);
        }
    }
    function setStar(){
        $this->form_validation->set_rules("id","note Id","required|regex_match[/^[0-9]+/]");
        if($this->form_validation->run()){
           echo $this->db->query("update `qn_notes` set note_star = IF(note_star=1,0,1) where `note_id`=".$this->iddec($this->input->post("id",true))." ");
          // echo $this->--->update(["note_star"=>1],["note_id"=>$this->iddec($this->input->post("id",true))]);
        }
    }
    function saveMyNote(){
        $this->form_validation->set_rules("head","QuickNote Heading","required");
        if($this->form_validation->run()==false){
            echo "0";
            die();
        }
        $data=["note_head"=>$this->input->post("head",true), "note_body"=>$this->input->post("body")];
        if($this->quickNote->update($data,["note_id"=>$this->iddec($this->input->post("id",true))])){
            echo $this->input->post("id",true);
        }
        else{
            echo "update Error!";
        }
    }
    function getTempNote(){
        $this->form_validation->set_rules("id","ID","required|numeric");
        if($this->form_validation->run()){
            $id = $this->input->post("id",true);
            $this->db->where("note_id",$id);
            $this->db->where(["owner"=>$this->session->userdata("user")["id"],"note_delete"=>"0","note_trash"=>"0"]);
            $note = $this->db->get("qn_notes")->result();
            echo  json_encode($note);
        }
    }
    function saveTempNote(){
        $this->form_validation->set_rules("id","ID","required|numeric");
        if($this->form_validation->run()){
            $id = $this->input->post("id",true);
            $this->db->where("note_id",$id);
            $this->db->where(["owner"=>$this->session->userdata("user")["id"]]);
            if($this->db->update("qn_notes",["note_temp"=>"0"])){
                echo 1;
            }
            else{
                echo 0;
            }
        }
    }
}
?>