<?php
    $weburl = "nothing";
    $weburl = $_POST['myurl'];//GET是测试用的
    
    $lll = fopen("showWebUrl", "w");
    fwrite($lll, $weburl);
    
    $weburltemp = explode('web/', $weburl);
    $weburl = "../" . $weburltemp[1];//todo
    
    fwrite($lll, "weburl = ".$weburl."\n");

    $content = file_get_contents($weburl);
    
    fwrite($lll, $content);
    
    $arr = explode('<P>', $content);
    $text_content = explode('</P>', $arr[1]);
    //echo $text_content[0];
    //echo("<br>");

    $myfile = fopen("php_to_python", "w");
    fwrite($myfile, $text_content[0]);
    fclose($myfile);
    sleep(1);

    $arr = explode('src=', $text_content[1]);
    $pic_url = explode('>', $arr[1]);
    $pic_url = $pic_url[0];
    //echo $pic_url;
    //echo("<br>");

    fwrite($lll, "\npic_url = ".$pic_url);

    exec("python3.5 hanlptest.py 2>&1", $output);
    //print_r($output);
    
    // sleep(2);
    $myfile = fopen("python_to_php", "r");
    $content = fread($myfile, filesize("python_to_php"));
    //echo $content;
    //echo("<br>");

    $ajaxArr = array();
    exec("curl -F 'image=@" . $pic_url . "' -H 'api-key:a85afe89-a18b-4691-a932-edb39071475b' https://api.deepai.org/api/neuraltalk > captionTemp.json");
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

//    $caption = iconv("GBK", "UTF-8", $caption);
//    $text_content[0] = iconv("GBK", "UTF-8", $text_content[0]);
//    $content = iconv("GBK", "UTF-8", $content);
    /*
    $encoding = mb_detect_encoding($caption, mb_detect_order(), false);
    echo "encoding of caption is $encoding.<br>";
    $encoding = mb_detect_encoding($text_content[0], mb_detect_order(), false);
    echo "encoding of src text is $encoding.<br>";
    $encoding = mb_detect_encoding($content, mb_detect_order(), false);
    echo "encoding of content is $encoding.<br>";
    */
    
    $myObj->pic_url = $pic_url;
    $myObj->pic_caption = $caption;
    $myObj->src_text = $text_content[0];
    $myObj->tags = $content;

    $myJSON = json_encode($myObj);
    header('Content-Type: application/json');
    echo $myJSON;

    $ttt = json_decode($myJSON);
    fwrite($lll, $ttt->pic_url."\n".$ttt->pic_caption."\n".$ttt->src_text."\n".$ttt->tags);
    fclose($lll);
    /*$myJSON = json_decode($myJSON);
    echo ($myJSON->pic_url);
    echo "<br>";
    echo ($myJSON->pic_caption);
    echo "<br>";
    echo ($myJSON->src_text);
    echo "<br>";
    echo ($myJSON->tags);
    echo "<br>";*/
?>
