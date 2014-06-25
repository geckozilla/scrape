<?php

include 'simple_html_dom.php';
include 'htmLawed.php';

$html =  file_get_contents("https://inaproc.lkpp.go.id/v3/ipengumuman/terbaru");

$html = gg($html);
$html = str_get_html($html);

//echo $html;
$r = array();
// Find all links 
foreach($html->find('a') as $element) {
    $r[] = $element->href ;
}

       
$r = array_filter($r, "ada");
$r = implode("|", $r);

//var_dump($r);

#1: jadikan json
#2: simpan ke raw.json
file_put_contents('urls.txt', $r);



#3: open data pertama buka url

#4: scrape content












function ada($var)
{
    // returns whether the input integer is even
    return((strrpos($var,'/terbaru/')) > 1);
}



// gzipdecode fast way
function gg($data){
   $g=tempnam('/tmp','ff');
   @file_put_contents($g,$data);
   ob_start();
   readgzfile($g);
   $d=ob_get_clean();
   return $d;
}

