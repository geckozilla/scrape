<?php
# get jumlah halaman
# get id lelang terakhir


include('_inc/simple_html_dom.php');
$uri = 'http://localhost/bahan/lelang.html';   // testing
//$uri = 'http://www.lpse.trenggalekkab.go.id/eproc/lelang';   // production

$html = file_get_html($uri);

$r['jumlah'] = count($html->find('.t-data-grid-pager a')) + 1;


$r['terakhir'] = trim(explode('/view/', $html->find('.pkt_nama .jpopup')[0]->href)[1]);








var_dump($r);