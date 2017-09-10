<html>

<head>
<style>
.quarterCircleTopLeft{
     width:200px; 
     height:200px; 
     border:3px solid #000; 
     background: Lime;
     border-radius: 190px 0 0 0;
     border: none;
     color: white;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 20px;
     margin: 4px 2px;
     cursor: pointer;
}
.quarterCircleTopRight{
     width:200px; 
     height:200px; 
     border:3px solid #000; 
     background: Lime;
     border-radius: 0 190px 0 0;
     border: none;
     color: white;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 20px;
     margin: 4px 2px;
     cursor: pointer;
}
.quarterCircleBottomLeft{
     width:200px; 
     height:200px; 
     border:3px solid #000; 
     background: Lime;
     border-radius: 0 0 0 190px;
     border: none;
     color: white;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 20px;
     margin: 4px 2px;
     cursor: pointer;
}
.quarterCircleBottomRight{
     width:200px; 
     height:200px; 
     border:3px solid #000; 
     background: Lime;
     border-radius: 0 0 190px 0;
     border: none;
     color: white;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 20px;
     margin: 2px 2px;
     cursor: pointer;
}

form {
  text-align: center;
}

</style>
</head>

<br>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<input align="middle" type="submit" class="quarterCircleTopLeft" name="quadrant" value="North West"/> 
<input align="middle" type="submit" class="quarterCircleTopRight" name="quadrant" value="North East"/>
<br>
<input align="middle" type="submit" class="quarterCircleBottomLeft" name="quadrant" value="South West"/> 
<input align="middle" type="submit" class="quarterCircleBottomRight" name="quadrant" value="South East"/> 

</form>

<?php

  function GetSpot($input,$blockNW,$blockNE,$blockSW,$blockSE)
{	
	if($input=="North West"){
	$block = $blockNW;
	}
	if($input=="North East"){
	$block = $blockNE;
	}
	if($input=="South West"){
	$block = $blockSW;
	}
	if($input=="South East"){
	$block = $blockSE;
	}
	$spot = array_search(0,$block);
	//$block[$spot] = 1;
	//return $spot,$blockNW,$blockNE,$blockSW,$blockSE;
	//return "Go to $input: Spot $spot.\n";
}


if(isset($_POST['quadrant'])){
$Quad = $_POST['quadrant'];
//$spot,$blockNW,$blockNE,$blockSW,$blockSE = GetSpot($Quad,$blockNW,$blockNE,$blockSW,$blockSE);
echo "<p align='center'> <font color=blue  size='6pt'>";
echo "Go to ";
echo $Quad;
echo " Spot ";
//echo $spot;
echo "</font> </p>";

}

?>

</html>
