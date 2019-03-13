<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Train extends CI_Controller {

	public function index()
	{
		$this->load->database();
        $this->load->model('trainmodel');
        $res = $this->trainmodel->getmembers();
        $data['records']=$res;
        $this->load->view('train',$data);
       
       }}