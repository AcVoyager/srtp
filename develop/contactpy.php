<?php

    exec("python3.5 hanlptest.py 2>&1") or die("execution failed!");
    sleep(5);
    $myfile = fopen("temp.txt", "r");
    $content = fread($myfile, filesize("temp.txt"));
    //var_dump($content);
    echo $content;

?>
