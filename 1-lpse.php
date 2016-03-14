<?php



##########################
#   DONT CHANGE HERE 
##########################
include('_inc/_config.php');
include('_inc/simple_html_dom.php');


# pilihan url sesuai mode
if ($mode === 'tes') {
	$uri = 'http://localhost/bahan/INAPROC%20-%20Portal%20Pengadaan%20Nasional%20(Indonesian%20Procurement).html';
} else {
	$uri = 'https://inaproc.lkpp.go.id/v3/daftar_lpse';  // production
}

$html = file_get_html($uri);

$r = '';
$no = -1;
foreach($html->find('tbody tr') as $link) {
	$no = $no + 1;
	if ($no <> 0) {
		$r .= $no.'|'.$link->find('td')[0]->plaintext.'|'.$link->find('td')[1]->plaintext.'|'.$link->find('.linkPaket')[0]->href." \r\n";
	}
}


$filename = 'data/lpse.txt';

file_put_contents($filename, $r);
echo 'Sukses';
