<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('NET/SSH2.php');
include('phpseclib1.0.11/NET/SFTP.php');
set_include_path(get_include_path().PATH_SEPARATOR.'phpseclib');
class Home extends CI_Controller
{
    public function hi()
    {
        $connection=ssh2_connect("172.26.118.165",22);

    if(!$connection)
    {
        echo json_encode('connection failed');
    }
        ssh2_auth_password($connection, "aruvansh","dragon1997");
        $stream=ssh2_exec($connection,"ls -1");
        stream_set_blocking($stream, true);
        $output="";
        while($line=fgets($stream))
            {
                $output.=$line;

            }
            echo json_encode($line);

    }
}
/*
$this->load->database();
$this->load->model('resumemodel');
        $res = $this->trainmodel->getmembers();
        $data['records']=$res;
        $this->load->view('train',$data);
        echo "hi";


}}*/