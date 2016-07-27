<?php

class Realtime_model extends CI_Model {

  public function __construct(){
    parent::__construct();
  }

  public function get_all(){
    $query = $this->db->get('realtime');
    return $query->result();
  }

  public function get_record($id){
    $this->db->where('id', $id);
    $query = $this->db->get('realtime');
    return $query->result();
  }

  public function delete_record($id){
    $this->db->where('id', $id);
    $this->db->delete('realtime');
  }

  public function update_record($id, $data){
    $this->db->where('id',$id);
    $this->db->update('realtime', $data);
  }


}