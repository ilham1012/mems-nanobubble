<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller{
  var $CI = NULL;

  function __construct() {
    // Construct our parent class
    parent::__construct();

    $this->load->model('Records_model');
  }


  /** 
   * =================================================================================
   * Realtime API
   * =================================================================================
   */

  public function realtime_get(){
    if(! $this->get('id')) {
      $this->response(array('error' => 'Missing post data: id'), 400);
    }else{
      $records = $this->Realtime_model->get_record($this->get('id'));
    }

    if($records){
      $this->response($records, 200);
    }else{
      $this->response([], 404);
    }
  }

  public function realtime_put(){
    if(! $this->put('id')){
      $this->response(array('error' => 'Task id is required'), 400);
    }

    $data = array(
      'id'     => $this->put('id'),
      'recording_time'    => $this->put('recording_time')
    );

    $this->task_model->update_task($this->put('id'), $data);
    $message = array('success' => $this->put('recording_time').' Updated!');
    $this->response($message, 200);
  }


  /** 
   * =================================================================================
   * Records API
   * =================================================================================
   */

  public function records_get(){
    if((! $this->get('id')) AND (! $this->get('date'))) {
      $records = $this->Records_model->get_all();
    }else if ($this->get('date')){
      $records = $this->Records_model->get_records_date($this->get('date'));
    }else{
      $records = $this->Records_model->get_record($this->get('id'));
    }

    if($records){
      $this->response($records, 200);
    }else{
      $this->response([], 404);
    }
  }


  public function records_post(){
    if(! $this->post('recording_time')){
      // Missing recording_time from http POST
      $this->response(array('error' => 'Missing post data: recording_time'), 400);
    }else if(! $this->post('file_name')){
      // Missing file_name from http POST
      $this->response(array('error' => 'Missing post data: file_name'), 400);
    }else{
      // Construct data into array
      $data = array(
        'recording_time' => $this->post('recording_time'),
        'file_name' => $this->post('file_name')
      );
    }

    $this->db->insert('record', $data);

    // Do this if there's an ID
    if($this->db->insert_id() > 0){
      $message = array(
        'id' => $this->db->insert_id(),
        'recording_time' => $this->post('recording_time'),
        'file_name' => $this->post('file_name')
        );
      $this->response($message, 200);
    }
  }


  /** 
   * =================================================================================
   * Data file API
   * =================================================================================
   */

  public function upload_post(){
    $config['upload_path'] = './uploads/data/';
    $config['allowed_types'] = '*';
    $this->load->library('upload', $config);


    if(! $this->upload->do_upload('file')){
      $this->response(array('error' => 'Error: uploading file' . $this->upload->display_errors()), 400);
    }else{
      $this->response(array(
        'error' => false,
        'message' => 'Success'
      ), 200);
    }

  }


  public function parse_file_get(){
    $this->load->helper('download');
    $name = $this->get('filename');

    $json_string = site_url('uploads/data/' . $name . ".txt");
    $jsondata = file_get_contents($json_string);
    $obj = json_decode($jsondata);


    if($obj){
      $this->response($obj, 200);
    }else{
      $this->response($json_string, 404);
    }
  }


  /** 
   * =================================================================================
   * Realtime Data file API
   * =================================================================================
   */

  public function upload_realtime_post(){
    $config['upload_path'] = './uploads/data/realtime';
    $config['allowed_types'] = '*';
    $config['overwrite'] = TRUE;
    $this->load->library('upload', $config);


    if(! $this->upload->do_upload('file')){
      $this->response(array('error' => 'Error: uploading file' . $this->upload->display_errors()), 400);
    }else{
      $this->response(array(
        'error' => false,
        'message' => 'Success'
      ), 200);
    }

  }


  public function parse_realtime_file_get(){
    $this->load->helper('download');

    $json_string = site_url('uploads/data/realtime/realtime.txt');
    $jsondata = file_get_contents($json_string);
    $obj = json_decode($jsondata);


    if($obj){
      $this->response($obj, 200);
    }else{
      $this->response($json_string, 404);
    }
  }




}