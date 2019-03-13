<!DOCTYPE html>
<html lang="en">
    
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<meta charset="UTF-8">
		<title>Train Simulation</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/skel.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/skel-layers.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/init.js"></script>
        
        <script src="<?php echo base_url()?>assets/js/jquery-3.1.0.min.js">
    </script>
    
    <script>
    $(document).ready(function() {
	$('a[rel="relativeanchor"]').click(function(){
	    $('html, body').animate({
	        scrollTop: $( $.attr(this, 'href') ).offset().top
	    }, 1000);
	    return false;
	}); 
});
    
    </script>
        
        
		
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/skel.css" />
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css" />
			<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style-xlarge.css" />
		
		
	</head>
    
    
 <body class="landing">
<!-- Header -->
			<header id="header">
				<h1 style="font-size:35px;">Indian Railways</h1>
			</header>

		<!-- Banner -->
			<section id="banner">
				<h2>Train Section Simulation</h2>
				<ul class="actions">
					<li>
						<a href="#one" rel="relativeanchor" class="button big">Section Selection</a>
					</li>
                    <li>
						<a href="#two" rel="relativeanchor" class="button big">Important Stations</a>
					</li>
                    
				</ul>
			</section>
     
     <!-- One -->
			<section id="one" class="wrapper style1 align-center">
				<div class="container">
					<header>
						<h1 style="font-weight:800;font-size:30px;">Select Stations</h1>
					</header>
					<form method='post' action='index.php/sectionSimulation/userregister'>

     <h3 style="font-weight:400;text-align:left">Source</h3> 
<select name="source">
<?php
foreach ($basic as $key)
{
echo("<option value= '".$key->station."'  >" .$key->station.  "</option>");
}
?>
</select>
 <br>
    <h3 style="font-weight:400;text-align:left">Destination</h3> 
<select name="destination">
<?php
foreach ($basic as $key)
{

echo("<option value= '".$key->station."'  >" .$key->station.  "</option>");

}

?></select>
                        
                        
   <br><br>
                        
                        
     <h3 style="font-weight:400;text-align:left;">Preferred Timings - </h3> 
     <span style="font-weight:400;font-size:24px;color:#666;line-height:1em;">Start Time &nbsp; &nbsp; </span><input name="fromtime" type="time" style="opacity:0.7;" >
                        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
    <span style="font-weight:400;font-size:24px;color:#666;line-height:1em;">End Time &nbsp; &nbsp;</span><input name="totime" type="time" style="opacity:0.7;">
                        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
    <span style="font-weight:400;font-size:24px;color:#666;line-height:1em;">Simulation Speed &nbsp; &nbsp;</span><input name="speed" type="number" min="1" max="5" style="opacity:0.7;">
                        <br><br><br>
     &nbsp; 
    <input type='submit' name='submit' value='Submit'>
   </form>
				</div>
			</section>
     
     
     <!-- Two -->
			<section id="two" class="wrapper style2 align-center">
				<div class="container">
					<header>
						<h2 style="font-weight:800;">Important Stations</h2>
						
					</header>
					<div class="row">
						<section class="feature 6u 12u$(small)">
							<img class="image fit" src="<?php echo base_url()?>assets/images/pic01.jpg" alt="" />
							<h3 class="title" style="font-weight:500;">Kanpur Central</h3>
							<p>Kanpur Central or Cawnpore Barracks is one of five "Central" railway stations in India. It is the busiest railway station in India in terms of frequency of trains. Around 672 trains passes through the station daily.</p>
						</section>
						<section class="feature 6u$ 12u$(small)">
							<img class="image fit" src="<?php echo base_url()?>assets/images/pic02.jpg" alt="" />
							<h3 class="title" style="font-weight:500;">Chhatrapati Shivaji Terminus</h3>
							<p>Chhatrapati Shivaji Maharaj Terminus (CSMT) formerly known as Victoria Terminus is a historic railway station and a UNESCO World Heritage Site in Mumbai, Maharashtra, India which serves as the headquarters of the Central Railways.</p>
						</section>
						<section class="feature 6u 12u$(small)">
							<img class="image fit" src="<?php echo base_url()?>assets/images/pic03.jpg" alt="" />
							<h3 class="title" style="font-weight:500;">Chennai Central</h3>
							<p>Chennai Central or Madras Central, is the main railway terminus in the city of Chennai, Tamil Nadu, India.It is one of the most important hubs in the South. Chennai Central connects the city to all northern cities of India, including Kolkata, Mumbai and New Delhi.</p>
						</section>
						<section class="feature 6u$ 12u$(small)">
							<img class="image fit" src="<?php echo base_url()?>assets/images/pic04.jpg" alt="" />
							<h3 class="title" style="font-weight:500;">Howrah Junction</h3>
							<p>Howrah Junction also known as Howrah Station, is the largest railway complex in India and it is a railway station which serves Kolkata and Howrah, India. Approximately 620 passenger trains pass through the station each day requiring its 23 platforms and a high train handling capacity.</p>
						</section>
					</div>
					
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li>
						<li>Design: Dirty Coders</li>
						
					</ul>
				</div>
			</footer>
     
 </body>
</html>


