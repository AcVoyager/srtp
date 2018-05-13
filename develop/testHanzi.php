<?php
    $text = "哲学家";
    echo "$text<br>";
    $encoding = mb_detect_encoding($text, mb_detect_order(), false);
    echo "$encoding<br>";
    $text2 = json_encode($text);
    $text2 = json_decode($text2);
    $encoding = mb_detect_encoding($text, mb_detect_order(), false);
    echo "$encoding<br>";
    echo "$text2<br>";
    $text3 = iconv("Unicode", "UTF-8", $text2);
    echo "$text3<br>";
?>
