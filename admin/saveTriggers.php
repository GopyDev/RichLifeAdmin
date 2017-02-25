<?php
include ("../include.php");

$data = $_REQUEST['data'];

if(substr($data, -12) === ",separatechr")
  $data = substr($data, 0, -12);

$rowdata = explode("separatechr,", $data);
$sql = "insert into triggers(name,distance,frole,timeofday,lrole,delay)values";
foreach ($rowdata as $value) {
  if(substr($value, -1) === ",")
    $val = substr($value, 0, -1);
  else if(substr($value, -2) === ",,")
    $val = substr($value, 0, -2);
  else
    $val = $value;
  $cells = explode(",", $val);
  $name = $cells[0];
  $distance = $cells[1];
  $frole = $cells[2];
  $lrole = $cells[4];
  $delay = $cells[5];
  $timeofday="";
  for($i=0;$i<strlen($cells[3])/5;$i++)
    $timeofday .= substr($cells[3],$i*5,5).",";
  if(substr($timeofday, -1) === ",")
    $timeofday = substr($timeofday, 0, -1);

  $sql.="('".$name."','".$distance."','".$frole."','".$timeofday."','".$lrole."','".$delay."'),";
}
if(substr($sql, -1) === ",")
  $sql = substr($sql, 0, -1);

$sql_query = "TRUNCATE TABLE triggers";
$res_insert=setXbyY($sql_query,"assoc");

$res_insert=setXbyY($sql,"assoc");

?>