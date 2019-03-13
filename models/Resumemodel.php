<?php 

class Resumemodel extends CI_MODEL
{
	 //function __construct() { 
     //    parent::__construct(); 
      //}
   
		public function getmembers() { 
     $data = array();
    $query = $this->db->get('Station');
    $res   = $query->result();  
    
    return $res;

      }
}

?>
