<?php
    $weburl = $_GET['myurl'];
    $content = file_get_contents($weburl);
    $arr = explode('<P>', $content);
    $text_content = explode('</P>', $arr[1]);
    echo $text_content[0];
    echo("<br>");

    $myfile = fopen("php_to_python", "w");
    fwrite($myfile, $text_content[0]);
    fclose($myfile);
    sleep(2);

    $arr = explode('src=', $text_content[1]);
    $pic_url = explode('>', $arr[1]);
    $pic_url = $pic_url[0];
    echo $pic_url;
    echo("<br>");

    exec("python3.5 hanlptest.py 2>&1", $output);
    //print_r($output);
    
    sleep(5);
    $myfile = fopen("python_to_php", "r");
    $content = fread($myfile, filesize("python_to_php"));
    echo $content;
    echo("<br>");

    $ajaxArr = array();
    exec("./getImageCaption.sh > captionTemp.json");
//    var_dump($ajaxArr);
    $captionFile = fopen("captionTemp.json", "r");
    $caption = fread($captionFile, filesize("captionTemp.json"));
    $caption = json_decode($caption);
    $caption = $caption->output;
    fclose($captionFile);
//    echo "<br>";

    include "baidu_transapi.php";
    $caption = translate($caption, "en", "zh");
    $caption = $caption["trans_result"][0]["dst"];

    $caption = iconv("GBK", "UTF-8", $caption);
    $text_content[0] = iconv("GBK", "UTF-8", $text_content[0]);
    $content = iconv("GBK", "UTF-8", $content);

    $myObj->pic_url = $pic_url;
    $myObj->pic_caption = $caption;
    $myObj->src_text = $text_content[0];
    $myObj->tags = $content;

    $myJSON = json_encode($myObj);
    echo $myJSON;
?>
