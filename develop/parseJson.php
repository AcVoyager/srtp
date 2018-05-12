<?php

$myfile = fopen("vis.json", "r") or die("Unable to open vis.json!");
$content =  fread($myfile, filesize("vis.json"));
$content = json_decode($content);

$conn = mysqli_connect("47.100.49.206", "root", "SRTPtest2018");
if(!$conn){
    die("Could not connect to database.".mysqli_error());
}
else{
    echo("Connect succeed!"."<br>");
}

$counter = 1;

mysqli_select_db($conn, "content") or die("database selection failed<br>");

var_dump($content);
//$sql = "insert into picandtext(id, picture_url, caption) values ('1', 'here', 'yeah')";
//mysqli_query($conn, $sql) or die("insert failed<br>");
echo("before loop<br>");
foreach($content as $unit){
    echo("loop<br>");
    $url = "/srtp/web/images/library/img".$unit->image_id.".jpg";
    $caption = $unit->caption;
    $sql = "insert into picandtext(id, picture_url, caption) values ('$counter', '$url', '$caption')";
    try{
        mysqli_query($conn, $sql) or die("insert failed<br>");
    }
    catch(Exception $e){
        echo 'Message: ' .$e->getMessage()."<br>";
    }
    $counter++;
}
echo("after loop<br>");

?>
