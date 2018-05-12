 <?php
    $current_file = basename($_SERVER['SCRIPT_NAME']);
    $chip = substr($current_file, 6, strpos($current_file, ".")-6);
    echo("$chip<br>");
    $conn = mysqli_connect("47.100.49.206", "root", "SRTPtest2018") or die("Could not connect to database.".mysqli_error());
    mysqli_select_db($conn, "content") or die("database selection failed<br>");
    $caption = mysqli_query($conn, "select caption from picandtext where id = '$chip'") or die("Select caption failed");//先拿5测试一下
    $url = mysqli_query($conn, "select picture_url from picandtext where id = '$chip'") or die("Select url failed");
    $caption = mysqli_fetch_array($caption);
    $caption = $caption['caption'];
    $url = mysqli_fetch_array($url);
    $url = $url['picture_url'];
    echo("<h1>$caption</h1>");
    echo("<br>");
    echo("<img src = $url>");
 ?>