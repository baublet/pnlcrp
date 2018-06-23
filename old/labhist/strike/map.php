<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Seattle General Strike: Map</title>
<meta http-equiv="refresh" content="1; URL=http://depts.washington.edu/labhist/strike/map.shtml">

<link href="strikestyles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="print" href="strikeprintstyles.css">


</head><!-- OUTER PAGE TABLE-->
<CENTER>

<body style="background:black;">

<div><img src="headerimages/strike-logo.jpg" alt="The 1919 Seattle General Strike" width="829" height="152" border="0" usemap="#pnlcrhp">
  <map name="pnlcrhp">
    <area shape="rect" coords="406,3,826,27" href="http://depts.washington.edu/labhist">
  </map>
</div>
<?php 
readfile('menu.html');
?>


<div class="content">

 <div class="heading" style="margin-bottom:5px;">
   <h5>Page has moved to<br>
    <a href="http://depts.washington.edu/labhist/strike/map.shtml">http://depts.washington.edu/labhist/strike/map.shtml</a> </h5>
 </div>
 
 <div class="intro" style="line-height:160%;">Many of the events of January and February 1919 took place in the downtown and waterfront sections of Seattle. Click on the map below to see photographs of strike events, and to see the offices and headquarters of the Central Labor Council, Union Record, Metal Trades Council, IWW, Socialist Party, Cooperative Union Market, Japanese Labor Association, and other unions and cooperatives.   <br>
 <br>
 Arkady DeRoest is responsible for most of the research, photography, and descriptions that make this map possible. Click the pins or the thumbnails below to read about events and locations. For more photographs and to see what locations look like today visit our <a href="http://depts.washington.edu/labpics/repository/v/1919_strike/" target="_blank">photo repository</a>. <br>
 
 </div>


<div style="position:relative;right:39px;_right:39px;line-height:100%;">
 
 <?php

	
// readfile("http://depts.washington.edu/labpics/repository/main.php?g2_view=map.ShowMap&g2_album=1919+Seattle+General+Strike&g2_fullScreen=2");

$ch = curl_init();
$timeout = 5; // set to zero for no timeout
curl_setopt ($ch, CURLOPT_URL, 'http://depts.washington.edu/labpics/repository/gallery2embedded.php?g2_view=map.ShowMap&g2_album=1919+Seattle+General+Strike&g2_fullScreen=2');
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch);
curl_close($ch);
echo $file_contents;


// echo $data['headHtml'];
// echo $data['javascript'];
// echo $data['css'];
 ?>
 
 
 
 
 </div>
 
 
 
 
</div>


     
 
 

<div id="bottom">
<?php 
readfile('footer.html');
?>
</div>
</body>
</html>
