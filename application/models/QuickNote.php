<?php
defined("BASEPATH") or exit("Go Hell");
Class QuickNote extends CI_Model{

    public function login($data){
        
        $this->db->select("*");
        $this->db->where(array("user_email" => $data["email"],"user_psd" => md5($data["password"]),"user_trash" => "0"));
        $this->db->limit("1");
        $sql = $this->db->get( "qn_users" );
        $user=$sql->result();
        $user_data=[];
        if( $sql->num_rows() == 1){
            if(!$user[0]->user_verified){
                return 2;
            }
            $user_data = [
                        "id"=>$user[0]->user_id,
                        "Name"=>$user[0]->user_name,
                        "Email"=>$user[0]->user_email,
                        "Phone"=>$user[0]->user_phone,
                        "Photo"=>$user[0]->user_photo
                        ];
            
            if(isset($data["remember"]) && $data["remember"]=="remember"){
                set_cookie("data1",$this->encryption->encrypt($user_data["Email"]),2592000);
                set_cookie("data2",$this->encryption->encrypt($user_data["password"]),2592000);
            }
            $this->session->set_userdata( "user", $user_data );
            return 1;
        }
        return 0;  
    }
    function getNotes($tableName){
        $this->db->where(["owner"=>$this->session->userdata("user")["id"],"note_trash"=>"0","note_delete"=>"0","note_temp"=>"0"]);
        $this->db->order_by("note_id","desc");
        return $this->db->get($tableName)->result();
    }
    function getTempNotes(){
        $this->db->where(["owner"=>$this->session->userdata("user")["id"],"note_trash"=>"0","note_delete"=>"0","note_temp"=>"1"]);
        $this->db->order_by("note_id","desc");
        return $this->db->get("qn_notes")->result();
    }
    function save($data){
        if($this->db->insert("qn_notes",$data)){
            return $this->db->insert_id();
        }
        else{
            return false;
        }
    }
    function update($data,$where){
        $this->db->set($data);
        $this->db->where("owner",$this->session->userdata("user")["id"]);
        $this->db->where($where);
        return $this->db->update("qn_notes",$data);
    }
    function get_user($select="1",$which="1"){
        if(!is_numeric($select) && $which=="1")
        {
            $which="user_email";
        }
        $this->db->where($which,$select);
        $this->db->order_by("user_id");
        return $this->db->get("qn_users")->result();
    }
}

?>