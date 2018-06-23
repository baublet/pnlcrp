<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
</head><!-- OUTER PAGE TABLE-->
<CENTER>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Seattle General Strike: Walking Tour</title>
<meta http-equiv="refresh" content="1; URL=http://depts.washington.edu/labhist/cpproject/walking_tour.shtml">

<link href="strikestyles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="print" href="strikeprintstyles.css" />
<style>

.content {
width:759px;
_width:719px;
background-color:#CCCCCC;
color:#000000;
font-family:Georgia, Times, serif;
font-size:medium;

padding:10px 20px 0px 50px;

text-align:left;
line-height:100%;
}

.content P {
text-indent:0px;
margin-bottom:0px;
}

</style>

</head>

<body>

<div><img src="headerimages/strike-logo.jpg" alt="The 1919 Seattle General Strike" width="829" height="152" border="0" usemap="#pnlcrhp">
  <map name="pnlcrhp">
    <area shape="rect" coords="406,3,826,27" href="http://depts.washington.edu/labhist">
  </map>
</div>
<?php 
readfile('menu.html');
?>


<div class="content">

 <div class="heading" style="margin-bottom:5px;">Page has moved</div>
<div style="position:relative;right:39px;">
 
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
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1972947-1";
urchinTracker();
</script>
</body>
</html>
