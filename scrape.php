<?php
error_reporting(0);
ini_set('display_errors', 0);


$website = 'http://localhost/scrape.php?id=';
include 'simple_html_dom.php';
include 'htmLawed.php';



$url = explode('|', file_get_contents('urls.txt'));

if (isset($_GET['id'])) {
   $id = $_GET['id'];
} else {
   $id = 0;
}


if ($url[$id] == '') {
   exit('<hr />DONE<hr />');
}

$nextid = $id + 1;
$url_now = 'https://inaproc.lkpp.go.id'.$url[$id];

echo $url_now;

$html =  file_get_contents($url_now);

$html = gg($html);
$html = str_get_html($html);



// Find all links 
foreach($html->find('table tr') as $element) {
    $r['lpse'][] = trim(preg_replace("/[ \t]+/", " ", $element->find('td', 0)->plaintext));
    $r['satker'][] = trim(preg_replace("/[ \t]+/", " ", $element->find('td', 1)->plaintext));
    $r['paket'][] = trim(preg_replace("/[ \t]+/", " ", $element->find('td', 2)->plaintext));
    $r['uri'] = $element->find('a', 0)->href;
    $r['hps'][] = trim(preg_replace("/[ \t]+/", " ", $element->find('td', 3)->plaintext));
    $r['valid'][] = trim(preg_replace("/[ \t]+/", " ", $element->find('td', 4)->plaintext));
    $r['eproc'][] = trim(preg_replace("/[ \t]+/", " ", $element->find('td', 5)->plaintext));
}






       
var_dump($r);

$urlnext = $website.$nextid;

echo '<hr />Redir<hr />';
//redirect($urlnext,2);


// gzipdecode fast way
function gg($data){
   $g=tempnam('/tmp','ff');
   @file_put_contents($g,$data);
   ob_start();
   readgzfile($g);
   $d=ob_get_clean();
   return $d;
}

//redir

function redirect($url=false, $time = 0) {
   $url = $url ? $url : $_SERVER['HTTP_REFERER'];
   
   if(!headers_sent()){
      if(!$time){
         header("Location: {$url}"); 
      }else{
         header("refresh: $time; {$url}");
      }
   }else{
      echo "<script> setTimeout(function(){ window.location = '{$url}' },". ($time*1000) . ")</script>"; 
   }
}