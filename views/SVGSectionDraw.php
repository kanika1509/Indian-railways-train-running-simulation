<?php
include "Parameter.php";
include "SVGLib.php";

    
$ChosenArr=explode(",",$Chosen); 
 trim($ChosenArr[0]);
trim($ChosenArr[1]);
$arr["Kanpur"]="60 100";
$arr1[0]="Kanpur";

$X1Axis=0;
foreach($TrainDetails as $key)
$TrainInfo[$key->TrainNo]=$key->Train;

foreach($distances as $value){
    $temp1=105;
    $temp2=105;
    $result1=$value->km;
	  $result2=$value->stationname;
  
    $result2=trim($result2);
    $arr1[$i]=$result2;
    $i+=1;
	  $X2Axis=$X1Axis+$result1+110;
    $arr[$result2]=$X1Axis." ".$X2Axis;
  
   $temp1+=(int)$X1Axis;
   $temp2+=(int)$X2Axis;
   $CountTrains2[$temp1]=-20;
   $CountTrains[$temp1." ".$temp2]=-20;
   $X1Axis = $X2Axis;
    
}

$fromtime = $UserInput["fromtime"];
$totime= $UserInput["totime"];
$speed = $UserInput["speed"];

$CurrentHour = (int)substr($fromtime,0,2);
$CurrentMinute =(int)substr($fromtime,3,2) ;

$ToHour = (int)substr($totime,0,2);
$ToMinute =(int)substr($totime,3,2) ;

$Out = "";
$FinalSVG = "";


$flag=2;
$ArrayForMiddle=array();
   for($i=0;$i<sizeof($ArrivalTime)-1;$i++){
        $ArrivalMinute = (int)(substr((string)$ArrivalTime[$i]->arrivaltime,2,2));
        $ArrivalHour = (int)(substr((string)$ArrivalTime[$i]->arrivaltime,0,2));
       
        $DepartureMinute = (int)(substr((string)$ArrivalTime[$i]->departuretime,2,2));
        $DepartureHour = (int)(substr((string)$ArrivalTime[$i]->departuretime,0,2));
        
        $NextArrivalMinute = (int)(substr((string)$ArrivalTime[$i+1]->arrivaltime,2,2));
        $NextArrivalHour = (int)(substr((string)$ArrivalTime[$i+1]->arrivaltime,0,2));
       
        $TrainNumber = $ArrivalTime[$i]->train;

        if($ArrivalHour==$NextArrivalHour){
           $diff=$NextArrivalMinute - $ArrivalMinute;
       }
       else{
          
           $diff=(int)$ArrivalTime[$i+1]->arrivaltime - (int)$ArrivalTime[$i]->arrivaltime-40;
  
       }
       $TrainName="";
       foreach($ArrayForMiddle as $ke=>$val){
           if($ke==(int)$TrainNumber){
               unset($ArrayForMiddle[$key]);
               $ArrayForMiddle=array_values($ArrayForMiddle);
           }
       }
       
        $TimeDiff=0;
        while($TimeDiff!=$diff){
          
            if($CurrentMinute>59){
                $CurrentHour+=1;
                $CurrentMinute=0;
            }
               
                if($CurrentHour==$ToHour && $CurrentMinute==$ToMinute)
            {        
              exit(0);
            }

         $First=1;
        echo "<script type='text/javascript'>",
        "deletesvg();deletecircle();",
        "</script>";
   $Out.="<html>
   
   <head>
   <style>
   #component .tooltip {visibility: hidden}
   #component:hover{
   cursor:pointer;
 }
 #component:hover .tooltip {
    visibility: visible;
    opacity: 1;
}
.tooltip text {
    fill: white;
    font-size: 32px;
    font-family: sans-serif;
}

</style>
</head>
   
   <script>
   
   function deletecircle(){
   
   var circle = document.getElementById('circle');
   var parent = circle.parentNode;
   parent.removeChild(circle);
   }
   
   
   
   function deletesvg(){
   var svg = document.getElementById('svg');
   document.body.removeChild(svg);
   }
   </script>
   <body style='background-color:#BFEFFF';>
          <svg id='svg' style='width:1350;height:500' viewbox='-50 -50 3050 250'>";
    if($First==1){
        $FinalSVG = DrawSVGLine($distances);
        $Out.=$FinalSVG;
        $First = 0;
    }
            
            if($DepartureMinute>$CurrentMinute){
            
                $currentstation = $ArrivalTime[$i]->stationname;
                $train=$ArrivalTime[$i]->train;
                foreach ($TrainInfo as $key=>$value) {
            
                  if($key==$train)
                {
                    $TrainName=$TrainInfo[$key];
                     break;
                }   
                      else
                      {
                        $TrainName=$train;
                      }

                }
                
                    for($k=0;$k<sizeof($Direction);$k++){
                        if($train==$Direction[$k]->train){
                            $StartStation = trim($Direction[$k]->stationname);
                            break;
                        }
                    }
                $temparr = explode(" ",$arr[$currentstation]);
                $XOneAxis = (int)$temparr[0];
                $XNextAxis = (int)$temparr[1];
              
                $XOneAxis+=85;
                $XTwoAxis=$XOneAxis+30;
                $TextCoordinate = $XTwoAxis+70;


                    if(strcmp($StartStation,$ChosenArr[1])==0){

                                         	$Out.="<defs>
    <marker id='arrow1' markerWidth='10' markerHeight='10' refX='0' refY='3' orient='auto' markerUnits='strokeWidth'>
      <path d='M0,0 L0,6 L6,3 z' fill='red' />
    </marker>
  </defs>
<g id='component'>
  <line x1=".$XOneAxis." y1='100' x2=".$XTwoAxis." y2='100' stroke='yellow' stroke-width='5' marker-end='url(#arrow1)' />
  <g class='tooltip' opacity=0.9>
  <rect x=1250 y='-200' rx='5' width='500' height='150' style='fill:#555;stroke:blue;'></rect>
  <text x=1260 y='-170' font-size=4><tspan x=1260 dy=0.6em>Train No.".$TrainName."</tspan>
  <tspan x=1260 dy=1.2em>Current Status: At ".$currentstation."</tspan>
  <tspan x=1260 dy=1.3em>Departure Time: ".$DepartureHour.":".$DepartureMinute."</tspan>
  </text>
  </g>  </g>";

               
                    }
                    else{

                    	$Out.="<defs>
    <marker id='arrow2' markerWidth='10' markerHeight='10' refX='0' refY='3' orient='auto' markerUnits='strokeWidth'>
      <path d='M0,0 L0,6 L6,3 z' fill='red' />
    </marker>
  </defs>
<g id='component'>
  <line x1=".$XTwoAxis." y1='150' x2=".$XOneAxis." y2='150' stroke='yellow' stroke-width='5' marker-end='url(#arrow2)' />
  <g class='tooltip' opacity=0.9>
  <rect x=1250 y='250' rx='5' width='500' height='150' style='fill:#555;stroke:blue;'></rect>
  <text x=1260 y='282' font-size=4>
  <tspan x=1260 dy=0.6em>Train No.".$TrainName."</tspan>
  <tspan x=1260 dy=1.2em>Current Status: At ".$currentstation."</tspan>
  <tspan x=1260 dy=1.3em>Departure Time: ".$DepartureHour.":".$DepartureMinute."</tspan>
  </text>
  </g>  </g>";

                    }
            
            }
            
            for($j=0;$j<sizeof($trainbyname)-1;$j++){
               $DepartureMinutes = (int)(substr((string)$trainbyname[$j]->departuretime,2,2));
                $DepartureHours = (int)(substr((string)$trainbyname[$j]->departuretime,0,2));
                
                if($CurrentHour==$DepartureHours && $CurrentMinute==$DepartureMinutes){
                    $currentstation = $trainbyname[$j]->stationname;
                    
                    $train=$trainbyname[$j]->train;
                    for($k=0;$k<sizeof($Direction);$k++){
                        if($train==$Direction[$k]->train){
                            $StartStation = trim($Direction[$k]->stationname);
                            break;
                        }
                    }
                    
                    $temparr = explode(" ",$arr[$currentstation]);
                    $XOneAxis = (int)$temparr[0];
                    $XNextAxis = (int)$temparr[1];

                    $Index=array_search($currentstation,$arr1);
                    $temparrprev = explode(" ",$arr[$arr1[$Index-1]]);
                    $XPrevAxis = (int)$temparrprev[0];
                    
                    $ArrayForMiddle[$train] = array($XOneAxis,$XNextAxis,$StartStation,1,$XPrevAxis);
                    $XOneAxis+=85;
                    $XNextAxis+=85;
                    $XPrevAxis+=85;
                
                $XTwoAxis=$XOneAxis+30;
                $TextCoordinate = $XTwoAxis+70;
                    
                    if(strcmp($StartStation,$ChosenArr[1])==0 && strcmp($currentstation,$ChosenArr[0])!=0){

$Out.="<defs>
    <marker id='arrow3' markerWidth='10' markerHeight='10' refX='0' refY='3' orient='auto' markerUnits='strokeWidth'>
      <path d='M0,0 L0,6 L6,3 z' fill='green' />
    </marker>
  </defs>
<g id='component'>
  <line x1=".$XOneAxis." y1='100' x2=".$XTwoAxis." y2='100' stroke='yellow' stroke-width='5' marker-end='url(#arrow3)' />
  <g class='tooltip' opacity=0.9>
  <rect x=1250 y='-200' rx='5' width='500' height='150' style='fill:#555;stroke:blue;'></rect>
  <text x=1260 y='-170' font-size=4>
  <tspan x=1260 dy=0.6em>Train No.".$TrainName."</tspan>
  <tspan x=1260 dy=1.2em>Source Station: ".$StartStation."</tspan>
  <tspan x=1260 dy=1.3em>Current Station: ".$currentstation."</tspan>
  </text>
  </g>  </g>";

                /*$Out.="<line id='circle' X1=".$XOneAxis." Y1='100' X2=".$XTwoAxis." Y2='100' Stroke='yellow' Stroke-width='5'></line>";
                $Out.="<g id='component'><circle id='circle' cx=".$XTwoAxis." cy=100 r=14 fill='green'></circle>
                <g class='tooltip' opacity='0.9>
            <rect x=".$XTwoAxis." y='70' rx='5' width='100' height='25' style='fill:#555;stroke: blue;'></rect>
            <text x=".$TextCoordinate." y='82'>".$train."</text> 
                </g>
                </g>";*/
                    }

                    else{
                        if(strcmp($StartStation,$ChosenArr[0])==0 && strcmp($currentstation,$ChosenArr[1])!=0){
                        
$Out.="<defs>
    <marker id='arrow4' markerWidth='10' markerHeight='10' refX='0' refY='3' orient='auto' markerUnits='strokeWidth'>
      <path d='M0,0 L0,6 L6,3 z' fill='green' />
    </marker>
  </defs>
<g id='component'>
  <line x1=".$XTwoAxis." y1='150' x2=".$XOneAxis." y2='150' stroke='yellow' stroke-width='5' marker-end='url(#arrow4)' />
  <g class='tooltip' opacity=0.9>
  <rect x=1250 y='250' rx='5' width='500' height='150' style='fill:#555;stroke:blue;'></rect>
  <text x=1260 y='282' font-size=4>
  <tspan x=1260 dy=0.6em>Train.".$TrainName."</tspan>
  <tspan x=1260 dy=1.2em>Source Station: ".$StartStation."</tspan>
  <tspan x=1260 dy=1.3em>Current Station: ".$currentstation."</tspan>
  </text>
  </g>  </g>";
                    }
                    
                }
                }
            }   
            
            foreach($ArrayForMiddle as $key=>$value){
               
                if($value[3]==0){
                $DrawXOneAxis=$value[0]+105;
                //$DrawXOneAxis+=85;
                $DrawXNextAxis=$value[1]+105;
                $DrawXPrevAxis=$value[4]+105;
                 $Change=100;
                 $Change2=150;
                    if(strcmp($value[2],$ChosenArr[1])==0 && strcmp($key,$ChosenArr[0])!=0){
            
                $XMiddleAxis=($DrawXOneAxis+$DrawXNextAxis)/2;
                
                $XMiddleTwoAxis=$XMiddleAxis+15;
                $XMiddleOneAxis=$XMiddleAxis-15;
                $TextCoordinate = $XMiddleTwoAxis+70;
                $CountTrains[$DrawXOneAxis." ".$DrawXNextAxis]+=$Count;
                $Change-=$CountTrains[$DrawXOneAxis." ".$DrawXNextAxis];
$Out.="<defs>
    <marker id='arrow5' markerWidth='5' markerHeight='10' refX='0' refY='3' orient='auto' markerUnits='strokeWidth'>
      <path d='M0,0 L0,6 L6,3 z' fill='green' />
    </marker>
  </defs>
  

<g id='component'>
  <line x1=".$XMiddleOneAxis." y1=".$Change." x2=".$XMiddleTwoAxis." y2=".$Change." stroke='yellow' stroke-width='5' marker-end='url(#arrow5)' />
  
  <g class='tooltip' opacity=0.9>
  <rect x='1250' y='-200' rx='5' width='500' height='150' style='fill:#555;stroke:blue;'></rect>
  <text x=1260 y='-170' font-size=4><tspan x=1260 dy=0.6em>Train No.".$key."</tspan>
  <tspan x=1260 dy=1.2em>Source Station: ".$value[2]."</tspan>
  </text>
  </g>  </g>";

                
                    }
                    else{
                        if(strcmp($value[2],$ChosenArr[0])==0 && strcmp($key,$ChosenArr[1])!=0){
                        
                $XMiddleAxis=($DrawXOneAxis+$DrawXPrevAxis)/2;
                $CountTrains2[$DrawXOneAxis]+=$Count;
                $Change2+=$CountTrains2[$DrawXOneAxis];
                        
                $XMiddleOneAxis=$XMiddleAxis-15;
                $XMiddleTwoAxis=$XMiddleAxis+15;
                $TextCoordinate = $XMiddleTwoAxis+70;
                        
                        $Out.="<defs>
    <marker id='arrow6' markerWidth='10' markerHeight='10' refX='0' refY='3' orient='auto' markerUnits='strokeWidth'>
      <path d='M0,0 L0,6 L6,3 z' fill='green' />
    </marker>
  </defs>
<g id='component'>
  <line x1=".$XMiddleTwoAxis." y1=".$Change2." x2=".$XMiddleOneAxis." y2=".$Change2." stroke='yellow' stroke-width='5' marker-end='url(#arrow6)' />
  <g class='tooltip' opacity=0.9>
  <rect x=1250 y='250' rx='5' width='500' height='150' style='fill:#555;stroke:blue;'></rect>
  <text x=1260 y='282' font-size=4>
  <tspan x=1260 dy=0.6em>Train No.".$key."</tspan>
  <tspan x=1260 dy=1.2em>Source Station: ".$value[2]."</tspan>
  </text>
  </g>  </g>";
		  }
            }}
            }
            foreach ($CountTrains as $key => $value) {
              $CountTrains[$key]=- 20;
            }
           
            foreach($ArrayForMiddle as $key=>$value){
                $ArrayForMiddle[$key][3]=0;
            }

            foreach($CountTrains2 as $key=>$value){
                $CountTrains2[$key]=-20;
            }


            $Out.="<rect x=40 y=300 rx=5 width=250 height=100 style='fill:#555;stroke:blue;'></rect>
            <text x=80 y=350 style='font-size:35px;font-family:sans-serif' fill='white'>Time: ".$CurrentHour.":".$CurrentMinute."</text>";
            
            
            $CurrentMinute++;  
            $TimeDiff++;
             $Out.="</svg></body></html>";
       echo $Out;
       $Out="";
    
       ob_flush();
    flush();
    sleep((int)$speed);
        }
    }
?>

