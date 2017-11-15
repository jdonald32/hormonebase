<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
<link rel="shortcut icon" href="http://lib.trinity.edu/lib1/hb/favicon.ico">
<link rel="icon" type="image/ico" href="http://lib.trinity.edu/lib1/hb/favicon.ico">
	<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>HormoneBase 2.0</title>

  
  <link rel="stylesheet" href="http://lib.trinity.edu/lib1/hb/stylesheets/app.css" />


	<link rel="stylesheet" href="http://tablesorter.com/docs/css/jq.css" media="print, projection, screen" />
	<link rel="stylesheet" href="http://tablesorter.com/themes/blue/style.css" type="text/css" media="print, projection, screen" /> 
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript" src="http://tablesorter.com/jquery-latest.js"></script>
	<script type="text/javascript" src="http://tablesorter.com/__jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="http://tablesorter.com/addons/pager/jquery.tablesorter.pager.js"></script>

	<script src="excellentexport.js"></script>
     


<script type="text/javascript">

$(document).ready(function() 
    { 
        $("#tablesorter-demo")
		.tablesorter({widthFixed: true, widgets: ['zebra']}); 
    } 
); </script>
	 


</head>

<body style="margin-left:20px;">

<?php 
//set error reporting 

error_reporting (E_ALL ^ E_NOTICE);

$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$dbuser = getenv("databaseuser");
$dbpwd = getenv("databasepassword");
$dbname = getenv("databasename");
$connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
} else {
    printf("");
}
$connection->close();
?>
<br /><br /><img src="images/hormonelogo.jpg" height="100" width="auto" />
   <!--- <img src="images/dummylogo.png" style="margin:-15px;"/>-->
<h3>Use this interface to query, view, and download hormone and life history data. </h3>
<!--<h3><span style="color:red">Dmata unverified: for database testing only!</span></h3>-->
<div style="float:right;padding-right:100px;border:1px black;width:600px;"><strong>Change Log:<br />11/13/2017: Current dataset as of Nov. 13, 2017.</strong><br />
  </div>

<br /><br />
<?php

echo "<form action='".$_SERVER['php_self']."' method='get'>"; ?>
<select name="hormone">
	<option value="" selected>Select a Hormone</option>
  <option value="MT_Mean">MT_Mean</option>
  <option value="FT_Mean">FT_Mean</option>
   <option value="MKT_Mean">MKT_Mean</option>
  <option value="FKT_Mean">FKT_Mean</option>
  <option value="MBC_Mean">MBC_Mean</option>
  <option value="FBC_Mean">FBC_Mean</option>
  <option value="MSC_Mean">MSC_Mean</option>
  <option value="FSC_Mean">FSC_Mean</option>
  <option value="References">References</option>
</select>

 &nbsp;&nbsp;Do you want life history data?
    <input type="checkbox" name="formLifeHistory" value="Yes" />
   
<input type="submit" value=" Go "/>
</form>

<?php 

$hormone = $_GET['hormone'];
if(isset($hormone)){
echo "<h1> Data Values for: ".$hormone."</h1>";}
else {
echo "Please make a selection to view data.";}




//echo "<form action='".$_SERVER['php_self']."' method='post'>"; ?>


<?php 

$formLifeHistory = $_GET['formLifeHistory'];
if(isset($formLifeHistory)){
echo "<h1>Includes Life History data</h1>";

}
else {
echo "Does not include Life History data<br />";}

$lifehistory_header="
<th>LH_Pop_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LHforPop&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>BodySizePop&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>RefList&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Habitat&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>ReproMode&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>EggBirthMass&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LitterClutchSize&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LitterClutchYear&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LongevityMax&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>AveLifeExpect&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MTimeMatur&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FTimeMatur&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>BodymassM&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>BodymassF&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>BodyMassSpecies&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Parental_M&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Parental_F&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Migration&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MatngSyst&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Incubation&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Gestation&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>WeanFledgeDay&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>WeanFledgeMass&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>ReproInterval&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>RepSesonal&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>SeasonLngth&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Survival&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>BMR&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>RMR&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>EggDiameter&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>SocialBreed&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>SocialNonbreed&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>SocialNotes&nbsp;&nbsp;&nbsp;&nbsp;</th>
";



$lifehistory_query = ",`lifehistory`.`Pop_ID`,`lifehistory`.`LHforPop`,`lifehistory`.`BodySizePop`,`lifehistory`.`RefList`,`lifehistory`.`Habitat`,`lifehistory`.`ReproMode`,`lifehistory`.`EggBirthMass`,`lifehistory`.`LitterClutchSize`,`lifehistory`.`LitterClutchYear`,`lifehistory`.`LongevityMax`,`lifehistory`.`AveLifeExpect`, `lifehistory`.`MTimeMatur`,`lifehistory`.`FTimeMatur`,`lifehistory`.`BodymassM`,`lifehistory`.`BodymassF`,`lifehistory`.`BodyMassSpecies`,`lifehistory`.`Parental_M`,`lifehistory`.`Parental_F`,`lifehistory`.`Migration`,`lifehistory`.`MatngSyst`,`lifehistory`.`Incubation`,`lifehistory`.`Gestation`,`lifehistory`.`WeanFledgeDay`,`lifehistory`.`WeanFledgeMass`,`lifehistory`.`ReproInterval`,`lifehistory`.`RepSesonal`,`lifehistory`.`SeasonLngth`,`lifehistory`.`Survival`,`lifehistory`.`BMR`,`lifehistory`.`RMR`,`lifehistory`.`EggDiameter`,`lifehistory`.`SocialBreed`, `lifehistory`.`SocialNonbreed`,`lifehistory`.`SocialNotes`";

///start building the 8 hormone queries
	/////query for male T

$query_MT = "Select `species`.`Species_ID`,  `species`.`Vert_Group`, `species`.`Genus`, `species`.`Species`, `species`.`Common_name`, 
`hormone`.`Hormone_ID`, `hormone`.`Ref_ID`, `references`.`First_Author`, `references`.`YearPblished`, 
`hormone`.`Population_1`, `hormone`.`Population_2`, `hormone`.`Population_3`, `hormone`.`Pop_ID`, `hormone`.`Latitude`, `hormone`.`Longitud`, `hormone`.`LatLongEstim`, `hormone`.`Elevation`, `hormone`.`Years`, `hormone`.`Year_1`, `hormone`.`Year_final`, `hormone`.`Breeding_Cycle`, `hormone`.`Molt`, `hormone`.`Life_Stage`, `hormone`.`LifeHistConf`, `hormone`.`January`, `hormone`.`February`, `hormone`.`March`, `hormone`.`April`, `hormone`.`May`, `hormone`.`June`, `hormone`.`July`, `hormone`.`August`, `hormone`.`September`, `hormone`.`October`, `hormone`.`November`, `hormone`.`December`, `hormone`.`OthrHormones`, `hormone`.`Time_min`, `hormone`.`Time_max`, `hormone`.`CapturMethod`, `hormone`.`SampleMethod`, `hormone`.`MaxLatency_T`, `hormone`.`MajorStrsPop`, `hormone`.`Method`, `hormone`.`T_AntibdyKit`,`hormone`.`Units`, `hormone`.`MT_Mean`, `hormone`.`MT_SE`, `hormone`.`MT_CV`, `hormone`.`MT_N`, `hormone`.`MT_Min`, `hormone`.`MT_Max`, `hormone`.`MTOrigData`, `hormone`.`MTRmovOtlier`, `hormone`.`MTLnksConfnd`, `hormone`.`OtlierCrtria`, `hormone`.`Notes`, `hormone`.`LinkPhnotype`, `hormone`.`LinkFitness`, `hormone`.`IndvidRepeat`, `hormone`.`Scatterplot`, `hormone`.`LabPI`";

$query_MT_tail = "

FROM `hormone`
LEFT JOIN `species`
ON `hormone`.`Species_ID` = `species`.`Species_ID`

LEFT JOIN `references`
ON 
`references`.`Ref_ID`= `hormone`.`Ref_ID` 

LEFT JOIN `lifehistory`
ON 
`lifehistory`.`Pop_ID`=`hormone`.`Pop_ID` 
WHERE 
`hormone`.`MT_Mean` != 'null'
ORDER BY `hormone`.`Hormone_ID`";

if(isset($formLifeHistory)){
$query_MT = $query_MT.$lifehistory_query.$query_MT_tail;

}
else {$query_MT = $query_MT.$query_MT_tail;
}

$head1 = "<th>Species_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Vert_Group&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Genus&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Species&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Common_name&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Hormone_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref1stAuthor&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>YrPub&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_2&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_3&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Pop_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Latitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Longitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LatLongEstim&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Elevation&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Years&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_final&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Breeding_Cycle&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Molt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Life_Stage&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LifeHistConf&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>January&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>February&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>March&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>April&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>May&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>June&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>July&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>August&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>September&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>October&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>November&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>December&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>OthrHormones&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_max&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Capture_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Sample_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MaxLatency_T&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MajorStrsPop&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>T_AntibdyKit&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Units&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MT_Mean&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MT_SE&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MT_CV&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MT_N&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MT_Min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MT_Max&nbsp;&nbsp;&nbsp;&nbsp;</th>


<th>MTOrigData&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MTRmovOtlier&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MTLnksConfnd&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>OtlierCrtria&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Notes&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkPhnotype&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkFitness&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>IndvidRepeat&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Scatterplot&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LabPI&nbsp;&nbsp;&nbsp;&nbsp;</th>";

if(isset($formLifeHistory)){
$head1 = $head1.$lifehistory_header;

}

///set up the select to get the selected hormone

if($hormone=="MT_Mean"){
$sql = $query_MT;
$cat = "group1";
}
/*else if
($hormone=="FT_Mean"){
$sql = $query2;
$cat = "group1";}
else if
($hormone=="MBC_Mean"){
$sql = $query3;
$cat = "group1";}
else if
($hormone=="FBC_Mean"){
$sql = $query4;
$cat = "group1";}*/

if($cat =="group1") {
	
	
$result = mysqli_query($con, $sql)or die(mysql_error());
if($hormone=="MT_Mean" && !isset($formLifeHistory)){
	echo ' <button><a href="MT_Mean.xlsx">Export to xls</a></button>';
}
if($hormone=="MT_Mean" && isset($formLifeHistory)){
	echo ' <button><a href="MT_Mean_LH.xlsx">Export to xls</a></button>';
}
echo ' <div id="table_wrapper"><table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1"><thead><tr>';
if($hormone=="MT_Mean"){
$head = $head1;}
/*else if
($hormone=="FT_Mean"){
$head = $head2;}
else if
($hormone=="MBC_Mean"){
$head = $head3;}
else if
($hormone=="FBC_Mean"){
$head = $head4;}*/
echo $head."</tr></thead><tbody>";

while ($row = $result->fetch_assoc()){
$Species_ID = $row["Species_ID"];
$Vert_Group = $row["Vert_Group"];
$Genus = $row["Genus"];
$Species = $row["Species"];
$Common_name = $row["Common_name"];
$Hormone_ID = $row["Hormone_ID"];
$Ref_ID = $row["Ref_ID"];
$First_Author = $row["First_Author"];
$YearPblished = $row["YearPblished"];
$Population_1 = $row["Population_1"];
$Population_2 = $row["Population_2"];
$Population_3 = $row["Population_3"];
$Pop_ID = $row["Pop_ID"];
$Latitude = $row["Latitude"];
$Longitude = $row["Longitud"];
$LatLongEstim = $row["LatLongEstim"];
$Elevation = $row["Elevation"];
$Years = $row["Years"];
$Year_1 = $row["Year_1"];
$Year_final = $row["Year_final"];

$Breeding_Cycle = $row["Breeding_Cycle"];
$Molt = $row["Molt"];
$Life_Stage = $row["Life_Stage"];
$LifeHistConf = $row["LifeHistConf"];

$January = $row["January"];
$February = $row["February"];
$March = $row["March"];
$April = $row["April"];
$May = $row["May"];
$June = $row["June"];
$July = $row["July"];
$August = $row["August"];
$September = $row["September"];
$October = $row["October"];
$November = $row["November"];
$December = $row["December"];
$OthrHormones = $row["OthrHormones"];
$Time_min = $row["Time_min"];
$Time_max = $row["Time_max"];


$CapturMethod = $row["CapturMethod"];
$SampleMethod = $row["SampleMethod"];
$MaxLatency_T = $row["MaxLatency_T"];
$MajorStrsPop =$row["MajorStrsPop"];

$Method = $row["Method"];
$T_AntibdyKit = $row["T_AntibdyKit"];
$Units = $row["Units"];

$MT_Mean = $row["MT_Mean"];
$MT_SE = $row["MT_SE"];
$MT_CV = $row["MT_CV"];
$MT_N = $row["MT_N"];
$MT_Min = $row["MT_Min"];
$MT_Max = $row["MT_Max"];


$MTOrigData = $row["MTOrigData"];
$MTRmovOtlier = $row["MTRmovOtlier"];
$MTLnksConfnd = $row["MTLnksConfnd"];
$OtlierCrtria = $row["OtlierCrtria"];
$Notes = $row["Notes"];
$LinkPhnotype = $row["LinkPhnotype"];
$LinkFitness = $row["LinkFitness"];
$IndvidRepeat = $row["IndvidRepeat"];
$Scatterplot = $row["Scatterplot"];
$LabPI= $row["LabPI"]; 

$LH_Pop_ID= $row["Pop_ID"];
$LHforPop=$row["LHforPop"]; 
$BodySizePop=$row["BodySizePop"]; 
$RefList=$row["RefList"]; 
$Habitat=$row["Habitat"]; 
$ReproMode=$row["ReproMode"]; 
$EggBirthMass=$row["EggBirthMass"]; 
$LitterClutchSize=$row["LitterClutchSize"]; 
$LitterClutchYear=$row["LitterClutchYear"]; 
$LongevityMax=$row["LongevityMax"]; 
$AveLifeExpect=$row["AveLifeExpect"]; 
$MTimeMatur=$row["MTimeMatur"]; 
$FTimeMatur=$row["FTimeMatur"]; 
$BodymassM=$row["BodymassM"]; 
$BodymassF=$row["BodymassF"]; 
$BodyMassSpecies=$row["BodyMassSpecies"]; 
$Parental_M=$row["Parental_M"]; 
$Parental_F=$row["Parental_F"]; 
$Migration=$row["Migration"]; 
$MatngSyst=$row["MatngSyst"]; 
$Incubation=$row["Incubation"]; 
$Gestation=$row["Gestation"]; 
$WeanFledgeDay=$row["WeanFledgeDay"]; 
$WeanFledgeMass=$row["WeanFledgeMass"]; 
$ReproInterval=$row["ReproInterval"]; 
$RepSesonal=$row["RepSesonal"]; 
$SeasonLngth=$row["SeasonLngth"]; 
$Survival=$row["Survival"]; 
$BMR=$row["BMR"];
$RMR=$row["RMR"];
$EggDiameter=$row["EggDiameter"];
$SocialBreed=$row["SocialBreed"];
$SocialNonbreed=$row["SocialNonbreed"];
$SocialNotes=$row["SocialNotes"];
    


 echo "<td>".$Species_ID."</td>
<td>".$Vert_Group."</td>
<td>".$Genus."</td>
<td>".$Species."</td>
<td>".$Common_name."</td>
<td>".$Hormone_ID."</td>
<td>".$Ref_ID."</td>
<td>".$First_Author."</td>
<td>".$YearPblished."</td>
<td>".$Population_1."</td>
<td>".$Population_2."</td>
<td>".$Population_3."</td>
<td>".$Pop_ID."</td>
<td>".$Latitude."</td>
<td>".$Longitude."</td>
<td>".$LatLongEstim."</td>
<td>".$Elevation."</td>
<td>".$Years."</td>
<td>".$Year_1."</td>
<td>".$Year_final."</td>

<td>".$Breeding_Cycle."</td>
<td>".$Molt."</td>

<td>".$Life_Stage."</td>
<td>".$LifeHistConf."</td>
<td>".$January."</td>
<td>".$February."</td>
<td>".$March."</td>
<td>".$April."</td>
<td>".$May."</td>
<td>".$June."</td>
<td>".$July."</td>
<td>".$August."</td>
<td>".$September."</td>
<td>".$October."</td>
<td>".$November."</td>
<td>".$December."</td>
<td>".$OthrHormones."</td>
<td>".$Time_min."</td>
<td>".$Time_max."</td>

<td>".$CapturMethod."</td>
<td>".$SampleMethod."</td>
<td>".$MaxLatency_T."</td>
<td>".$MajorStrsPop."</td>
<td>".$Method."</td>
<td>".$T_AntibdyKit."</td>

<td>".$Units."</td>

<td>".$MT_Mean."</td>
<td>".$MT_SE."</td>
<td>".$MT_CV."</td>
<td>".$MT_N."</td>
<td>".$MT_Min."</td>
<td>".$MT_Max."</td>


<td>".$MTOrigData."</td>
<td>".$MTRmovOtlier."</td>
<td>".$MTLnksConfnd."</td>
<td>".$OtlierCrtria."</td>
<td>".$Notes."</td>
<td>".$LinkPhnotype."</td>
<td>".$LinkFitness."</td>
<td>".$IndvidRepeat."</td>
<td>".$Scatterplot."</td>
<td>".$LabPI."</td>";

if(isset($formLifeHistory)){
echo	

"<td>".$LH_Pop_ID."</td>
<td>".$LHforPop."</td>
<td>".$BodySizePop."</td>
<td>".$RefList."</td>
<td>".$Habitat."</td>
<td>".$ReproMode."</td>
<td>".$EggBirthMass."</td>
<td>".$LitterClutchSize."</td>
<td>".$LitterClutchYear."</td>

<td>".$LongevityMax."</td>
<td>".$AveLifeExpect."</td>
<td>".$MTimeMatur."</td>
<td>".$FTimeMatur."</td>
<td>".$BodymassM."</td>
<td>".$BodymassF."</td>
<td>".$BodyMassSpecies."</td>
<td>".$Parental_M."</td>
<td>".$Parental_F."</td>
<td>".$Migration."</td>
<td>".$MatngSyst."</td>
<td>".$Incubation."</td>
<td>".$Gestation."</td>
<td>".$WeanFledgeDay."</td>
<td>".$WeanFledgeMass."</td>
<td>".$ReproInterval."</td>
<td>".$RepSesonal."</td>
<td>".$SeasonLngth."</td>
<td>".$Survival."</td>
<td>".$BMR."</td>
<td>".$RMR."</td>
<td>".$EggDiameter."</td>
<td>".$SocialBreed."</td>
<td>".$SocialNonbreed."</td>
<td>".$SocialNotes."</td>
";
}
echo
"</tr>";


} echo '</tbody></table>
</div>';

}

//query for female T


$query_FT = "Select `species`.`Species_ID`,  `species`.`Vert_Group`, `species`.`Genus`, `species`.`Species`, `species`.`Common_name`, 
`hormone`.`Hormone_ID`, `hormone`.`Ref_ID`, `references`.`First_Author`, `references`.`YearPblished`, 
`hormone`.`Population_1`, `hormone`.`Population_2`, `hormone`.`Population_3`, `hormone`.`Pop_ID`, `hormone`.`Latitude`, `hormone`.`Longitud`, `hormone`.`LatLongEstim`, `hormone`.`Elevation`, `hormone`.`Years`, `hormone`.`Year_1`, `hormone`.`Year_final`, `hormone`.`Breeding_Cycle`, `hormone`.`Molt`, `hormone`.`Life_Stage`, `hormone`.`LifeHistConf`, `hormone`.`January`, `hormone`.`February`, `hormone`.`March`, `hormone`.`April`, `hormone`.`May`, `hormone`.`June`, `hormone`.`July`, `hormone`.`August`, `hormone`.`September`, `hormone`.`October`, `hormone`.`November`, `hormone`.`December`, `hormone`.`OthrHormones`, `hormone`.`Time_min`, `hormone`.`Time_max`, `hormone`.`CapturMethod`, `hormone`.`SampleMethod`, `hormone`.`MaxLatency_T`, `hormone`.`MajorStrsPop`, `hormone`.`Method`, `hormone`.`T_AntibdyKit`,`hormone`.`Units`, `hormone`.`FT_Mean`, `hormone`.`FT_SE`,`hormone`.`FT_CV`, `hormone`.`FT_N`, `hormone`.`FT_Min`, `hormone`.`FT_Max`, `hormone`.`FTOrigData`, `hormone`.`FTRmovOtlier`, `hormone`.`FTLnksConfnd`, `hormone`.`OtlierCrtria`, `hormone`.`Notes`, `hormone`.`LinkPhnotype`, `hormone`.`LinkFitness`, `hormone`.`IndvidRepeat`, `hormone`.`Scatterplot`, `hormone`.`LabPI`";

$query_FT_tail = "

FROM `hormone`
LEFT JOIN `species`
ON `hormone`.`Species_ID` = `species`.`Species_ID`

LEFT JOIN `references`
ON 
`references`.`Ref_ID`= `hormone`.`Ref_ID` 

LEFT JOIN `lifehistory`
ON 
`lifehistory`.`Pop_ID`=`hormone`.`Pop_ID` 
WHERE 
`hormone`.`FT_Mean` != 'null'
ORDER BY `hormone`.`Hormone_ID`";

if(isset($formLifeHistory)){
$query_FT = $query_FT.$lifehistory_query.$query_FT_tail;

}
else {$query_FT = $query_FT.$query_FT_tail;
}

$head2 = "<th>Species_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Vert_Group&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Genus&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Species&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Common_name&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Hormone_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref1stAuthor&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>YrPub&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_2&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_3&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Pop_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Latitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Longitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LatLongEstim&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Elevation&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Years&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_final&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Breeding_Cycle&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Molt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Life_Stage&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LifeHistConf&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>January&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>February&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>March&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>April&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>May&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>June&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>July&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>August&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>September&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>October&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>November&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>December&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>OthrHormones&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_max&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Capture_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Sample_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MaxLatency_T&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MajorStrsPop&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>T_AntibdyKit&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Units&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FT_Mean&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FT_SE&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FT_CV&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FT_N&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FT_Min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FT_Max&nbsp;&nbsp;&nbsp;&nbsp;</th>


<th>FTOrigData&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FTRmovOtlier&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FTLnksConfnd&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>OtlierCrtria&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Notes&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkPhnotype&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkFitness&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>IndvidRepeat&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Scatterplot&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LabPI&nbsp;&nbsp;&nbsp;&nbsp;</th>";

if(isset($formLifeHistory)){
$head2 = $head2.$lifehistory_header;

}

///set up the select to get the selected hormone

if($hormone=="FT_Mean"){
$sql = $query_FT;
$cat = "group2";
}
/*else if
($hormone=="FT_Mean"){
$sql = $query2;
$cat = "group1";}
else if
($hormone=="MBC_Mean"){
$sql = $query3;
$cat = "group1";}
else if
($hormone=="FBC_Mean"){
$sql = $query4;
$cat = "group1";}*/

if($cat =="group2") {
	
	
$result = mysqli_query($con, $sql)or die(mysql_error());

echo ' <button id="btnExport">Export to xls</button><div id="table_wrapper"><table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1"><thead><tr>';
if($hormone=="FT_Mean"){
$head = $head2;}
/*else if
($hormone=="FT_Mean"){
$head = $head2;}
else if
($hormone=="MBC_Mean"){
$head = $head3;}
else if
($hormone=="FBC_Mean"){
$head = $head4;}*/
echo $head."</tr></thead><tbody>";

while ($row = $result->fetch_assoc()){
$Species_ID = $row["Species_ID"];
$Vert_Group = $row["Vert_Group"];
$Genus = $row["Genus"];
$Species = $row["Species"];
$Common_name = $row["Common_name"];
$Hormone_ID = $row["Hormone_ID"];
$Ref_ID = $row["Ref_ID"];
$First_Author = $row["First_Author"];
$YearPblished = $row["YearPblished"];
$Population_1 = $row["Population_1"];
$Population_2 = $row["Population_2"];
$Population_3 = $row["Population_3"];
$Pop_ID = $row["Pop_ID"];
$Latitude = $row["Latitude"];
$Longitude = $row["Longitud"];
$LatLongEstim = $row["LatLongEstim"];
$Elevation = $row["Elevation"];
$Years = $row["Years"];
$Year_1 = $row["Year_1"];
$Year_final = $row["Year_final"];

$Breeding_Cycle = $row["Breeding_Cycle"];
$Molt = $row["Molt"];
$Life_Stage = $row["Life_Stage"];
$LifeHistConf = $row["LifeHistConf"];

$January = $row["January"];
$February = $row["February"];
$March = $row["March"];
$April = $row["April"];
$May = $row["May"];
$June = $row["June"];
$July = $row["July"];
$August = $row["August"];
$September = $row["September"];
$October = $row["October"];
$November = $row["November"];
$December = $row["December"];
$OthrHormones = $row["OthrHormones"];
$Time_min = $row["Time_min"];
$Time_max = $row["Time_max"];


$CapturMethod = $row["CapturMethod"];
$SampleMethod = $row["SampleMethod"];
$MaxLatency_T = $row["MaxLatency_T"];
$MajorStrsPop =$row["MajorStrsPop"];

$Method = $row["Method"];
$T_AntibdyKit = $row["T_AntibdyKit"];
$Units = $row["Units"];

$FT_Mean = $row["FT_Mean"];
$FT_SE = $row["FT_SE"];
$FT_CV = $row["FT_CV"];
$FT_N = $row["FT_N"];
$FT_Min = $row["FT_Min"];
$FT_Max = $row["FT_Max"];


$FTOrigData = $row["FTOrigData"];
$FTRmovOtlier = $row["FTRmovOtlier"];
$FTLnksConfnd = $row["FTLnksConfnd"];
$OtlierCrtria = $row["OtlierCrtria"];
$Notes = $row["Notes"];
$LinkPhnotype = $row["LinkPhnotype"];
$LinkFitness = $row["LinkFitness"];
$IndvidRepeat = $row["IndvidRepeat"];
$Scatterplot = $row["Scatterplot"];
$LabPI= $row["LabPI"]; 

$LH_Pop_ID= $row["Pop_ID"];
$LHforPop=$row["LHforPop"]; 
$BodySizePop=$row["BodySizePop"]; 
$RefList=$row["RefList"]; 
$Habitat=$row["Habitat"]; 
$ReproMode=$row["ReproMode"]; 
$EggBirthMass=$row["EggBirthMass"]; 
$LitterClutchSize=$row["LitterClutchSize"]; 
$LitterClutchYear=$row["LitterClutchYear"]; 
$LongevityMax=$row["LongevityMax"]; 
$AveLifeExpect=$row["AveLifeExpect"]; 
$MTimeMatur=$row["MTimeMatur"]; 
$FTimeMatur=$row["FTimeMatur"]; 
$BodymassM=$row["BodymassM"]; 
$BodymassF=$row["BodymassF"]; 
$BodyMassSpecies=$row["BodyMassSpecies"]; 
$Parental_M=$row["Parental_M"]; 
$Parental_F=$row["Parental_F"]; 
$Migration=$row["Migration"]; 
$MatngSyst=$row["MatngSyst"]; 
$Incubation=$row["Incubation"]; 
$Gestation=$row["Gestation"]; 
$WeanFledgeDay=$row["WeanFledgeDay"]; 
$WeanFledgeMass=$row["WeanFledgeMass"]; 
$ReproInterval=$row["ReproInterval"]; 
$RepSesonal=$row["RepSesonal"]; 
$SeasonLngth=$row["SeasonLngth"]; 
$Survival=$row["Survival"]; 
$BMR=$row["BMR"];
$RMR=$row["RMR"];
$EggDiameter=$row["EggDiameter"];
$SocialBreed=$row["SocialBreed"];
$SocialNonbreed=$row["SocialNonbreed"];
$SocialNotes=$row["SocialNotes"];


 echo "<td>".$Species_ID."</td>
<td>".$Vert_Group."</td>
<td>".$Genus."</td>
<td>".$Species."</td>
<td>".$Common_name."</td>
<td>".$Hormone_ID."</td>
<td>".$Ref_ID."</td>
<td>".$First_Author."</td>
<td>".$YearPblished."</td>
<td>".$Population_1."</td>
<td>".$Population_2."</td>
<td>".$Population_3."</td>
<td>".$Pop_ID."</td>
<td>".$Latitude."</td>
<td>".$Longitude."</td>
<td>".$LatLongEstim."</td>
<td>".$Elevation."</td>
<td>".$Years."</td>
<td>".$Year_1."</td>
<td>".$Year_final."</td>

<td>".$Breeding_Cycle."</td>
<td>".$Molt."</td>

<td>".$Life_Stage."</td>
<td>".$LifeHistConf."</td>
<td>".$January."</td>
<td>".$February."</td>
<td>".$March."</td>
<td>".$April."</td>
<td>".$May."</td>
<td>".$June."</td>
<td>".$July."</td>
<td>".$August."</td>
<td>".$September."</td>
<td>".$October."</td>
<td>".$November."</td>
<td>".$December."</td>
<td>".$OthrHormones."</td>
<td>".$Time_min."</td>
<td>".$Time_max."</td>

<td>".$CapturMethod."</td>
<td>".$SampleMethod."</td>
<td>".$MaxLatency_T."</td>
<td>".$MajorStrsPop."</td>
<td>".$Method."</td>
<td>".$T_AntibdyKit."</td>

<td>".$Units."</td>

<td>".$FT_Mean."</td>
<td>".$FT_SE."</td>
<td>".$FT_CV."</td>
<td>".$FT_N."</td>
<td>".$FT_Min."</td>
<td>".$FT_Max."</td>


<td>".$FTOrigData."</td>
<td>".$FTRmovOtlier."</td>
<td>".$FTLnksConfnd."</td>
<td>".$OtlierCrtria."</td>
<td>".$Notes."</td>
<td>".$LinkPhnotype."</td>
<td>".$LinkFitness."</td>
<td>".$IndvidRepeat."</td>
<td>".$Scatterplot."</td>
<td>".$LabPI."</td>";

if(isset($formLifeHistory)){
echo	

"<td>".$LH_Pop_ID."</td>
<td>".$LHforPop."</td>
<td>".$BodySizePop."</td>
<td>".$RefList."</td>
<td>".$Habitat."</td>
<td>".$ReproMode."</td>
<td>".$EggBirthMass."</td>
<td>".$LitterClutchSize."</td>
<td>".$LitterClutchYear."</td>

<td>".$LongevityMax."</td>
<td>".$AveLifeExpect."</td>
<td>".$MTimeMatur."</td>
<td>".$FTimeMatur."</td>
<td>".$BodymassM."</td>
<td>".$BodymassF."</td>
<td>".$BodyMassSpecies."</td>
<td>".$Parental_M."</td>
<td>".$Parental_F."</td>
<td>".$Migration."</td>
<td>".$MatngSyst."</td>
<td>".$Incubation."</td>
<td>".$Gestation."</td>
<td>".$WeanFledgeDay."</td>
<td>".$WeanFledgeMass."</td>
<td>".$ReproInterval."</td>
<td>".$RepSesonal."</td>
<td>".$SeasonLngth."</td>
<td>".$Survival."</td>
<td>".$BMR."</td>
<td>".$RMR."</td>
<td>".$EggDiameter."</td>
<td>".$SocialBreed."</td>
<td>".$SocialNonbreed."</td>
<td>".$SocialNotes."</td>
";
}
echo
"</tr>";


} echo '</tbody></table>
</div>';
}


//query for male KT


$query_MKT = "Select `species`.`Species_ID`,  `species`.`Vert_Group`, `species`.`Genus`, `species`.`Species`, `species`.`Common_name`, 
`hormone`.`Hormone_ID`, `hormone`.`Ref_ID`, `references`.`First_Author`, `references`.`YearPblished`, 
`hormone`.`Population_1`, `hormone`.`Population_2`, `hormone`.`Population_3`, `hormone`.`Pop_ID`, `hormone`.`Latitude`, `hormone`.`Longitud`, `hormone`.`LatLongEstim`, `hormone`.`Elevation`, `hormone`.`Years`, `hormone`.`Year_1`, `hormone`.`Year_final`, `hormone`.`Breeding_Cycle`, `hormone`.`Molt`, `hormone`.`Life_Stage`, `hormone`.`LifeHistConf`, `hormone`.`January`, `hormone`.`February`, `hormone`.`March`, `hormone`.`April`, `hormone`.`May`, `hormone`.`June`, `hormone`.`July`, `hormone`.`August`, `hormone`.`September`, `hormone`.`October`, `hormone`.`November`, `hormone`.`December`, `hormone`.`OthrHormones`, `hormone`.`Time_min`, `hormone`.`Time_max`, `hormone`.`CapturMethod`, `hormone`.`SampleMethod`, `hormone`.`MaxLatency_T`, `hormone`.`MajorStrsPop`, `hormone`.`Method`, `hormone`.`T_AntibdyKit`,`hormone`.`Units`, `hormone`.`MKT_Mean`, `hormone`.`MKT_SE`, `hormone`.`MKT_CV`,`hormone`.`MKT_N`, `hormone`.`MKT_Min`, `hormone`.`MKT_Max`, `hormone`.`MKTOrigData`, `hormone`.`MKTRmovOtlier`, `hormone`.`MKTLnksConfnd`, `hormone`.`OtlierCrtria`, `hormone`.`Notes`, `hormone`.`LinkPhnotype`, `hormone`.`LinkFitness`, `hormone`.`IndvidRepeat`, `hormone`.`Scatterplot`, `hormone`.`LabPI`";

$query_MKT_tail = "

FROM `hormone`
LEFT JOIN `species`
ON `hormone`.`Species_ID` = `species`.`Species_ID`

LEFT JOIN `references`
ON 
`references`.`Ref_ID`= `hormone`.`Ref_ID` 

LEFT JOIN `lifehistory`
ON 
`lifehistory`.`Pop_ID`=`hormone`.`Pop_ID` 
WHERE 
`hormone`.`MKT_Mean` != 'null'
ORDER BY `hormone`.`Hormone_ID`";

if(isset($formLifeHistory)){
$query_MKT = $query_MKT.$lifehistory_query.$query_MKT_tail;

}
else {$query_MKT = $query_MKT.$query_MKT_tail;
}

$head3 = "<th>Species_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Vert_Group&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Genus&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Species&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Common_name&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Hormone_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref1stAuthor&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>YrPub&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_2&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_3&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Pop_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Latitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Longitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LatLongEstim&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Elevation&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Years&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_final&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Breeding_Cycle&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Molt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Life_Stage&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LifeHistConf&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>January&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>February&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>March&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>April&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>May&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>June&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>July&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>August&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>September&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>October&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>November&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>December&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>OthrHormones&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_max&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Capture_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Sample_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MaxLatency_T&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MajorStrsPop&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>T_AntibdyKit&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Units&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MKT_Mean&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MKT_SE&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MKT_CV&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MKT_N&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MKT_Min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MKT_Max&nbsp;&nbsp;&nbsp;&nbsp;</th>


<th>MKTOrigData&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MKTRmovOtlier&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MKTLnksConfnd&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>OtlierCrtria&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Notes&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkPhnotype&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkFitness&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>IndvidRepeat&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Scatterplot&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LabPI&nbsp;&nbsp;&nbsp;&nbsp;</th>";

if(isset($formLifeHistory)){
$head3 = $head3.$lifehistory_header;

}

///set up the select to get the selected hormone

if($hormone=="MKT_Mean"){
$sql = $query_MKT;
$cat = "group3";
}
/*else if
($hormone=="FT_Mean"){
$sql = $query2;
$cat = "group1";}
else if
($hormone=="MBC_Mean"){
$sql = $query3;
$cat = "group1";}
else if
($hormone=="FBC_Mean"){
$sql = $query4;
$cat = "group1";}*/

if($cat =="group3") {
	
	
$result = mysqli_query($con, $sql)or die(mysql_error());

echo ' <button id="btnExport">Export to xls</button><div id="table_wrapper"><table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1"><thead><tr>';
if($hormone=="MKT_Mean"){
$head = $head3;}
/*else if
($hormone=="FT_Mean"){
$head = $head2;}
else if
($hormone=="MBC_Mean"){
$head = $head3;}
else if
($hormone=="FBC_Mean"){
$head = $head4;}*/
echo $head."</tr></thead><tbody>";

while ($row = $result->fetch_assoc()){
$Species_ID = $row["Species_ID"];
$Vert_Group = $row["Vert_Group"];
$Genus = $row["Genus"];
$Species = $row["Species"];
$Common_name = $row["Common_name"];
$Hormone_ID = $row["Hormone_ID"];
$Ref_ID = $row["Ref_ID"];
$First_Author = $row["First_Author"];
$YearPblished = $row["YearPblished"];
$Population_1 = $row["Population_1"];
$Population_2 = $row["Population_2"];
$Population_3 = $row["Population_3"];
$Pop_ID = $row["Pop_ID"];
$Latitude = $row["Latitude"];
$Longitude = $row["Longitud"];
$LatLongEstim = $row["LatLongEstim"];
$Elevation = $row["Elevation"];
$Years = $row["Years"];
$Year_1 = $row["Year_1"];
$Year_final = $row["Year_final"];

$Breeding_Cycle = $row["Breeding_Cycle"];
$Molt = $row["Molt"];
$Life_Stage = $row["Life_Stage"];
$LifeHistConf = $row["LifeHistConf"];

$January = $row["January"];
$February = $row["February"];
$March = $row["March"];
$April = $row["April"];
$May = $row["May"];
$June = $row["June"];
$July = $row["July"];
$August = $row["August"];
$September = $row["September"];
$October = $row["October"];
$November = $row["November"];
$December = $row["December"];
$OthrHormones = $row["OthrHormones"];
$Time_min = $row["Time_min"];
$Time_max = $row["Time_max"];


$CapturMethod = $row["CapturMethod"];
$SampleMethod = $row["SampleMethod"];
$MaxLatency_T = $row["MaxLatency_T"];
$MajorStrsPop =$row["MajorStrsPop"];

$Method = $row["Method"];
$T_AntibdyKit = $row["T_AntibdyKit"];
$Units = $row["Units"];

$MKT_Mean = $row["MKT_Mean"];
$MKT_SE = $row["MKT_SE"];
$MKT_CV = $row["MKT_CV"];
$MKT_N = $row["MKT_N"];
$MKT_Min = $row["MKT_Min"];
$MKT_Max = $row["MKT_Max"];


$MKTOrigData = $row["MKTOrigData"];
$MKTRmovOtlier = $row["MKTRmovOtlier"];
$MKTLnksConfnd = $row["MKTLnksConfnd"];
$OtlierCrtria = $row["OtlierCrtria"];
$Notes = $row["Notes"];
$LinkPhnotype = $row["LinkPhnotype"];
$LinkFitness = $row["LinkFitness"];
$IndvidRepeat = $row["IndvidRepeat"];
$Scatterplot = $row["Scatterplot"];
$LabPI= $row["LabPI"]; 

$LH_Pop_ID= $row["Pop_ID"];
$LHforPop=$row["LHforPop"]; 
$BodySizePop=$row["BodySizePop"]; 
$RefList=$row["RefList"]; 
$Habitat=$row["Habitat"]; 
$ReproMode=$row["ReproMode"]; 
$EggBirthMass=$row["EggBirthMass"]; 
$LitterClutchSize=$row["LitterClutchSize"]; 
$LitterClutchYear=$row["LitterClutchYear"]; 
$LongevityMax=$row["LongevityMax"]; 
$AveLifeExpect=$row["AveLifeExpect"]; 
$MTimeMatur=$row["MTimeMatur"]; 
$FTimeMatur=$row["FTimeMatur"]; 
$BodymassM=$row["BodymassM"]; 
$BodymassF=$row["BodymassF"]; 
$BodyMassSpecies=$row["BodyMassSpecies"]; 
$Parental_M=$row["Parental_M"]; 
$Parental_F=$row["Parental_F"]; 
$Migration=$row["Migration"]; 
$MatngSyst=$row["MatngSyst"]; 
$Incubation=$row["Incubation"]; 
$Gestation=$row["Gestation"]; 
$WeanFledgeDay=$row["WeanFledgeDay"]; 
$WeanFledgeMass=$row["WeanFledgeMass"]; 
$ReproInterval=$row["ReproInterval"]; 
$RepSesonal=$row["RepSesonal"]; 
$SeasonLngth=$row["SeasonLngth"]; 
$Survival=$row["Survival"]; 
$BMR=$row["BMR"];
$RMR=$row["RMR"];
$EggDiameter=$row["EggDiameter"];
$SocialBreed=$row["SocialBreed"];
$SocialNonbreed=$row["SocialNonbreed"];
$SocialNotes=$row["SocialNotes"];

 echo "<td>".$Species_ID."</td>
<td>".$Vert_Group."</td>
<td>".$Genus."</td>
<td>".$Species."</td>
<td>".$Common_name."</td>
<td>".$Hormone_ID."</td>
<td>".$Ref_ID."</td>
<td>".$First_Author."</td>
<td>".$YearPblished."</td>
<td>".$Population_1."</td>
<td>".$Population_2."</td>
<td>".$Population_3."</td>
<td>".$Pop_ID."</td>
<td>".$Latitude."</td>
<td>".$Longitude."</td>
<td>".$LatLongEstim."</td>
<td>".$Elevation."</td>
<td>".$Years."</td>
<td>".$Year_1."</td>
<td>".$Year_final."</td>

<td>".$Breeding_Cycle."</td>
<td>".$Molt."</td>

<td>".$Life_Stage."</td>
<td>".$LifeHistConf."</td>
<td>".$January."</td>
<td>".$February."</td>
<td>".$March."</td>
<td>".$April."</td>
<td>".$May."</td>
<td>".$June."</td>
<td>".$July."</td>
<td>".$August."</td>
<td>".$September."</td>
<td>".$October."</td>
<td>".$November."</td>
<td>".$December."</td>
<td>".$OthrHormones."</td>
<td>".$Time_min."</td>
<td>".$Time_max."</td>

<td>".$CapturMethod."</td>
<td>".$SampleMethod."</td>
<td>".$MaxLatency_T."</td>
<td>".$MajorStrsPop."</td>
<td>".$Method."</td>
<td>".$T_AntibdyKit."</td>

<td>".$Units."</td>

<td>".$MKT_Mean."</td>
<td>".$MKT_SE."</td>
<td>".$MKT_CV."</td>
<td>".$MKT_N."</td>
<td>".$MKT_Min."</td>
<td>".$MKT_Max."</td>


<td>".$MKTOrigData."</td>
<td>".$MKTRmovOtlier."</td>
<td>".$MKTLnksConfnd."</td>
<td>".$OtlierCrtria."</td>
<td>".$Notes."</td>
<td>".$LinkPhnotype."</td>
<td>".$LinkFitness."</td>
<td>".$IndvidRepeat."</td>
<td>".$Scatterplot."</td>
<td>".$LabPI."</td>";

if(isset($formLifeHistory)){
echo	

"<td>".$LH_Pop_ID."</td>
<td>".$LHforPop."</td>
<td>".$BodySizePop."</td>
<td>".$RefList."</td>
<td>".$Habitat."</td>
<td>".$ReproMode."</td>
<td>".$EggBirthMass."</td>
<td>".$LitterClutchSize."</td>
<td>".$LitterClutchYear."</td>

<td>".$LongevityMax."</td>
<td>".$AveLifeExpect."</td>
<td>".$MTimeMatur."</td>
<td>".$FTimeMatur."</td>
<td>".$BodymassM."</td>
<td>".$BodymassF."</td>
<td>".$BodyMassSpecies."</td>
<td>".$Parental_M."</td>
<td>".$Parental_F."</td>
<td>".$Migration."</td>
<td>".$MatngSyst."</td>
<td>".$Incubation."</td>
<td>".$Gestation."</td>
<td>".$WeanFledgeDay."</td>
<td>".$WeanFledgeMass."</td>
<td>".$ReproInterval."</td>
<td>".$RepSesonal."</td>
<td>".$SeasonLngth."</td>
<td>".$Survival."</td>
<td>".$BMR."</td>
<td>".$RMR."</td>
<td>".$EggDiameter."</td>
<td>".$SocialBreed."</td>
<td>".$SocialNonbreed."</td>
<td>".$SocialNotes."</td>
";
}
echo
"</tr>";


} echo '</tbody></table>
</div>';
}



//query for female KT


$query_FKT = "Select `species`.`Species_ID`,  `species`.`Vert_Group`, `species`.`Genus`, `species`.`Species`, `species`.`Common_name`, 
`hormone`.`Hormone_ID`, `hormone`.`Ref_ID`, `references`.`First_Author`, `references`.`YearPblished`, 
`hormone`.`Population_1`, `hormone`.`Population_2`, `hormone`.`Population_3`, `hormone`.`Pop_ID`, `hormone`.`Latitude`, `hormone`.`Longitud`, `hormone`.`LatLongEstim`, `hormone`.`Elevation`, `hormone`.`Years`, `hormone`.`Year_1`, `hormone`.`Year_final`, `hormone`.`Breeding_Cycle`, `hormone`.`Molt`, `hormone`.`Life_Stage`, `hormone`.`LifeHistConf`, `hormone`.`January`, `hormone`.`February`, `hormone`.`March`, `hormone`.`April`, `hormone`.`May`, `hormone`.`June`, `hormone`.`July`, `hormone`.`August`, `hormone`.`September`, `hormone`.`October`, `hormone`.`November`, `hormone`.`December`, `hormone`.`OthrHormones`, `hormone`.`Time_min`, `hormone`.`Time_max`, `hormone`.`CapturMethod`, `hormone`.`SampleMethod`, `hormone`.`MaxLatency_T`, `hormone`.`MajorStrsPop`, `hormone`.`Method`, `hormone`.`T_AntibdyKit`,`hormone`.`Units`, `hormone`.`FKT_Mean`, `hormone`.`FKT_SE`, `hormone`.`FKT_CV`,`hormone`.`FKT_N`, `hormone`.`FKT_Min`, `hormone`.`FKT_Max`, `hormone`.`FKTOrigData`, `hormone`.`FKTRmovOtlier`, `hormone`.`FKTLnksConfnd`, `hormone`.`OtlierCrtria`, `hormone`.`Notes`, `hormone`.`LinkPhnotype`, `hormone`.`LinkFitness`, `hormone`.`IndvidRepeat`, `hormone`.`Scatterplot`, `hormone`.`LabPI`";

$query_FKT_tail = "

FROM `hormone`
LEFT JOIN `species`
ON `hormone`.`Species_ID` = `species`.`Species_ID`

LEFT JOIN `references`
ON 
`references`.`Ref_ID`= `hormone`.`Ref_ID` 

LEFT JOIN `lifehistory`
ON 
`lifehistory`.`Pop_ID`=`hormone`.`Pop_ID` 
WHERE 
`hormone`.`FKT_Mean` != 'null'
ORDER BY `hormone`.`Hormone_ID`";

if(isset($formLifeHistory)){
$query_FKT = $query_FKT.$lifehistory_query.$query_FKT_tail;

}
else {$query_FKT = $query_FKT.$query_FKT_tail;
}

$head4 = "<th>Species_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Vert_Group&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Genus&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Species&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Common_name&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Hormone_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref1stAuthor&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>YrPub&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_2&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_3&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Pop_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Latitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Longitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LatLongEstim&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Elevation&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Years&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_final&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Breeding_Cycle&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Molt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Life_Stage&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LifeHistConf&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>January&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>February&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>March&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>April&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>May&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>June&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>July&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>August&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>September&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>October&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>November&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>December&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>OthrHormones&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_max&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Capture_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Sample_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MaxLatency_T&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MajorStrsPop&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>T_AntibdyKit&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Units&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FKT_Mean&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FKT_SE&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FKT_CV&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FKT_N&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FKT_Min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FKT_Max&nbsp;&nbsp;&nbsp;&nbsp;</th>


<th>FKTOrigData&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FKTRmovOtlier&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FKTLnksConfnd&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>OtlierCrtria&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Notes&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkPhnotype&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkFitness&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>IndvidRepeat&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Scatterplot&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LabPI&nbsp;&nbsp;&nbsp;&nbsp;</th>";

if(isset($formLifeHistory)){
$head4 = $head4.$lifehistory_header;

}

///set up the select to get the selected hormone

if($hormone=="FKT_Mean"){
$sql = $query_FKT;
$cat = "group4";
}
/*else if
($hormone=="FT_Mean"){
$sql = $query2;
$cat = "group1";}
else if
($hormone=="MBC_Mean"){
$sql = $query3;
$cat = "group1";}
else if
($hormone=="FBC_Mean"){
$sql = $query4;
$cat = "group1";}*/

if($cat =="group4") {
	
	
$result = mysqli_query($con, $sql)or die(mysql_error());

echo ' <button id="btnExport">Export to xls</button><div id="table_wrapper"><table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1"><thead><tr>';
if($hormone=="FKT_Mean"){
$head = $head4;}
/*else if
($hormone=="FT_Mean"){
$head = $head2;}
else if
($hormone=="MBC_Mean"){
$head = $head3;}
else if
($hormone=="FBC_Mean"){
$head = $head4;}*/
echo $head."</tr></thead><tbody>";

while ($row = $result->fetch_assoc()){
$Species_ID = $row["Species_ID"];
$Vert_Group = $row["Vert_Group"];
$Genus = $row["Genus"];
$Species = $row["Species"];
$Common_name = $row["Common_name"];
$Hormone_ID = $row["Hormone_ID"];
$Ref_ID = $row["Ref_ID"];
$First_Author = $row["First_Author"];
$YearPblished = $row["YearPblished"];
$Population_1 = $row["Population_1"];
$Population_2 = $row["Population_2"];
$Population_3 = $row["Population_3"];
$Pop_ID = $row["Pop_ID"];
$Latitude = $row["Latitude"];
$Longitude = $row["Longitud"];
$LatLongEstim = $row["LatLongEstim"];
$Elevation = $row["Elevation"];
$Years = $row["Years"];
$Year_1 = $row["Year_1"];
$Year_final = $row["Year_final"];

$Breeding_Cycle = $row["Breeding_Cycle"];
$Molt = $row["Molt"];
$Life_Stage = $row["Life_Stage"];
$LifeHistConf = $row["LifeHistConf"];

$January = $row["January"];
$February = $row["February"];
$March = $row["March"];
$April = $row["April"];
$May = $row["May"];
$June = $row["June"];
$July = $row["July"];
$August = $row["August"];
$September = $row["September"];
$October = $row["October"];
$November = $row["November"];
$December = $row["December"];
$OthrHormones = $row["OthrHormones"];
$Time_min = $row["Time_min"];
$Time_max = $row["Time_max"];


$CapturMethod = $row["CapturMethod"];
$SampleMethod = $row["SampleMethod"];
$MaxLatency_T = $row["MaxLatency_T"];
$MajorStrsPop =$row["MajorStrsPop"];

$Method = $row["Method"];
$T_AntibdyKit = $row["T_AntibdyKit"];
$Units = $row["Units"];

$FKT_Mean = $row["FKT_Mean"];
$FKT_SE = $row["FKT_SE"];
$FKT_CV = $row["FKT_CV"];
$FKT_N = $row["FKT_N"];
$FKT_Min = $row["FKT_Min"];
$FKT_Max = $row["FKT_Max"];


$FKTOrigData = $row["FKTOrigData"];
$FKTRmovOtlier = $row["FKTRmovOtlier"];
$FKTLnksConfnd = $row["FKTLnksConfnd"];
$OtlierCrtria = $row["OtlierCrtria"];
$Notes = $row["Notes"];
$LinkPhnotype = $row["LinkPhnotype"];
$LinkFitness = $row["LinkFitness"];
$IndvidRepeat = $row["IndvidRepeat"];
$Scatterplot = $row["Scatterplot"];
$LabPI= $row["LabPI"]; 

$LH_Pop_ID= $row["Pop_ID"];
$LHforPop=$row["LHforPop"]; 
$BodySizePop=$row["BodySizePop"]; 
$RefList=$row["RefList"]; 
$Habitat=$row["Habitat"]; 
$ReproMode=$row["ReproMode"]; 
$EggBirthMass=$row["EggBirthMass"]; 
$LitterClutchSize=$row["LitterClutchSize"]; 
$LitterClutchYear=$row["LitterClutchYear"]; 
$LongevityMax=$row["LongevityMax"]; 
$AveLifeExpect=$row["AveLifeExpect"]; 
$MTimeMatur=$row["MTimeMatur"]; 
$FTimeMatur=$row["FTimeMatur"]; 
$BodymassM=$row["BodymassM"]; 
$BodymassF=$row["BodymassF"]; 
$BodyMassSpecies=$row["BodyMassSpecies"]; 
$Parental_M=$row["Parental_M"]; 
$Parental_F=$row["Parental_F"]; 
$Migration=$row["Migration"]; 
$MatngSyst=$row["MatngSyst"]; 
$Incubation=$row["Incubation"]; 
$Gestation=$row["Gestation"]; 
$WeanFledgeDay=$row["WeanFledgeDay"]; 
$WeanFledgeMass=$row["WeanFledgeMass"]; 
$ReproInterval=$row["ReproInterval"]; 
$RepSesonal=$row["RepSesonal"]; 
$SeasonLngth=$row["SeasonLngth"]; 
$Survival=$row["Survival"]; 
$BMR=$row["BMR"];
$RMR=$row["RMR"];
$EggDiameter=$row["EggDiameter"];
$SocialBreed=$row["SocialBreed"];
$SocialNonbreed=$row["SocialNonbreed"];
$SocialNotes=$row["SocialNotes"];


 echo "<td>".$Species_ID."</td>
<td>".$Vert_Group."</td>
<td>".$Genus."</td>
<td>".$Species."</td>
<td>".$Common_name."</td>
<td>".$Hormone_ID."</td>
<td>".$Ref_ID."</td>
<td>".$First_Author."</td>
<td>".$YearPblished."</td>
<td>".$Population_1."</td>
<td>".$Population_2."</td>
<td>".$Population_3."</td>
<td>".$Pop_ID."</td>
<td>".$Latitude."</td>
<td>".$Longitude."</td>
<td>".$LatLongEstim."</td>
<td>".$Elevation."</td>
<td>".$Years."</td>
<td>".$Year_1."</td>
<td>".$Year_final."</td>

<td>".$Breeding_Cycle."</td>
<td>".$Molt."</td>

<td>".$Life_Stage."</td>
<td>".$LifeHistConf."</td>
<td>".$January."</td>
<td>".$February."</td>
<td>".$March."</td>
<td>".$April."</td>
<td>".$May."</td>
<td>".$June."</td>
<td>".$July."</td>
<td>".$August."</td>
<td>".$September."</td>
<td>".$October."</td>
<td>".$November."</td>
<td>".$December."</td>
<td>".$OthrHormones."</td>
<td>".$Time_min."</td>
<td>".$Time_max."</td>

<td>".$CapturMethod."</td>
<td>".$SampleMethod."</td>
<td>".$MaxLatency_T."</td>
<td>".$MajorStrsPop."</td>
<td>".$Method."</td>
<td>".$T_AntibdyKit."</td>

<td>".$Units."</td>

<td>".$FKT_Mean."</td>
<td>".$FKT_SE."</td>
<td>".$FKT_CV."</td>
<td>".$FKT_N."</td>
<td>".$FKT_Min."</td>
<td>".$FKT_Max."</td>


<td>".$FKTOrigData."</td>
<td>".$FKTRmovOtlier."</td>
<td>".$FKTLnksConfnd."</td>
<td>".$OtlierCrtria."</td>
<td>".$Notes."</td>
<td>".$LinkPhnotype."</td>
<td>".$LinkFitness."</td>
<td>".$IndvidRepeat."</td>
<td>".$Scatterplot."</td>
<td>".$LabPI."</td>";

if(isset($formLifeHistory)){
echo	

"<td>".$LH_Pop_ID."</td>
<td>".$LHforPop."</td>
<td>".$BodySizePop."</td>
<td>".$RefList."</td>
<td>".$Habitat."</td>
<td>".$ReproMode."</td>
<td>".$EggBirthMass."</td>
<td>".$LitterClutchSize."</td>
<td>".$LitterClutchYear."</td>

<td>".$LongevityMax."</td>
<td>".$AveLifeExpect."</td>
<td>".$MTimeMatur."</td>
<td>".$FTimeMatur."</td>
<td>".$BodymassM."</td>
<td>".$BodymassF."</td>
<td>".$BodyMassSpecies."</td>
<td>".$Parental_M."</td>
<td>".$Parental_F."</td>
<td>".$Migration."</td>
<td>".$MatngSyst."</td>
<td>".$Incubation."</td>
<td>".$Gestation."</td>
<td>".$WeanFledgeDay."</td>
<td>".$WeanFledgeMass."</td>
<td>".$ReproInterval."</td>
<td>".$RepSesonal."</td>
<td>".$SeasonLngth."</td>
<td>".$Survival."</td>
<td>".$BMR."</td>
<td>".$RMR."</td>
<td>".$EggDiameter."</td>
<td>".$SocialBreed."</td>
<td>".$SocialNonbreed."</td>
<td>".$SocialNotes."</td>
";
}
echo
"</tr>";


} echo '</tbody></table>
</div>';
}


//query for male BC


$query_MBC = "Select `species`.`Species_ID`,  `species`.`Vert_Group`, `species`.`Genus`, `species`.`Species`, `species`.`Common_name`, `hormone`.`Hormone_ID`, `hormone`.`Ref_ID`, `references`.`First_Author`, `references`.`YearPblished`, `hormone`.`Population_1`, `hormone`.`Population_2`, `hormone`.`Population_3`, `lifehistory`.`Pop_ID`, `hormone`.`Latitude`, `hormone`.`Longitud`, `hormone`.`LatLongEstim`, `hormone`.`Elevation`, `hormone`.`Years`, `hormone`.`Year_1`, `hormone`.`Year_final`, `hormone`.`Breeding_Cycle`, `hormone`.`Molt`, `hormone`.`Life_Stage`, `hormone`.`LifeHistConf`, `hormone`.`January`, `hormone`.`February`, `hormone`.`March`, `hormone`.`April`, `hormone`.`May`, `hormone`.`June`, `hormone`.`July`, `hormone`.`August`, `hormone`.`September`, `hormone`.`October`, `hormone`.`November`, `hormone`.`December`, `hormone`.`OthrHormones`, `hormone`.`Time_min`, `hormone`.`Time_max`, `hormone`.`CapturMethod`, `hormone`.`SampleMethod`,`hormone`.`MaxLate_Cort`, `hormone`.`MajorStrsPop`, `hormone`.`CrtAntibdyKt`, `hormone`.`CORT`, `hormone`.`Units`, `hormone`.`MBC_Mean`, `hormone`.`MBC_SE`, `hormone`.`MBC_CV`,`hormone`.`MBC_N`, `hormone`.`MBC_Min`, `hormone`.`MBC_Max`, `hormone`.`MBCOrigData`, `hormone`.`MBCRmovOtlir`, `hormone`.`MBCLnksConfnd`, `hormone`.`OtlierCrtria`, `hormone`.`Notes`, `hormone`.`LinkPhnotype`, `hormone`.`LinkFitness`, `hormone`.`IndvidRepeat`, `hormone`.`Scatterplot`, `hormone`.`LabPI`";

$query_MBC_tail = "

FROM `hormone`
LEFT JOIN `species`
ON `hormone`.`Species_ID` = `species`.`Species_ID`

LEFT JOIN `references`
ON 
`references`.`Ref_ID`= `hormone`.`Ref_ID` 

LEFT JOIN `lifehistory`
ON 
`lifehistory`.`Pop_ID`=`hormone`.`Pop_ID` 
WHERE 
`hormone`.`MBC_Mean` != 'null'
ORDER BY `hormone`.`Hormone_ID`";

if(isset($formLifeHistory)){
$query_MBC = $query_MBC.$lifehistory_query.$query_MBC_tail;

}
else {$query_MBC = $query_MBC.$query_MBC_tail;
}

$head5 = "<th>Species_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Vert_Group&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Genus&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Species&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Common_name&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Hormone_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref1stAuthor&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>YrPub&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_2&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_3&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Pop_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Latitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Longitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LatLongEstim&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Elevation&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Years&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_final&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Breeding_Cycle&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Molt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Life_Stage&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LifeHistConf&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>January&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>February&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>March&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>April&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>May&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>June&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>July&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>August&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>September&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>October&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>November&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>December&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>OthrHormones&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_max&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Capture_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Sample_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MaxLate_Cort&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MajorStrsPop&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>CrtAntibdyKt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>CORT&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Units&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MBC_Mean&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MBC_SE&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MBC_CV&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MBC_N&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MBC_Min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MBC_Max&nbsp;&nbsp;&nbsp;&nbsp;</th>


<th>MBCOrigData&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MBCRmovOtlir&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MBCLnksConfnd&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>OtlierCrtria&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Notes&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkPhnotype&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkFitness&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>IndvidRepeat&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Scatterplot&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LabPI&nbsp;&nbsp;&nbsp;&nbsp;</th>";

if(isset($formLifeHistory)){
$head5 = $head5.$lifehistory_header;

}

///set up the select to get the selected hormone

if($hormone=="MBC_Mean"){
$sql = $query_MBC;
$cat = "group5";
}
/*else if
($hormone=="FT_Mean"){
$sql = $query2;
$cat = "group1";}
else if
($hormone=="MBC_Mean"){
$sql = $query3;
$cat = "group1";}
else if
($hormone=="FBC_Mean"){
$sql = $query4;
$cat = "group1";}*/

if($cat =="group5") {
	
	
$result = mysqli_query($con, $sql)or die(mysql_error());

echo ' <button id="btnExport">Export to xls</button><div id="table_wrapper"><table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1"><thead><tr>';
if($hormone=="MBC_Mean"){
$head = $head5;}
/*else if
($hormone=="FT_Mean"){
$head = $head2;}
else if
($hormone=="MBC_Mean"){
$head = $head3;}
else if
($hormone=="FBC_Mean"){
$head = $head4;}*/
echo $head."</tr></thead><tbody>";

while ($row = $result->fetch_assoc()){
$Species_ID = $row["Species_ID"];
$Vert_Group = $row["Vert_Group"];
$Genus = $row["Genus"];
$Species = $row["Species"];
$Common_name = $row["Common_name"];
$Hormone_ID = $row["Hormone_ID"];
$Ref_ID = $row["Ref_ID"];
$First_Author = $row["First_Author"];
$YearPblished = $row["YearPblished"];
$Population_1 = $row["Population_1"];
$Population_2 = $row["Population_2"];
$Population_3 = $row["Population_3"];
$Pop_ID = $row["Pop_ID"];
$Latitude = $row["Latitude"];
$Longitude = $row["Longitud"];
$LatLongEstim = $row["LatLongEstim"];
$Elevation = $row["Elevation"];
$Years = $row["Years"];
$Year_1 = $row["Year_1"];
$Year_final = $row["Year_final"];

$Breeding_Cycle = $row["Breeding_Cycle"];
$Molt = $row["Molt"];
$Life_Stage = $row["Life_Stage"];
$LifeHistConf = $row["LifeHistConf"];

$January = $row["January"];
$February = $row["February"];
$March = $row["March"];
$April = $row["April"];
$May = $row["May"];
$June = $row["June"];
$July = $row["July"];
$August = $row["August"];
$September = $row["September"];
$October = $row["October"];
$November = $row["November"];
$December = $row["December"];
$OthrHormones = $row["OthrHormones"];
$Time_min = $row["Time_min"];
$Time_max = $row["Time_max"];


$CapturMethod = $row["CapturMethod"];
$SampleMethod = $row["SampleMethod"];
$MaxLate_Cort = $row["MaxLate_Cort"];
$MajorStrsPop =$row["MajorStrsPop"];


$CrtAntibdyKt = $row["CrtAntibdyKt"];
$CORT = $row["CORT"];
$Units = $row["Units"];

$MBC_Mean = $row["MBC_Mean"];
$MBC_SE = $row["MBC_SE"];
$MBC_CV = $row["MBC_CV"];
$MBC_N = $row["MBC_N"];
$MBC_Min = $row["MBC_Min"];
$MBC_Max = $row["MBC_Max"];


$MBCOrigData = $row["MBCOrigData"];
$MBCRmovOtlir = $row["MBCRmovOtlir"];
$MBCLnksConfnd = $row["MBCLnksConfnd"];
$OtlierCrtria = $row["OtlierCrtria"];
$Notes = $row["Notes"];
$LinkPhnotype = $row["LinkPhnotype"];
$LinkFitness = $row["LinkFitness"];
$IndvidRepeat = $row["IndvidRepeat"];
$Scatterplot = $row["Scatterplot"];
$LabPI= $row["LabPI"]; 

$LH_Pop_ID= $row["Pop_ID"];
$LHforPop=$row["LHforPop"]; 
$BodySizePop=$row["BodySizePop"]; 
$RefList=$row["RefList"]; 
$Habitat=$row["Habitat"]; 
$ReproMode=$row["ReproMode"]; 
$EggBirthMass=$row["EggBirthMass"]; 
$LitterClutchSize=$row["LitterClutchSize"]; 
$LitterClutchYear=$row["LitterClutchYear"]; 
$LongevityMax=$row["LongevityMax"]; 
$AveLifeExpect=$row["AveLifeExpect"]; 
$MTimeMatur=$row["MTimeMatur"]; 
$FTimeMatur=$row["FTimeMatur"]; 
$BodymassM=$row["BodymassM"]; 
$BodymassF=$row["BodymassF"]; 
$BodyMassSpecies=$row["BodyMassSpecies"]; 
$Parental_M=$row["Parental_M"]; 
$Parental_F=$row["Parental_F"]; 
$Migration=$row["Migration"]; 
$MatngSyst=$row["MatngSyst"]; 
$Incubation=$row["Incubation"]; 
$Gestation=$row["Gestation"]; 
$WeanFledgeDay=$row["WeanFledgeDay"]; 
$WeanFledgeMass=$row["WeanFledgeMass"]; 
$ReproInterval=$row["ReproInterval"]; 
$RepSesonal=$row["RepSesonal"]; 
$SeasonLngth=$row["SeasonLngth"]; 
$Survival=$row["Survival"]; 
$BMR=$row["BMR"];
$RMR=$row["RMR"];
$EggDiameter=$row["EggDiameter"];
$SocialBreed=$row["SocialBreed"];
$SocialNonbreed=$row["SocialNonbreed"];
$SocialNotes=$row["SocialNotes"];


 echo "<td>".$Species_ID."</td>
<td>".$Vert_Group."</td>
<td>".$Genus."</td>
<td>".$Species."</td>
<td>".$Common_name."</td>
<td>".$Hormone_ID."</td>
<td>".$Ref_ID."</td>
<td>".$First_Author."</td>
<td>".$YearPblished."</td>
<td>".$Population_1."</td>
<td>".$Population_2."</td>
<td>".$Population_3."</td>
<td>".$Pop_ID."</td>
<td>".$Latitude."</td>
<td>".$Longitude."</td>
<td>".$LatLongEstim."</td>
<td>".$Elevation."</td>
<td>".$Years."</td>
<td>".$Year_1."</td>
<td>".$Year_final."</td>

<td>".$Breeding_Cycle."</td>
<td>".$Molt."</td>

<td>".$Life_Stage."</td>
<td>".$LifeHistConf."</td>
<td>".$January."</td>
<td>".$February."</td>
<td>".$March."</td>
<td>".$April."</td>
<td>".$May."</td>
<td>".$June."</td>
<td>".$July."</td>
<td>".$August."</td>
<td>".$September."</td>
<td>".$October."</td>
<td>".$November."</td>
<td>".$December."</td>
<td>".$OthrHormones."</td>
<td>".$Time_min."</td>
<td>".$Time_max."</td>

<td>".$CapturMethod."</td>
<td>".$SampleMethod."</td>
<td>".$MaxLate_Cort."</td>
<td>".$MajorStrsPop."</td>

<td>".$CrtAntibdyKt."</td>
<td>".$CORT."</td>
<td>".$Units."</td>

<td>".$MBC_Mean."</td>
<td>".$MBC_SE."</td>
<td>".$MBC_CV."</td>
<td>".$MBC_N."</td>
<td>".$MBC_Min."</td>
<td>".$MBC_Max."</td>


<td>".$MBCOrigData."</td>
<td>".$MBCRmovOtlir."</td>
<td>".$MBCLnksConfnd."</td>
<td>".$OtlierCrtria."</td>
<td>".$Notes."</td>
<td>".$LinkPhnotype."</td>
<td>".$LinkFitness."</td>
<td>".$IndvidRepeat."</td>
<td>".$Scatterplot."</td>
<td>".$LabPI."</td>";

if(isset($formLifeHistory)){
echo	

"<td>".$LH_Pop_ID."</td>
<td>".$LHforPop."</td>
<td>".$BodySizePop."</td>
<td>".$RefList."</td>
<td>".$Habitat."</td>
<td>".$ReproMode."</td>
<td>".$EggBirthMass."</td>
<td>".$LitterClutchSize."</td>
<td>".$LitterClutchYear."</td>

<td>".$LongevityMax."</td>
<td>".$AveLifeExpect."</td>
<td>".$MTimeMatur."</td>
<td>".$FTimeMatur."</td>
<td>".$BodymassM."</td>
<td>".$BodymassF."</td>
<td>".$BodyMassSpecies."</td>
<td>".$Parental_M."</td>
<td>".$Parental_F."</td>
<td>".$Migration."</td>
<td>".$MatngSyst."</td>
<td>".$Incubation."</td>
<td>".$Gestation."</td>
<td>".$WeanFledgeDay."</td>
<td>".$WeanFledgeMass."</td>
<td>".$ReproInterval."</td>
<td>".$RepSesonal."</td>
<td>".$SeasonLngth."</td>
<td>".$Survival."</td>
<td>".$BMR."</td>
<td>".$RMR."</td>
<td>".$EggDiameter."</td>
<td>".$SocialBreed."</td>
<td>".$SocialNonbreed."</td>
<td>".$SocialNotes."</td>
";
}
echo
"</tr>";


} echo '</tbody></table>
</div>';
}


//query for female BC


$query_FBC = "Select `species`.`Species_ID`,  `species`.`Vert_Group`, `species`.`Genus`, `species`.`Species`, `species`.`Common_name`, `hormone`.`Hormone_ID`, `hormone`.`Ref_ID`, `references`.`First_Author`, `references`.`YearPblished`, `hormone`.`Population_1`, `hormone`.`Population_2`, `hormone`.`Population_3`, `lifehistory`.`Pop_ID`, `hormone`.`Latitude`, `hormone`.`Longitud`, `hormone`.`LatLongEstim`, `hormone`.`Elevation`, `hormone`.`Years`, `hormone`.`Year_1`, `hormone`.`Year_final`, `hormone`.`Breeding_Cycle`, `hormone`.`Molt`, `hormone`.`Life_Stage`, `hormone`.`LifeHistConf`, `hormone`.`January`, `hormone`.`February`, `hormone`.`March`, `hormone`.`April`, `hormone`.`May`, `hormone`.`June`, `hormone`.`July`, `hormone`.`August`, `hormone`.`September`, `hormone`.`October`, `hormone`.`November`, `hormone`.`December`, `hormone`.`OthrHormones`, `hormone`.`Time_min`, `hormone`.`Time_max`, `hormone`.`CapturMethod`, `hormone`.`SampleMethod`,`hormone`.`MaxLate_Cort`, `hormone`.`MajorStrsPop`, `hormone`.`CrtAntibdyKt`, `hormone`.`CORT`, `hormone`.`Units`, `hormone`.`FBC_Mean`, `hormone`.`FBC_SE`,`hormone`.`FBC_CV`, `hormone`.`FBC_N`, `hormone`.`FBC_Min`, `hormone`.`FBC_Max`, `hormone`.`FBCOrigData`, `hormone`.`FBCRmovOtlir`, `hormone`.`FBCLnksConfnd`, `hormone`.`OtlierCrtria`, `hormone`.`Notes`, `hormone`.`LinkPhnotype`, `hormone`.`LinkFitness`, `hormone`.`IndvidRepeat`, `hormone`.`Scatterplot`, `hormone`.`LabPI`";

$query_FBC_tail = "

FROM `hormone`
LEFT JOIN `species`
ON `hormone`.`Species_ID` = `species`.`Species_ID`

LEFT JOIN `references`
ON 
`references`.`Ref_ID`= `hormone`.`Ref_ID` 

LEFT JOIN `lifehistory`
ON 
`lifehistory`.`Pop_ID`=`hormone`.`Pop_ID` 
WHERE 
`hormone`.`FBC_Mean` != 'null'
ORDER BY `hormone`.`Hormone_ID`";

if(isset($formLifeHistory)){
$query_FBC = $query_FBC.$lifehistory_query.$query_FBC_tail;

}
else {$query_FBC = $query_FBC.$query_FBC_tail;
}

$head6 = "<th>Species_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Vert_Group&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Genus&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Species&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Common_name&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Hormone_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref1stAuthor&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>YrPub&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_2&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_3&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Pop_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Latitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Longitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LatLongEstim&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Elevation&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Years&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_final&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Breeding_Cycle&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Molt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Life_Stage&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LifeHistConf&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>January&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>February&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>March&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>April&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>May&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>June&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>July&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>August&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>September&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>October&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>November&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>December&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>OthrHormones&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_max&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Capture_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Sample_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MaxLate_Cort&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MajorStrsPop&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>CrtAntibdyKt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>CORT&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Units&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FBC_Mean&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FBC_SE&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FBC_CV&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FBC_N&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FBC_Min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FBC_Max&nbsp;&nbsp;&nbsp;&nbsp;</th>


<th>FBCOrigData&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FBCRmovOtlir&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FBCLnksConfnd&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>OtlierCrtria&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Notes&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkPhnotype&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkFitness&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>IndvidRepeat&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Scatterplot&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LabPI&nbsp;&nbsp;&nbsp;&nbsp;</th>";

if(isset($formLifeHistory)){
$head6 = $head6.$lifehistory_header;

}

///set up the select to get the selected hormone

if($hormone=="FBC_Mean"){
$sql = $query_FBC;
$cat = "group6";
}
/*else if
($hormone=="FT_Mean"){
$sql = $query2;
$cat = "group1";}
else if
($hormone=="MBC_Mean"){
$sql = $query3;
$cat = "group1";}
else if
($hormone=="FBC_Mean"){
$sql = $query4;
$cat = "group1";}*/

if($cat =="group6") {
	
	
$result = mysqli_query($con, $sql)or die(mysql_error());

echo ' <button id="btnExport">Export to xls</button><div id="table_wrapper"><table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1"><thead><tr>';
if($hormone=="FBC_Mean"){
$head = $head6;}
/*else if
($hormone=="FT_Mean"){
$head = $head2;}
else if
($hormone=="MBC_Mean"){
$head = $head3;}
else if
($hormone=="FBC_Mean"){
$head = $head4;}*/
echo $head."</tr></thead><tbody>";

while ($row = $result->fetch_assoc()){
$Species_ID = $row["Species_ID"];
$Vert_Group = $row["Vert_Group"];
$Genus = $row["Genus"];
$Species = $row["Species"];
$Common_name = $row["Common_name"];
$Hormone_ID = $row["Hormone_ID"];
$Ref_ID = $row["Ref_ID"];
$First_Author = $row["First_Author"];
$YearPblished = $row["YearPblished"];
$Population_1 = $row["Population_1"];
$Population_2 = $row["Population_2"];
$Population_3 = $row["Population_3"];
$Pop_ID = $row["Pop_ID"];
$Latitude = $row["Latitude"];
$Longitude = $row["Longitud"];
$LatLongEstim = $row["LatLongEstim"];
$Elevation = $row["Elevation"];
$Years = $row["Years"];
$Year_1 = $row["Year_1"];
$Year_final = $row["Year_final"];

$Breeding_Cycle = $row["Breeding_Cycle"];
$Molt = $row["Molt"];
$Life_Stage = $row["Life_Stage"];
$LifeHistConf = $row["LifeHistConf"];

$January = $row["January"];
$February = $row["February"];
$March = $row["March"];
$April = $row["April"];
$May = $row["May"];
$June = $row["June"];
$July = $row["July"];
$August = $row["August"];
$September = $row["September"];
$October = $row["October"];
$November = $row["November"];
$December = $row["December"];
$OthrHormones = $row["OthrHormones"];
$Time_min = $row["Time_min"];
$Time_max = $row["Time_max"];


$CapturMethod = $row["CapturMethod"];
$SampleMethod = $row["SampleMethod"];
$MaxLate_Cort = $row["MaxLate_Cort"];
$MajorStrsPop =$row["MajorStrsPop"];


$CrtAntibdyKt = $row["CrtAntibdyKt"];
$CORT = $row["CORT"];
$Units = $row["Units"];

$FBC_Mean = $row["FBC_Mean"];
$FBC_SE = $row["FBC_SE"];
$FBC_CV = $row["FBC_CV"];
$FBC_N = $row["FBC_N"];
$FBC_Min = $row["FBC_Min"];
$FBC_Max = $row["FBC_Max"];


$FBCOrigData = $row["FBCOrigData"];
$FBCRmovOtlir = $row["FBCRmovOtlir"];
$FBCLnksConfnd = $row["FBCLnksConfnd"];
$OtlierCrtria = $row["OtlierCrtria"];
$Notes = $row["Notes"];
$LinkPhnotype = $row["LinkPhnotype"];
$LinkFitness = $row["LinkFitness"];
$IndvidRepeat = $row["IndvidRepeat"];
$Scatterplot = $row["Scatterplot"];
$LabPI= $row["LabPI"]; 

$LH_Pop_ID= $row["Pop_ID"];
$LHforPop=$row["LHforPop"]; 
$BodySizePop=$row["BodySizePop"]; 
$RefList=$row["RefList"]; 
$Habitat=$row["Habitat"]; 
$ReproMode=$row["ReproMode"]; 
$EggBirthMass=$row["EggBirthMass"]; 
$LitterClutchSize=$row["LitterClutchSize"]; 
$LitterClutchYear=$row["LitterClutchYear"]; 
$LongevityMax=$row["LongevityMax"]; 
$AveLifeExpect=$row["AveLifeExpect"]; 
$MTimeMatur=$row["MTimeMatur"]; 
$FTimeMatur=$row["FTimeMatur"]; 
$BodymassM=$row["BodymassM"]; 
$BodymassF=$row["BodymassF"]; 
$BodyMassSpecies=$row["BodyMassSpecies"]; 
$Parental_M=$row["Parental_M"]; 
$Parental_F=$row["Parental_F"]; 
$Migration=$row["Migration"]; 
$MatngSyst=$row["MatngSyst"]; 
$Incubation=$row["Incubation"]; 
$Gestation=$row["Gestation"]; 
$WeanFledgeDay=$row["WeanFledgeDay"]; 
$WeanFledgeMass=$row["WeanFledgeMass"]; 
$ReproInterval=$row["ReproInterval"]; 
$RepSesonal=$row["RepSesonal"]; 
$SeasonLngth=$row["SeasonLngth"]; 
$Survival=$row["Survival"]; 
$BMR=$row["BMR"];
$RMR=$row["RMR"];
$EggDiameter=$row["EggDiameter"];
$SocialBreed=$row["SocialBreed"];
$SocialNonbreed=$row["SocialNonbreed"];
$SocialNotes=$row["SocialNotes"];


 echo "<td>".$Species_ID."</td>
<td>".$Vert_Group."</td>
<td>".$Genus."</td>
<td>".$Species."</td>
<td>".$Common_name."</td>
<td>".$Hormone_ID."</td>
<td>".$Ref_ID."</td>
<td>".$First_Author."</td>
<td>".$YearPblished."</td>
<td>".$Population_1."</td>
<td>".$Population_2."</td>
<td>".$Population_3."</td>
<td>".$Pop_ID."</td>
<td>".$Latitude."</td>
<td>".$Longitude."</td>
<td>".$LatLongEstim."</td>
<td>".$Elevation."</td>
<td>".$Years."</td>
<td>".$Year_1."</td>
<td>".$Year_final."</td>

<td>".$Breeding_Cycle."</td>
<td>".$Molt."</td>

<td>".$Life_Stage."</td>
<td>".$LifeHistConf."</td>
<td>".$January."</td>
<td>".$February."</td>
<td>".$March."</td>
<td>".$April."</td>
<td>".$May."</td>
<td>".$June."</td>
<td>".$July."</td>
<td>".$August."</td>
<td>".$September."</td>
<td>".$October."</td>
<td>".$November."</td>
<td>".$December."</td>
<td>".$OthrHormones."</td>
<td>".$Time_min."</td>
<td>".$Time_max."</td>

<td>".$CapturMethod."</td>
<td>".$SampleMethod."</td>
<td>".$MaxLate_Cort."</td>
<td>".$MajorStrsPop."</td>

<td>".$CrtAntibdyKt."</td>
<td>".$CORT."</td>
<td>".$Units."</td>

<td>".$FBC_Mean."</td>
<td>".$FBC_SE."</td>
<td>".$FBC_CV."</td>
<td>".$FBC_N."</td>
<td>".$FBC_Min."</td>
<td>".$FBC_Max."</td>


<td>".$FBCOrigData."</td>
<td>".$FBCRmovOtlir."</td>
<td>".$FBCLnksConfnd."</td>
<td>".$OtlierCrtria."</td>
<td>".$Notes."</td>
<td>".$LinkPhnotype."</td>
<td>".$LinkFitness."</td>
<td>".$IndvidRepeat."</td>
<td>".$Scatterplot."</td>
<td>".$LabPI."</td>";

if(isset($formLifeHistory)){
echo	

"<td>".$LH_Pop_ID."</td>
<td>".$LHforPop."</td>
<td>".$BodySizePop."</td>
<td>".$RefList."</td>
<td>".$Habitat."</td>
<td>".$ReproMode."</td>
<td>".$EggBirthMass."</td>
<td>".$LitterClutchSize."</td>
<td>".$LitterClutchYear."</td>

<td>".$LongevityMax."</td>
<td>".$AveLifeExpect."</td>
<td>".$MTimeMatur."</td>
<td>".$FTimeMatur."</td>
<td>".$BodymassM."</td>
<td>".$BodymassF."</td>
<td>".$BodyMassSpecies."</td>
<td>".$Parental_M."</td>
<td>".$Parental_F."</td>
<td>".$Migration."</td>
<td>".$MatngSyst."</td>
<td>".$Incubation."</td>
<td>".$Gestation."</td>
<td>".$WeanFledgeDay."</td>
<td>".$WeanFledgeMass."</td>
<td>".$ReproInterval."</td>
<td>".$RepSesonal."</td>
<td>".$SeasonLngth."</td>
<td>".$Survival."</td>
<td>".$BMR."</td>
<td>".$RMR."</td>
<td>".$EggDiameter."</td>
<td>".$SocialBreed."</td>
<td>".$SocialNonbreed."</td>
<td>".$SocialNotes."</td>
";
}
echo
"</tr>";


} echo '</tbody></table>
</div>';
}

//query for male SC


$query_MSC = "Select `species`.`Species_ID`,  `species`.`Vert_Group`, `species`.`Genus`, `species`.`Species`, `species`.`Common_name`, `hormone`.`Hormone_ID`, `hormone`.`Ref_ID`, `references`.`First_Author`, `references`.`YearPblished`, `hormone`.`Population_1`, `hormone`.`Population_2`, `hormone`.`Population_3`, `lifehistory`.`Pop_ID`, `hormone`.`Latitude`, `hormone`.`Longitud`, `hormone`.`LatLongEstim`, `hormone`.`Elevation`, `hormone`.`Years`, `hormone`.`Year_1`, `hormone`.`Year_final`, `hormone`.`Breeding_Cycle`, `hormone`.`Molt`, `hormone`.`Life_Stage`, `hormone`.`LifeHistConf`, `hormone`.`January`, `hormone`.`February`, `hormone`.`March`, `hormone`.`April`, `hormone`.`May`, `hormone`.`June`, `hormone`.`July`, `hormone`.`August`, `hormone`.`September`, `hormone`.`October`, `hormone`.`November`, `hormone`.`December`, `hormone`.`OthrHormones`, `hormone`.`Time_min`, `hormone`.`Time_max`, `hormone`.`CapturMethod`, `hormone`.`SampleMethod`,`hormone`.`LteStrsCort`, `hormone`.`StressorType`, `hormone`.`MajorStrsPop`, `hormone`.`CrtAntibdyKt`, `hormone`.`CORT`, `hormone`.`Units`, `hormone`.`MSC_Mean`, `hormone`.`MSC_SE`, `hormone`.`MSC_CV`,`hormone`.`MSC_N`, `hormone`.`MSC_Min`, `hormone`.`MSC_Max`, `hormone`.`MSCOrigData`, `hormone`.`MSCRmvOtlir`, `hormone`.`MSCLnksConfnd`, `hormone`.`OtlierCrtria`, `hormone`.`Notes`, `hormone`.`LinkPhnotype`, `hormone`.`LinkFitness`, `hormone`.`IndvidRepeat`, `hormone`.`Scatterplot`, `hormone`.`LabPI`";

$query_MSC_tail = "

FROM `hormone`
LEFT JOIN `species`
ON `hormone`.`Species_ID` = `species`.`Species_ID`

LEFT JOIN `references`
ON 
`references`.`Ref_ID`= `hormone`.`Ref_ID` 

LEFT JOIN `lifehistory`
ON 
`lifehistory`.`Pop_ID`=`hormone`.`Pop_ID` 
WHERE 
`hormone`.`MSC_Mean` != 'null'
ORDER BY `hormone`.`Hormone_ID`";

if(isset($formLifeHistory)){
$query_MSC = $query_MSC.$lifehistory_query.$query_MSC_tail;

}
else {$query_MSC = $query_MSC.$query_MSC_tail;
}

$head7 = "<th>Species_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Vert_Group&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Genus&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Species&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Common_name&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Hormone_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref1stAuthor&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>YrPub&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_2&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_3&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Pop_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Latitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Longitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LatLongEstim&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Elevation&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Years&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_final&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Breeding_Cycle&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Molt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Life_Stage&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LifeHistConf&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>January&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>February&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>March&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>April&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>May&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>June&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>July&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>August&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>September&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>October&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>November&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>December&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>OthrHormones&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_max&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Capture_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Sample_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LteStrsCort&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>StressorType&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MajorStrsPop&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>CrtAntibdyKt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>CORT&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Units&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MSC_Mean&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MSC_SE&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MSC_CV&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MSC_N&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MSC_Min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MSC_Max&nbsp;&nbsp;&nbsp;&nbsp;</th>


<th>MSCOrigData&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MSCRmvOtlir&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MSCLnksConfnd&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>OtlierCrtria&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Notes&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkPhnotype&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkFitness&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>IndvidRepeat&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Scatterplot&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LabPI&nbsp;&nbsp;&nbsp;&nbsp;</th>";

if(isset($formLifeHistory)){
$head7 = $head7.$lifehistory_header;

}

///set up the select to get the selected hormone

if($hormone=="MSC_Mean"){
$sql = $query_MSC;
$cat = "group7";
}


/*else if
($hormone=="FT_Mean"){
$sql = $query2;
$cat = "group1";}
else if
($hormone=="MBC_Mean"){
$sql = $query3;
$cat = "group1";}
else if
($hormone=="FBC_Mean"){
$sql = $query4;
$cat = "group1";}*/

if($cat == "group7") {
	
	
$result = mysqli_query($con, $sql)or die(mysql_error());

echo '<button id="btnExport">Export to xls</button><div id="table_wrapper"><table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1"><thead><tr>';
if($hormone=="MSC_Mean"){
$head = $head7;}
/*else if
($hormone=="FT_Mean"){
$head = $head2;}
else if
($hormone=="MBC_Mean"){
$head = $head3;}
else if
($hormone=="FBC_Mean"){
$head = $head4;}*/
echo $head."</tr></thead><tbody>";

while ($row = $result->fetch_assoc()){
$Species_ID = $row["Species_ID"];
$Vert_Group = $row["Vert_Group"];
$Genus = $row["Genus"];
$Species = $row["Species"];
$Common_name = $row["Common_name"];
$Hormone_ID = $row["Hormone_ID"];
$Ref_ID = $row["Ref_ID"];
$First_Author = $row["First_Author"];
$YearPblished = $row["YearPblished"];
$Population_1 = $row["Population_1"];
$Population_2 = $row["Population_2"];
$Population_3 = $row["Population_3"];
$Pop_ID = $row["Pop_ID"];
$Latitude = $row["Latitude"];
$Longitude = $row["Longitud"];
$LatLongEstim = $row["LatLongEstim"];
$Elevation = $row["Elevation"];
$Years = $row["Years"];
$Year_1 = $row["Year_1"];
$Year_final = $row["Year_final"];

$Breeding_Cycle = $row["Breeding_Cycle"];
$Molt = $row["Molt"];
$Life_Stage = $row["Life_Stage"];
$LifeHistConf = $row["LifeHistConf"];

$January = $row["January"];
$February = $row["February"];
$March = $row["March"];
$April = $row["April"];
$May = $row["May"];
$June = $row["June"];
$July = $row["July"];
$August = $row["August"];
$September = $row["September"];
$October = $row["October"];
$November = $row["November"];
$December = $row["December"];
$OthrHormones = $row["OthrHormones"];
$Time_min = $row["Time_min"];
$Time_max = $row["Time_max"];


$CapturMethod = $row["CapturMethod"];
$SampleMethod = $row["SampleMethod"];
$LteStrsCort = $row["LteStrsCort"];
$StressorType = $row["StressorType"];
$MajorStrsPop =$row["MajorStrsPop"];


$CrtAntibdyKt = $row["CrtAntibdyKt"];
$CORT = $row["CORT"];
$Units = $row["Units"];

$MSC_Mean = $row["MSC_Mean"];
$MSC_SE = $row["MSC_SE"];
$MSC_CV = $row["MSC_CV"];
$MSC_N = $row["MSC_N"];
$MSC_Min = $row["MSC_Min"];
$MSC_Max = $row["MSC_Max"];


$MSCOrigData = $row["MSCOrigData"];
$MSCRmvOtlir = $row["MSCRmvOtlir"];
$MSCLnksConfnd = $row["MSCLnksConfnd"];
$OtlierCrtria = $row["OtlierCrtria"];
$Notes = $row["Notes"];
$LinkPhnotype = $row["LinkPhnotype"];
$LinkFitness = $row["LinkFitness"];
$IndvidRepeat = $row["IndvidRepeat"];
$Scatterplot = $row["Scatterplot"];
$LabPI= $row["LabPI"]; 

$LH_Pop_ID= $row["Pop_ID"];
$LHforPop=$row["LHforPop"]; 
$BodySizePop=$row["BodySizePop"]; 
$RefList=$row["RefList"]; 
$Habitat=$row["Habitat"]; 
$ReproMode=$row["ReproMode"]; 
$EggBirthMass=$row["EggBirthMass"]; 
$LitterClutchSize=$row["LitterClutchSize"]; 
$LitterClutchYear=$row["LitterClutchYear"]; 
$LongevityMax=$row["LongevityMax"]; 
$AveLifeExpect=$row["AveLifeExpect"]; 
$MTimeMatur=$row["MTimeMatur"]; 
$FTimeMatur=$row["FTimeMatur"]; 
$BodymassM=$row["BodymassM"]; 
$BodymassF=$row["BodymassF"]; 
$BodyMassSpecies=$row["BodyMassSpecies"]; 
$Parental_M=$row["Parental_M"]; 
$Parental_F=$row["Parental_F"]; 
$Migration=$row["Migration"]; 
$MatngSyst=$row["MatngSyst"]; 
$Incubation=$row["Incubation"]; 
$Gestation=$row["Gestation"]; 
$WeanFledgeDay=$row["WeanFledgeDay"]; 
$WeanFledgeMass=$row["WeanFledgeMass"]; 
$ReproInterval=$row["ReproInterval"]; 
$RepSesonal=$row["RepSesonal"]; 
$SeasonLngth=$row["SeasonLngth"]; 
$Survival=$row["Survival"]; 
$BMR=$row["BMR"];
$RMR=$row["RMR"];
$EggDiameter=$row["EggDiameter"];
$SocialBreed=$row["SocialBreed"];
$SocialNonbreed=$row["SocialNonbreed"];
$SocialNotes=$row["SocialNotes"];
 echo "<td>".$Species_ID."</td>
<td>".$Vert_Group."</td>
<td>".$Genus."</td>
<td>".$Species."</td>
<td>".$Common_name."</td>
<td>".$Hormone_ID."</td>
<td>".$Ref_ID."</td>
<td>".$First_Author."</td>
<td>".$YearPblished."</td>
<td>".$Population_1."</td>
<td>".$Population_2."</td>
<td>".$Population_3."</td>
<td>".$Pop_ID."</td>
<td>".$Latitude."</td>
<td>".$Longitude."</td>
<td>".$LatLongEstim."</td>
<td>".$Elevation."</td>
<td>".$Years."</td>
<td>".$Year_1."</td>
<td>".$Year_final."</td>

<td>".$Breeding_Cycle."</td>
<td>".$Molt."</td>

<td>".$Life_Stage."</td>
<td>".$LifeHistConf."</td>
<td>".$January."</td>
<td>".$February."</td>
<td>".$March."</td>
<td>".$April."</td>
<td>".$May."</td>
<td>".$June."</td>
<td>".$July."</td>
<td>".$August."</td>
<td>".$September."</td>
<td>".$October."</td>
<td>".$November."</td>
<td>".$December."</td>
<td>".$OthrHormones."</td>
<td>".$Time_min."</td>
<td>".$Time_max."</td>

<td>".$CapturMethod."</td>
<td>".$SampleMethod."</td>
<td>".$LteStrsCort."</td>
<td>".$StressorType."</td>
<td>".$MajorStrsPop."</td>

<td>".$CrtAntibdyKt."</td>
<td>".$CORT."</td>
<td>".$Units."</td>

<td>".$MSC_Mean."</td>
<td>".$MSC_SE."</td>
<td>".$MSC_CV."</td>
<td>".$MSC_N."</td>
<td>".$MSC_Min."</td>
<td>".$MSC_Max."</td>


<td>".$MSCOrigData."</td>
<td>".$MSCRmvOtlir."</td>
<td>".$MSCLnksConfnd."</td>
<td>".$OtlierCrtria."</td>
<td>".$Notes."</td>
<td>".$LinkPhnotype."</td>
<td>".$LinkFitness."</td>
<td>".$IndvidRepeat."</td>
<td>".$Scatterplot."</td>
<td>".$LabPI."</td>";

if(isset($formLifeHistory)){
echo	

"<td>".$LH_Pop_ID."</td>
<td>".$LHforPop."</td>
<td>".$BodySizePop."</td>
<td>".$RefList."</td>
<td>".$Habitat."</td>
<td>".$ReproMode."</td>
<td>".$EggBirthMass."</td>
<td>".$LitterClutchSize."</td>
<td>".$LitterClutchYear."</td>

<td>".$LongevityMax."</td>
<td>".$AveLifeExpect."</td>
<td>".$MTimeMatur."</td>
<td>".$FTimeMatur."</td>
<td>".$BodymassM."</td>
<td>".$BodymassF."</td>
<td>".$BodyMassSpecies."</td>
<td>".$Parental_M."</td>
<td>".$Parental_F."</td>
<td>".$Migration."</td>
<td>".$MatngSyst."</td>
<td>".$Incubation."</td>
<td>".$Gestation."</td>
<td>".$WeanFledgeDay."</td>
<td>".$WeanFledgeMass."</td>
<td>".$ReproInterval."</td>
<td>".$RepSesonal."</td>
<td>".$SeasonLngth."</td>
<td>".$Survival."</td>
<td>".$BMR."</td>
<td>".$RMR."</td>
<td>".$EggDiameter."</td>
<td>".$SocialBreed."</td>
<td>".$SocialNonbreed."</td>
<td>".$SocialNotes."</td>
";
}
echo
"</tr>";


} echo '</tbody></table>
</div>';
}



//query for female SC


$query_FSC = "Select `species`.`Species_ID`,  `species`.`Vert_Group`, `species`.`Genus`, `species`.`Species`, `species`.`Common_name`, `hormone`.`Hormone_ID`, `hormone`.`Ref_ID`, `references`.`First_Author`, `references`.`YearPblished`, `hormone`.`Population_1`, `hormone`.`Population_2`, `hormone`.`Population_3`, `lifehistory`.`Pop_ID`, `hormone`.`Latitude`, `hormone`.`Longitud`, `hormone`.`LatLongEstim`, `hormone`.`Elevation`, `hormone`.`Years`, `hormone`.`Year_1`, `hormone`.`Year_final`, `hormone`.`Breeding_Cycle`, `hormone`.`Molt`, `hormone`.`Life_Stage`, `hormone`.`LifeHistConf`, `hormone`.`January`, `hormone`.`February`, `hormone`.`March`, `hormone`.`April`, `hormone`.`May`, `hormone`.`June`, `hormone`.`July`, `hormone`.`August`, `hormone`.`September`, `hormone`.`October`, `hormone`.`November`, `hormone`.`December`, `hormone`.`OthrHormones`, `hormone`.`Time_min`, `hormone`.`Time_max`, `hormone`.`CapturMethod`, `hormone`.`SampleMethod`,`hormone`.`LteStrsCort`, `hormone`.`StressorType`, `hormone`.`MajorStrsPop`, `hormone`.`CrtAntibdyKt`, `hormone`.`CORT`, `hormone`.`Units`, `hormone`.`FSC_Mean`, `hormone`.`FSC_SE`, `hormone`.`FSC_CV`,`hormone`.`FSC_N`, `hormone`.`FSC_Min`, `hormone`.`FSC_Max`, `hormone`.`FSCOrigData`, `hormone`.`FSCRmvOtlir`, `hormone`.`FSCLnksCnfnd`, `hormone`.`OtlierCrtria`, `hormone`.`Notes`, `hormone`.`LinkPhnotype`, `hormone`.`LinkFitness`, `hormone`.`IndvidRepeat`, `hormone`.`Scatterplot`, `hormone`.`LabPI`";

$query_FSC_tail = "

FROM `hormone`
LEFT JOIN `species`
ON `hormone`.`Species_ID` = `species`.`Species_ID`

LEFT JOIN `references`
ON 
`references`.`Ref_ID`= `hormone`.`Ref_ID` 

LEFT JOIN `lifehistory`
ON 
`lifehistory`.`Pop_ID`=`hormone`.`Pop_ID` 
WHERE 
`hormone`.`FSC_Mean` != 'null'
ORDER BY `hormone`.`Hormone_ID`";

if(isset($formLifeHistory)){
$query_FSC = $query_FSC.$lifehistory_query.$query_FSC_tail;

}
else {$query_FSC = $query_FSC.$query_FSC_tail;
}

$head8 = "<th>Species_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Vert_Group&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Genus&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Species&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Common_name&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Hormone_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Ref1stAuthor&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>YrPub&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_2&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Population_3&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Pop_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Latitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Longitude&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LatLongEstim&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Elevation&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Years&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_1&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Year_final&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Breeding_Cycle&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Molt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Life_Stage&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LifeHistConf&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>January&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>February&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>March&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>April&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>May&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>June&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>July&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>August&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>September&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>October&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>November&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>December&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>OthrHormones&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Time_max&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Capture_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Sample_Method&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LteStrsCort&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>StressorType&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>MajorStrsPop&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>CrtAntibdyKt&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>CORT&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Units&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FSC_Mean&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FSC_SE&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FSC_CV&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FSC_N&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FSC_Min&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FSC_Max&nbsp;&nbsp;&nbsp;&nbsp;</th>


<th>FSCOrigData&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FSCRmvOtlir&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>FSCLnksCnfnd&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>OtlierCrtria&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Notes&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkPhnotype&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LinkFitness&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>IndvidRepeat&nbsp;&nbsp;&nbsp;&nbsp;</th>

<th>Scatterplot&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>LabPI&nbsp;&nbsp;&nbsp;&nbsp;</th>";

if(isset($formLifeHistory)){
$head8 = $head8.$lifehistory_header;

}

///set up the select to get the selected hormone

if($hormone=="FSC_Mean"){
$sql = $query_FSC;
$cat = "group8";
}


/*else if
($hormone=="FT_Mean"){
$sql = $query2;
$cat = "group1";}
else if
($hormone=="MBC_Mean"){
$sql = $query3;
$cat = "group1";}
else if
($hormone=="FBC_Mean"){
$sql = $query4;
$cat = "group1";}*/

if($cat == "group8") {
	
	
$result = mysqli_query($con, $sql)or die(mysql_error());

echo '<button id="btnExport">Export to xls</button><div id="table_wrapper"><table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1"><thead><tr>';
if($hormone=="FSC_Mean"){
$head = $head8;}
/*else if
($hormone=="FT_Mean"){
$head = $head2;}
else if
($hormone=="MBC_Mean"){
$head = $head3;}
else if
($hormone=="FBC_Mean"){
$head = $head4;}*/
echo $head."</tr></thead><tbody>";

while ($row = $result->fetch_assoc()){
$Species_ID = $row["Species_ID"];
$Vert_Group = $row["Vert_Group"];
$Genus = $row["Genus"];
$Species = $row["Species"];
$Common_name = $row["Common_name"];
$Hormone_ID = $row["Hormone_ID"];
$Ref_ID = $row["Ref_ID"];
$First_Author = $row["First_Author"];
$YearPblished = $row["YearPblished"];
$Population_1 = $row["Population_1"];
$Population_2 = $row["Population_2"];
$Population_3 = $row["Population_3"];
$Pop_ID = $row["Pop_ID"];
$Latitude = $row["Latitude"];
$Longitude = $row["Longitud"];
$LatLongEstim = $row["LatLongEstim"];
$Elevation = $row["Elevation"];
$Years = $row["Years"];
$Year_1 = $row["Year_1"];
$Year_final = $row["Year_final"];

$Breeding_Cycle = $row["Breeding_Cycle"];
$Molt = $row["Molt"];
$Life_Stage = $row["Life_Stage"];
$LifeHistConf = $row["LifeHistConf"];

$January = $row["January"];
$February = $row["February"];
$March = $row["March"];
$April = $row["April"];
$May = $row["May"];
$June = $row["June"];
$July = $row["July"];
$August = $row["August"];
$September = $row["September"];
$October = $row["October"];
$November = $row["November"];
$December = $row["December"];
$OthrHormones = $row["OthrHormones"];
$Time_min = $row["Time_min"];
$Time_max = $row["Time_max"];


$CapturMethod = $row["CapturMethod"];
$SampleMethod = $row["SampleMethod"];
$LteStrsCort = $row["LteStrsCort"];
$StressorType = $row["StressorType"];
$MajorStrsPop =$row["MajorStrsPop"];


$CrtAntibdyKt = $row["CrtAntibdyKt"];
$CORT = $row["CORT"];
$Units = $row["Units"];

$FSC_Mean = $row["FSC_Mean"];
$FSC_SE = $row["FSC_SE"];
$FSC_CV = $row["FSC_CV"];
$FSC_N = $row["FSC_N"];
$FSC_Min = $row["FSC_Min"];
$FSC_Max = $row["FSC_Max"];


$FSCOrigData = $row["FSCOrigData"];
$FSCRmvOtlir = $row["FSCRmvOtlir"];
$FSCLnksCnfnd = $row["FSCLnksCnfnd"];
$OtlierCrtria = $row["OtlierCrtria"];
$Notes = $row["Notes"];
$LinkPhnotype = $row["LinkPhnotype"];
$LinkFitness = $row["LinkFitness"];
$IndvidRepeat = $row["IndvidRepeat"];
$Scatterplot = $row["Scatterplot"];
$LabPI= $row["LabPI"]; 

$LH_Pop_ID= $row["Pop_ID"];
$LHforPop=$row["LHforPop"]; 
$BodySizePop=$row["BodySizePop"]; 
$RefList=$row["RefList"]; 
$Habitat=$row["Habitat"]; 
$ReproMode=$row["ReproMode"]; 
$EggBirthMass=$row["EggBirthMass"]; 
$LitterClutchSize=$row["LitterClutchSize"]; 
$LitterClutchYear=$row["LitterClutchYear"]; 
$LongevityMax=$row["LongevityMax"]; 
$AveLifeExpect=$row["AveLifeExpect"]; 
$MTimeMatur=$row["MTimeMatur"]; 
$FTimeMatur=$row["FTimeMatur"]; 
$BodymassM=$row["BodymassM"]; 
$BodymassF=$row["BodymassF"]; 
$BodyMassSpecies=$row["BodyMassSpecies"]; 
$Parental_M=$row["Parental_M"]; 
$Parental_F=$row["Parental_F"]; 
$Migration=$row["Migration"]; 
$MatngSyst=$row["MatngSyst"]; 
$Incubation=$row["Incubation"]; 
$Gestation=$row["Gestation"]; 
$WeanFledgeDay=$row["WeanFledgeDay"]; 
$WeanFledgeMass=$row["WeanFledgeMass"]; 
$ReproInterval=$row["ReproInterval"]; 
$RepSesonal=$row["RepSesonal"]; 
$SeasonLngth=$row["SeasonLngth"]; 
$Survival=$row["Survival"]; 
$BMR=$row["BMR"];
$RMR=$row["RMR"];
$EggDiameter=$row["EggDiameter"];
$SocialBreed=$row["SocialBreed"];
$SocialNonbreed=$row["SocialNonbreed"];
$SocialNotes=$row["SocialNotes"];

 echo "<td>".$Species_ID."</td>
<td>".$Vert_Group."</td>
<td>".$Genus."</td>
<td>".$Species."</td>
<td>".$Common_name."</td>
<td>".$Hormone_ID."</td>
<td>".$Ref_ID."</td>
<td>".$First_Author."</td>
<td>".$YearPblished."</td>
<td>".$Population_1."</td>
<td>".$Population_2."</td>
<td>".$Population_3."</td>
<td>".$Pop_ID."</td>
<td>".$Latitude."</td>
<td>".$Longitude."</td>
<td>".$LatLongEstim."</td>
<td>".$Elevation."</td>
<td>".$Years."</td>
<td>".$Year_1."</td>
<td>".$Year_final."</td>

<td>".$Breeding_Cycle."</td>
<td>".$Molt."</td>

<td>".$Life_Stage."</td>
<td>".$LifeHistConf."</td>
<td>".$January."</td>
<td>".$February."</td>
<td>".$March."</td>
<td>".$April."</td>
<td>".$May."</td>
<td>".$June."</td>
<td>".$July."</td>
<td>".$August."</td>
<td>".$September."</td>
<td>".$October."</td>
<td>".$November."</td>
<td>".$December."</td>
<td>".$OthrHormones."</td>
<td>".$Time_min."</td>
<td>".$Time_max."</td>

<td>".$CapturMethod."</td>
<td>".$SampleMethod."</td>
<td>".$LteStrsCort."</td>
<td>".$StressorType."</td>
<td>".$MajorStrsPop."</td>

<td>".$CrtAntibdyKt."</td>
<td>".$CORT."</td>
<td>".$Units."</td>

<td>".$FSC_Mean."</td>
<td>".$FSC_SE."</td>
<td>".$FSC_CV."</td>
<td>".$FSC_N."</td>
<td>".$FSC_Min."</td>
<td>".$FSC_Max."</td>


<td>".$FSCOrigData."</td>
<td>".$FSCRmvOtlir."</td>
<td>".$FSCLnksCnfnd."</td>
<td>".$OtlierCrtria."</td>
<td>".$Notes."</td>
<td>".$LinkPhnotype."</td>
<td>".$LinkFitness."</td>
<td>".$IndvidRepeat."</td>
<td>".$Scatterplot."</td>
<td>".$LabPI."</td>";

if(isset($formLifeHistory)){
echo	

"<td>".$LH_Pop_ID."</td>
<td>".$LHforPop."</td>
<td>".$BodySizePop."</td>
<td>".$RefList."</td>
<td>".$Habitat."</td>
<td>".$ReproMode."</td>
<td>".$EggBirthMass."</td>
<td>".$LitterClutchSize."</td>
<td>".$LitterClutchYear."</td>

<td>".$LongevityMax."</td>
<td>".$AveLifeExpect."</td>
<td>".$MTimeMatur."</td>
<td>".$FTimeMatur."</td>
<td>".$BodymassM."</td>
<td>".$BodymassF."</td>
<td>".$BodyMassSpecies."</td>
<td>".$Parental_M."</td>
<td>".$Parental_F."</td>
<td>".$Migration."</td>
<td>".$MatngSyst."</td>
<td>".$Incubation."</td>
<td>".$Gestation."</td>
<td>".$WeanFledgeDay."</td>
<td>".$WeanFledgeMass."</td>
<td>".$ReproInterval."</td>
<td>".$RepSesonal."</td>
<td>".$SeasonLngth."</td>
<td>".$Survival."</td>
<td>".$BMR."</td>
<td>".$RMR."</td>
<td>".$EggDiameter."</td>
<td>".$SocialBreed."</td>
<td>".$SocialNonbreed."</td>
<td>".$SocialNotes."</td>
";
}
echo
"</tr>";


} echo '</tbody></table>
</div>';
}

/////add a references query
$queryref = "SELECT * FROM `references` ORDER BY `references`.`Ref_ID`";

$headref = "<th>Ref_ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>First_Author&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Author_All&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Journal&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>YearPblished&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Title&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Database&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>DateAccessed&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>DOI&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>ISBN&nbsp;&nbsp;&nbsp;&nbsp;</th>";

if($hormone=="References"){
$sql = $queryref;
$cat = "group9";}

if($cat =="group9") {
$result = mysqli_query($con, $sql)or die(mysql_error());
echo '<br /><button id="btnExport">Export to xls</button><div id="table_wrapper"><table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1"><thead><tr>';

$head = $headref;
echo $head."</tr></thead><tbody>";

while ($row = $result->fetch_assoc()){
	$Ref_ID = $row["Ref_ID"];
$First_Author = $row["First_Author"];
$Author_All = $row["Author_All"];
$Journal = $row["Journal"];
$YearPblished = $row["YearPblished"];
$Title = $row["Title"];
$Database  = $row["Database"];
$DateAccessed = $row["DateAccessed"];
$DOI  = $row["DOI"];
$ISBN = $row["ISBN"];

echo 
"<td>".$Ref_ID."</td>
<td>".$First_Author."</td>
<td>".$Author_All."</td>
<td>".$Journal."</td>
<td>".$YearPblished."</td>
<td>".$Title."</td>
<td>".$Database."</td>
<td>".$DateAccessed."</td>
<td>".$DOI."</td>
<td>".$ISBN."</td></tr>";

} echo '</tbody></table>
</div>';

}

?>
<script type="text/javascript"> 
$(document).ready(function() {
  $("#btnExport").click(function(e) {
    e.preventDefault();

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
</script>
</body>
</html>
