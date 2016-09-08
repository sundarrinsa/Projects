<?php
/*    College Information  */
$name=$_POST['Name'];
$class=$_POST['Class'];
$course=$_POST['Course'];
$college=$_POST['College'];
$saal=$_POST['saal'];
$semester=$_POST['Semester'];

$email=$_POST['Email'];
$interest=$_POST['Area(s)_of_Interest'];
$year=$saal;

if($year==1&&$semester==1)
{$y='st';
$s='st';
}
else if($year==1&&$semester==2)
{$y='st';
$s='nd';
}
else if($year==2&&$semester==3)
{$y='nd';
$s='rd';
}
else if($year==2&&$semester==4)
{$y='nd';
$s='th';
}
else if($year==3)
{$y='rd';
$s='th';
}
else 
{$y='th';
$s='th';
}

$c='(';
$d=')';

$count=0;



/*     Educational Qualification  */

$Qualification=$_POST['Qualification'];
$year=$_POST['year'];
$Board=$_POST['Board'];
$CGPA=$_POST['CGPA'];
$Hobby=$_POST['Hobby'];
$Skills_Name=$_POST['Skills_Name'];
$Skills=$_POST['Skills'];

/*     Personal Details */

$F_Name=$_POST['F_Name'];
$H_No=$_POST['H_No'];
$Day=$_POST['Day'];
$Month=$_POST['Month'];
$Birth=$_POST['Birth'];
$Place=$_POST['Place'];
$Gender=$_POST['Gender'];
$District=$_POST['District'];
$State=$_POST['State'];
$PN=$_POST['PN'];
$SN=$_POST['SN'];
$Pincode=$_POST['Pincode'];

/* Projct or Internships  */
$Project=$_POST['Project'];
$Details=$_POST['Details'];

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/form.css">
</head>
<body >
<div id='demo'> </div>
<div id='demo1'> </div>
<div id='demo2'> </div>
<div id='demo3'> </div>
<div id="line"> </div>
<div id="demo4"> </div>
<div id="line1"> </div>
<div id='demo5'></div>
<div id='demo6'></div>
<div id='demo7'>Education</div>
<div id='demo8'>Technical Exposure </div>
				<div id="pro">project or Internships</div>

<?php 
$v=' ';
echo "<script> document.getElementById('demo').innerHTML ='$name'; </script>" ;
echo "<script> document.getElementById('demo1').innerHTML ='$class' + ','+'$course'+'</br>'+'$college' +'</br>'+'$c'+'$saal'+'$y'+' Year | '+'$semester'+'$s'+' Semester'+'$d'+'</br>'; </script>" ;
echo "<script> document.getElementById('demo2').innerHTML ='E-mail: '+'$email'; </script>" ;
//echo "<script color='red'> document.getElementById('demo2').innerHTML ='$email'; </script>" ;
//echo "<script> document.getElementById('demo3').innerHTML ='$email'; </script>" ;

echo "<script> document.getElementById('demo5').innerHTML='Area of Interest: '; </script>" ;
echo "<script> document.getElementById('demo6').innerHTML='$interest'; </script>" ;

/*echo"<table id='tab' colspan='1' width='733px'>";
echo"<tr ><th>Educational Qualification</th><th>Year</th><th>Board/University</th><th>CGPA/%</th></tr>";
echo"<tr><td> $class $saal$y year $semester$s semester   </td> <td>2015 </td><td >$college</td><td>64.5</td></tr>";
echo"<tr><td>Intermediate (10+2)</td><td>  2012 </td><td>RBSE</td><td>64</td></tr>";
echo"<tr><td> High School (10)</td><td>2010 </td><td>RBSE</td><td>78</td></tr>";
*/
/*echo"<ul id='demo9'>";
echo"<li style='font-size:15px;'>  </li>";
echo"</ul>";*/
$count=0;
$d=100;
?>

		<!--------    Educational Qualification-->	
<div id="cut">
<table   border="1" width="728px" style="margin-top:135px; margin-left:2px;">
<tr>  <th>Educational Qualification</th>
<th> Year</th><th>Board/University</th><th> CGPA/%</th>
</tr>

					<tbody>
					<?php foreach($Qualification as $a => $b){ $count++;?>
						<tr>
							<p>
								
								<td >
									
									<?php echo $Qualification[$a]; ?>
								</td>
								<td>
									
									<?php echo $year[$a]; ?>
								</td>
								<td>
									
									<?php echo $Board[$a]; ?> 
								</td>
								<td>
									
									<?php echo $CGPA[$a]; ?>
								</td>
							</p>
						</tr>
					<?php } ?>
					</tbody>
                </table></div>
						<!-- project or Internships > -->
		              <?php    $d=166+25*$count;   echo "<script> document.getElementById('pro').style.marginTop='$d'; </script>" ;  $count2=0; ?> 
				<!--------------------------------------------------------------------------------------------------------->
				<div id="tab2" >


				<?php echo"<ul style='top:700px; '  border='0' width='733px'>";
$space=": ";

					
				 foreach($Project as $h => $b){$count2++;
				 echo '<li>' .$Project[$h].$space.$Details[$h].  '</li>';	
				
		
					}
				
                echo"</ul>";
				?>
		<?php    $d=26+$count+2*$count2+$count*1-$count2;echo "<script> document.getElementById('tab2').style.marginTop='$d'; </script>" ; $count1=0; ?> 
				

				
				
				
				
				
				
				
			<?php     $d=168+25*$count+22+25*$count2;echo "<script> document.getElementById('demo8').style.marginTop='$d'; </script>" ;  ?> 
				      <?php $count=0;?>
				
				<!-- Technical_exploser-->
				
<div id="tab1" >

<?php echo"<ul style='top:700px; '  border='0' width='733px'>";
$space=": ";

					
				 foreach($Skills_Name as $p => $b){$count++;
				 echo '<li>' .$Skills_Name[$p].$space.$Skills[$p].  '</li>';	
				
		
					}
				
                echo"</ul>";
				?>
				
				
				
				
		<?php    $d=-6;echo "<script> document.getElementById('tab1').style.marginTop='$d'; </script>" ; $count1=0; ?> 
				
				<!--<div id="colo"  >
				<table     border="0" width="733px">
<tbody  >
					<?php foreach($Skills_Name as $p => $b){ $count++;?>
						<tr>
							<p>
								
								<td style="font-weight:bold;font-family:calibri;padding-left:20px;">
							
								
							<?php echo"$Skills_Name[$p]"; ?>
								</td>
								<td>
									
									<?php echo"$Skills[$p]"; ?>
								</td>
								
								
							</p>
						</tr>
					<?php } ?>
					</tbody>
                </table>
				</div>
				-->
				
				
				
				
				
				</div>

				
				
				
				<!--------     Hobby-->	

<div id='demo11'>Hobbies</div>

<?php   $count/=2;$d=40+25*$count-25;echo "<script> document.getElementById('demo11').style.marginTop='$d'; </script>" ;  ?> 
<div id="tab" >
<?php   $d=25*$count+45-25; echo "<script> document.getElementById('tab').style.marginTop='$d'; </script>" ; $count1=$d=0; ?> 
<?php echo"<ul style='top:700px; '  border='0' width='733px'>";

					
				 foreach($Hobby as $s => $b){ $count1++;
				 echo '<li>'.$Hobby[$s].'</li>';	
				
		
					}
				
                echo"</ul>";
				?>
				</div>
				
				
		<div id='demo12'>Personal Detail</div>		
			<?php 	
			$c=$count*25;
			$d=65+(25*$count1)+$c-25; echo "<script> document.getElementById('demo12').style.marginTop='$d'; </script>" ;  ?> 
<?php echo "<div id='new' > ";
$c=$count*25;
$d=65+(25*$count1)+$c+25-25;
 echo "<script> document.getElementById('new').style.marginTop='$d'; </script>" ; 
			echo"<table  colspan='1' width='733px'>";
$d="  ";
echo"<tr><td > <div style='font-weight:bold; float:left;'>Father's Name: </div><div style='float:left;'>$d $F_Name  </div> </td> <td> <div style='font-weight:bold;float:left; '>Address:</div> <div> $d $H_No </div></td></tr>";
echo"<tr><td> <div style='font-weight:bold; float:left;'> Date Of Birth: </div><div style='float:left;'> $Day $Month $Birth </div></td><td>  $Place , $District ,$State </td></tr>";
echo"<tr><td><div style='font-weight:bold; float:left;'> Gender: </div>$d $Gender </td><td> <div style='float:left;'>INDIA </div></td></tr>";
echo"<tr><td> <div style='font-weight:bold; float:left;'> Contact: </div>$PN, $SN </td><td> <div style=' float:left;'>PIN: </div>$Pincode </td></tr>";
echo"</div>"

?>
			
			
			
			
				
			
</body>


</html>