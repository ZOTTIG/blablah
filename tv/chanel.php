<?php
    //пиздинг
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_COOKIEFILE, '1.txt');
    curl_setopt($ch, CURLOPT_URL, "http://tv.yandex.kz/162/channels/".intval($_GET['chanel']));
    $content=curl_exec($ch);
    curl_close();
    
    //инициализинг
    $program=array();
    
    //парсинг
    preg_match_all("~<div class=\"b-tv-event(.*)</div>~Uis",$content,$matches);
    foreach($matches[1] as $match){
       preg_match("~<span class=\"b-tv-event__time\">(.*)</span><span class=\"(.*)><a (.*)>(.*)</a></span>~Uis",$match,$tv);
       $program[]=array('time'=>$tv[1],'title'=>$tv[4]);
    }
    
    //принтинг
    print_r($program);

?>