<?php

class Records_model extends CI_Model {

  public function __construct(){
    parent::__construct();
  }

  public function get_all(){
    $query = $this->db->get('record');
    return $query->result();
  }

  public function get_record($id){
    $this->db->where('id', $id);
    $query = $this->db->get('record');
    return $query->result();
  }

  public function delete_record($id){
    $this->db->where('id', $id);
    $this->db->delete('record');
  }

  public function update_record($id, $data){
    $this->db->where('id',$id);
    $this->db->update('record', $data);
  }


}