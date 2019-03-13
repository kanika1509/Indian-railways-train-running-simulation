<?php

function DrawSVGLine($distances)
{
 include "Parameter.php";

    $SVG_Circle = "";
    $SVG_Circle .= "<line id='BS_UL_Kanpur' X1='60' Y1=".$Y1Axis." X2=".$X1Axis." Y2=".$Y1Axis." Stroke=".$Stroke." Stroke-width=".$StrokeWidth1." ><title>2.6</title></line>";
    
    $SVG_Circle .= "<line id='BS_LL_Kanpur' X1='60' Y1=".$Y2Axis." X2=".$X1Axis." Y2=".$Y2Axis." Stroke=".$Stroke." Stroke-width=".$StrokeWidth2." ><title>2.6</title></line>";
    
    $SVG_Circle .= "<line id='STN_Kanpur' X1='60' Y1=".$VerticalY1." X2='60' Y2=".$VerticalY2." Stroke=".$Stroke." Stroke-width=".$StrokeWidth2." ><title>Reference Point</title></line>
    <g fill='black' font-size=15 writing-mode='tb-rl'>

<text x=0 y=-40 glyph-orientation-vertical=90>
  Reference Point
</text></g>";
    
     
    foreach($distances as $value)
{
    $result1=$value->km;
	$result2=$value->stationname;
    $result2=trim($result2);
    

    
	$X2Axis=$X1Axis+$result1+110;
	 
    $diff=round($X2Axis-$X1Axis-100,2);

   $SVG_Circle .= "<line id='BS_UL_'".$result2." X1=".$X1Axis." Y1=".$Y1Axis." X2=".$X2Axis." Y2=".$Y1Axis." Stroke=".$Stroke." Stroke-width=".$StrokeWidth2." ><title>".$diff."</title></line>";
    
    $SVG_Circle .= "<line id='BS_LL_'".$result2." X1=".$X1Axis." Y1=".$Y2Axis." X2=".$X2Axis." Y2=".$Y2Axis." Stroke=".$Stroke." Stroke-width=".$StrokeWidth2." ><title>".$diff."</title></line>";
    
    $SVG_Circle .= "<line id='STN_'".$result2." X1=".$X1Axis." Y1=".$VerticalY1." X2=".$X1Axis." Y2=".$VerticalY2." Stroke=".$Stroke." Stroke-width=".$StrokeWidth2." ><title>".$result2."</title></line>

<g fill='black' font-size=15 writing-mode='tb-rl'>

<text x=".$X1Axis." y=-40 glyph-orientation-vertical=90>" 
  .$result2.
"</text></g>";
    
    
	
    $X1Axis=$X2Axis;
}
    return $SVG_Circle;
}


?>
