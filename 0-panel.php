<?php
$file_lpse = 'data/lpse.txt';
?>

<h1>Panel</h1>

<b>STATUS</b>
<br />

<table border="1"  cellspacing="0" cellpadding="5">
	<tr>
		<td>NO</td>
		<td>NAMA</td>
		<td>STATUS</td>
	</tr>
	<tr>
		<td>1</td>
		<td>Data LPSE</td>
		<td><?php echo cek($file_lpse);?></td>
	</tr>
	<tr>
		<td>2</td>
		<td>Data Lelang</td>
		<td>STATUS</td>
	</tr>
</table>

<hr />




<?php
if (file_exists($file_lpse)) {
	
	if ($stream = fopen($file_lpse, 'r')) {
	    // print the first 5 bytes
	    $isi = stream_get_contents($stream);
	    fclose($stream);
	    echo '<h4>LPSE List</h4>';
		$isis = explode(" \r\n", $isi);

		echo '<table border="1"  cellspacing="0" cellpadding="5">';
		echo '	<tr>
				<td>NO</td>
				<td>LPSE</td>
				<td>KODE</td>
				<td>STATUS DATA AWAL</td>
				<td>ID LELANG TERAKHIR</td>
				</tr>
			';
		foreach ($isis as $res) {
			$r = explode("|", $res);
			if (isset($r[3])) {
				echo '<tr>';
				echo '<td>'.$r[0].'</td>';
				echo '<td><a target="_blank" href="'.$r[3].'">'.$r[2].'</a></td>';
				echo '<td>'.$r[1].'</td>';
				echo '<td>';
				if (file_exists('data/data-awal/data-'.$r[1].'.txt')) {
					echo 'ok - ';
					echo '<a target="_blank" href="data/data-awal/data-'.$r[1].'.txt">Cek</a>';
				} else {
					echo '<a href="x-scrape-lpse.php?id_lpse='.$r[1].'&page=0">SCRAPE NOW</a>';
				}
				echo '</td>';
				echo '<td>idnya</td>';
				echo '</tr>';
			}
		}
		echo '</table>';
	}

}






function cek($filename) {
	if (file_exists($filename)) {
		$status = 'ada';
	} else {
		$status = 'tidak ada';
	}
	return $status;
}

