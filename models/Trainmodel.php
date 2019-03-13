<?php
class Trainmodel extends CI_MODEL
{
	public function getmembers($data1,$data2) { 
           $this->db->select('seqno,stationname');
           $this->db->from('RouteStations');
           $this->db->order_by("seqno","DESC");
           $this->db->where("section","627");
           $query=$this->db->get();
           $res   = $query->result();  
           return $res;
	}
  public function arrival($VariableStation1)
  {
  $query2= $this->db->query("Select train,stationname,arrivaltime,departuretime from WTTTrainRoute where train in  (Select train from WTTTrainRoute where section=".$VariableStation1[1].")&&  stationname in  (select stationname from RouteTSStations where sectionTS=".$VariableStation1[0].") &&  arrivaltime<>0  order by arrivaltime limit 180");

    $ResArrival=$query2->result();
return  $ResArrival;
     
  }


       public function distance($VariableStation1)
{




    $this->db->select('km,stationname,seqno');
    $this->db->from('RouteTSStations');
    $this->db->order_by("seqno","DESC");
    $this->db->where("sectionTS",$VariableStation1[0]);
    $query=$this->db->get();
  
     $resbasic=$query->result();
    return $resbasic;
         
}

public function getbasic()
{
    $this->db->select('DISTINCT(station)');
    $this->db->from('Station');
    $query=$this->db->get();
    $resbasic=$query->result();
    return $resbasic;
}
public function getStationSchedule($VariableStation1)
{
    $query1= $this->db->query("Select train,stationname,arrivaltime,departuretime from WTTTrainRoute where train in 
(Select train from WTTTrainRoute where section=".$VariableStation1[1].")&& 
stationname in 
(select stationname from RouteTSStations where sectionTS=".$VariableStation1[0].") order by departuretime");
    $res=$query1->result();
return  $res;   
}
    
    
    public function getRailwayLine($VariableStation1)
    {
    $query=$this->db->query("select train,stationname,seqno from WTTTrainRoute where train in(
select train from WTTTrainRoute where section=".$VariableStation1[1].") && 
stationname in 
(select stationname from RouteTSStations where sectionts=".$VariableStation1[0].") group by train");
    $res1=$query->result();
    return $res1;
    
}
public function getTrainDetails(){
  $query=$this->db->query("select Train,TrainNo,CoachCount,TrainType from Train");
  $res2=$query->result();
  return $res2;
}



}
