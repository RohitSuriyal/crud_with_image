<?php

class Crud_model extends CI_Model
{
    public function send_add_data($data)
    {

        $output = $this->db->insert("du_category", $data);
        if ($output) {
            return "data added successfully";
        } else {
            return "data not added succesfully";
        }
    }
    public function fetch_update_model($id)
    {
       $this->db->where("id",$id);
       $output=$this->db->get("du_category");
     if($output){
        return $output->result();
     }
     else{
        return false;
     }

    }
}
