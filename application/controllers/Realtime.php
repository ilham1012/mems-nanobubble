<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
*
*/
class Realtime extends CI_Controller {

  public function index(){
    $data = array(
        'title' => 'Realtime Page',
        'content' => 'realtime_view'
      );

    $this->load->view('realtime', $data);
  }
}