<?php
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');
defined('BASEPATH') OR exit('No direct script access allowed');

class SectionSimulation extends CI_Controller {

	public function index()
        {
               $this->load->database();
             $this->load->helper('url');
               $this->load->model('trainmodel');
               $resbasic=$this->trainmodel->getbasic();
               $data3['basic']=$resbasic;
               
              $this->load->view('SectionSelectionForm',$data3,FALSE);               
                
}

public function userregister()
{
              
     $data1=  $this->input->post("source");    
    $data2= $this->input->post("destination");
     $fromtime=  $this->input->post("fromtime");    
    $totime= $this->input->post("totime");
     $speed=  $this->input->post("speed");    
    // $VariableStation=array(array('New Delhi','Palwal','23','619'),array('Tundla','Kanpur Central','15','627'),array('Kanpur Central','Allahbad','16','628'),array('New Delhi','Ghaziabad','12','624'));
       $VariableStation1=array();

      if($data1=='TUNDLA JN.') 
      {
         $data3['Chosen']="TUNDLA JN.,Govindpuri (GOY)";
         $VariableStation1[0]=15;
        $VariableStation1[1]=627;}
      else if ($data1=='KANPUR CENTRAL') {
         $VariableStation1[0]=16;
         $data3['Chosen']="KANPUR CENTRAL,Subedarganj";
        $VariableStation1[1]=628;
      }
      else if ($data2=='GHAZIABAD JN.')
      {
         $VariableStation1[0]=12;
        $VariableStation1[1]=624;
        $data3['Chosen']="NEW DELHI,GHAZIABAD JN.";
      }
    else
    { $VariableStation1[0]=23;
        $VariableStation1[1]=619;
        $data3['Chosen']="NEW DELHI,Palwal";
      }
       
  
    
  
    
    $this->load->model('trainmodel');
    $this->load->database();


$res1=$this->trainmodel->distance($VariableStation1);

    for($i=0;$i<sizeof($res1)-1;$i++){
        $res1[$i]->km = $res1[$i]->km - $res1[$i+1]->km;
    }
    $res1[sizeof($res1)-1]->km=0;
    
    
    
$data3['distances']=$res1;



$mindist=$res1[sizeof($res1)-1]->km;


foreach($res1 as $x){
$x->km-=$mindist;

}
$Direction=$this->trainmodel->getRailwayLine($VariableStation1);
$data3['Direction']=$Direction;

//$this->load->view('SVGSectionDraw',$data3);
$res2=$this->trainmodel->getStationSchedule($VariableStation1);
$data3['trainbyname']=$res2;
$ResArrival=$this->trainmodel->arrival($VariableStation1);
$data3['ArrivalTime']=$ResArrival;

$data3['TrainDetails']=$this->trainmodel->getTrainDetails();
    
    
$data3['UserInput']=array("fromtime"=>$fromtime, "totime"=>$totime, "speed"=>$speed);    
    

$this->load->view('SVGSectionDraw',$data3);

}



}


