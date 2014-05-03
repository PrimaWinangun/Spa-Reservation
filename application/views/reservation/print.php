<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<style type="text/css">
html {
	margin : 0px;
}
table.gridtable {
	font-family: times,arial,sans-serif;
	font-size:9px;
	width: 6.700cm; 
	
}
table.gridtable td {
	padding: 0px;
	text-align: left;
}
</style>

</head>
<body>
<table class="gridtable">
	<tr>
		<td><?php //echo '010-900-'.$db->nofaktur;?></td>
		<td></td>
		<td><?php //echo 'No. DBI '.$db->nodb; ?></td>
	</tr>
	<tr>
		<td colspan="3" align="center"  style="font-size:250%" ><strong><?php echo strtoupper($title)?></strong></td>
	</tr>
	<tr>
		<td colspan="3" align="center" >GEDUNG DANPERA LT 1,2 & 3 KOTA BARU</td>
	</tr>
	<tr>
		<td colspan="3" align="center" >BANDAR KEMAYORAN BLOK B 12 KAV No.8</td>
	</tr>
	<tr>
		<td colspan="3" align="center" >KEMAYORAN JAKARTA PUSAT 10610</td>
	</tr>
	<tr>
		<td colspan="3" align="center" >NPWP : 01.061.170.5-093.000</td>
	</tr>
	<tr>
		<td colspan="3" align="center" ><hr/></td>
	</tr>
	<tr>
		<td colspan="3" align="center" >NOTA PEMBAYARAN JASA GUDANG</td>
	</tr>
	<tr>
		<td colspan="3" align="center" ><hr/></td>
	</tr>
	<tr>
		<td colspan="3" align="center"><br/>DATA PRODUCT</td>
	</tr>
    <tr>
		<td>Reservation Code</td><td>:</td><td><?php echo $res_code; ?></td>
	</tr>
</table>
<table class="gridtable">
	<tr>
		<td colspan="5"><hr/></td>
	</tr>
	<tr>
		<td align="center" width="10%">NO</td>
		<td align="center" width="26%">PRODUK</td>
		<td align="center" width="12%">JML</td>
		<td align="center" width="22%">HARGA</td>
		<td align="center" width="28%">SUBTOTAL</td>
	</tr>
	<tr>
		<td colspan="5" align="center"><hr></td>
	</tr>
	
<?php 
$no=0;
$total_bayar=0;
foreach($data_pax as $row_pax)
{ $no++;
	$pay  = $row_pax['rpd_rate']*$row_pax['rpd_quantity'];
	$total_bayar  = $total_bayar + $pay;
	
?>	
	<tr>
		<td align="center"><?php echo $no; ?></td>
		<td align="left"><?php echo $row_pax['rpd_product']; ?></td>
		<td align="center"><?php echo $row_pax['rpd_quantity']; ?></td>
		<td align="right"><?php echo number_format($row_pax['rpd_rate'], 0, ',', '.'); ?></td>
		<td align="right"><?php echo number_format(($row_pax['rpd_rate']*$row_pax['rpd_quantity']), 0, ',', '.'); ?></td>
	</tr>
<?php } ?>
	<tr>
		<td colspan="5"><hr/></td>
	</tr>
	<tr>
		<td colspan="4"><?php echo "TOTAL"; ?></td>
		<td align="right"><?php echo number_format($total_bayar, 0, ',', '.'); ?></td>
	</tr>
    <tr>
		<td colspan="5">&nbsp;</td>
	</tr>
</table>
</body>
</html>