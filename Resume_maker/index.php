<html>
<head>
<style>
form{top:35px;}
table {text-align:center;
    border-collapse: collapse;
	border:solid #993300 1px; 
	border-radius:10px 3px;
margin-top:5px;
}
th{background-color:#a21921;}
tr,td,th{border:2px black solid;}

body {
background-image:url(http://www.indianrail.gov.in/images/main_bg.gif);
background-position:5px 5px;
background-color:#FFFFFF;
margin: 0px;
padding: 0px;
font-family:Verdana, Arial, Helvetica, sans-serif;

font-weight:normal;
color:#000000;
background-repeat:repeat-x;
scrollbar-darkshadow-color: #00ffff ;
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    border-radius:5px 2px;
    text-align:center;
    padding:5px;	 	 
}
form{margin-top:20px; text-align:center;
line-height:10%;}
img{margin-top:30px;}
</style>

</head>

<body>
<img src="pic/rail.gif">
	<form method="post" action="" >
		<p>Enter the Train Number Please</p>
 Train No.
 <input type="text" name="msg" id="msg" required="required" />
 </br>

 Submit
 <input    type="submit" name="submit" id="submit" value="Submit" style="margin-left:15px;"/>

 
 </form>

<?php 

if (isset($_POST['submit'])) {
$msg = $_POST['msg'];
//echo $msg;
}
else
$msg="";

?>

<?php
if (isset($_POST['submit'])) {
$str = file_get_contents('http://api.railwayapi.com/route/train/'.$msg.'/apikey/oephz7844/'); 
$json = json_decode($str, true);
}
?>

<?php if (isset($_POST['submit'])){ ?>
<div align='center'>
<table   border='1' width='728px' >
<tr>
  <th>Train_Name</th>
<th>Train No.</th>
</tr>

<td >
									
									<?php echo $json['train']['name']; ?>
								</td>
								
<td >
									
									 <?php echo $json['train']['number']; ?>
							</td>

</table>
</div>
<?php }  ?>

<!-- code for lower table-->
<!--***************************************************************************************-->
<?php if (isset($_POST['submit'])){ ?>
<table   align="center" border="1" width="728px" >
<tr>  <th>Route</th>
<th>Schedule_Departure</th >  <th>Schedule_Arrival</th> <th>Halt(in Minute)</th><th> Day</th> <th>Lattitude</th><th>State</th> <th>Distance(in KMs)</th> <th>Station _Name</th> <th>Langitude</th><th>code</th> <th>Station_No.</th>
</tr>

					<tbody>
					<?php foreach($json['route'] as $key){ ?>
					<?php foreach ($json['route'][$key] as $key1 ){ ?>
						<tr>
							<p>
								
								<td >
									
									<?php echo $json['route'][$key]['route']; ?>
								</td>
								<td>
									
									<?php echo $json['route'][$key]['schdep']; ?>
								</td>
								<td>
									
									<?php echo $json['route'][$key]['scharr']; ?>
								</td>
								<td>
									
									<?php echo $json['route'][$key]['halt']; ?>
								</td>
								<td>
									
									<?php echo $json['route'][$key]['day']; ?>
								</td>
								
								
								<td>
									
									<?php echo $json['route'][$key]['lat']; ?>
								</td>
								
								<td>
									
									<?php echo $json['route'][$key]['state']; ?>
								</td>
								<td>
									
									<?php echo $json['route'][$key]['distance']; ?>
								</td>
								<td>
									
									<?php echo $json['route'][$key]['fullname']; ?>
								</td>
								<td>
									
									<?php echo $json['route'][$key]['lng']; ?>
								</td>
								<td>
									
									<?php echo $json['route'][$key]['code']; ?>
								</td>
								<td>
									
									<?php echo $json['route'][$key]['no']; break;?>
								</td>
							</p>
						</tr>
					<?php } ?>
					<?php } ?>
					</tbody>
                </table>

<?php } ?>
<p id="footer"><marquee>
Designed By <b>Sundarr Insa </b></marquee>
</p>
</body>


</html>