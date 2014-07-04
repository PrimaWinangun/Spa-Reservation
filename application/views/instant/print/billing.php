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
	width: 6.800cm; 
	
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
		<td colspan="3" align="center"  style="font-size:200%" ><strong><?php echo strtoupper($title)?></strong></td>
	</tr>
	<tr>
		<td colspan="3" align="center" >JL. Raya Kuta No. 46A, Br. Abianbase - Kuta</td>
	</tr>
	<tr>
		<td colspan="3" align="center" >No. Telp :(0361) 757725</td>
	</tr>
	<tr>
		<td colspan="3" align="center" >www.thebanjarbali.com</td>
	</tr>
	<tr>
		<td colspan="3" align="center" ></td>
	</tr>
</table>
<table class="gridtable">
	<tr>
		<td colspan="4" align="center" ><hr/></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><br/></td>
	</tr>
    <tr>
		<td width="30%">Reservation</td><td width="10%">:</td><td colspan="2"><?php echo $res_code; ?></td>
	</tr> 
	<tr>
		<td>Payment</td><td>:</td><td colspan="2"><?php echo $pay_code; ?></td>
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
$total_idr = 0;
$total_usd = 0;
foreach($data_pax as $row_pax)
{ $no++;
	$pay  = $row_pax['irpd_rate']*$row_pax['irpd_quantity'];
	if ($row_pax['irpd_rate_payment'] == 'dollar')
	{
		$rate = $row_pax['irpd_rate_dollar'];
		$harga = $rate * $row_pax['irpd_quantity'];
		$total_usd = $total_usd + $harga;
	} else {
		$rate = $row_pax['irpd_rate'];
		$harga = $rate * $row_pax['irpd_quantity'];
		$total_idr = $total_idr + $harga;
	}
	
?>	
	<tr>
		<td align="center"><?php echo $no; ?></td>
		<td align="left"><?php echo $row_pax['irpd_product']; ?></td>
		<td align="center"><?php echo $row_pax['irpd_quantity']; ?></td>
		<?php if ($row_pax['irpd_rate_payment'] == 'dollar')
			  {?>
		<td align="right"><?php echo number_format($rate, 3, ',', '.'); ?></td>
		<td align="right"><?php echo number_format($harga, 3, ',', '.'); ?></td>
		<?php }else{?>
				<td align="right"><?php echo number_format($rate, 2, ',', '.'); ?></td>
				<td align="right"><?php echo number_format($harga, 2, ',', '.'); ?></td>
		<?php }?>
	</tr>
<?php } ?>
</table>
<table class="gridtable">
	<tr>
		<td colspan="5"><hr/></td>
	</tr>
	<tr>
		<td width="23%"><?php echo "Subtotal"; ?></td>
		<td width="14%">USD</td><td align="right" width="24%"><?php echo number_format($total_usd, 3, ',', '.'); ?></td>
		<td width="14%">IDR</td><td align="right" width="24%"><?php echo number_format($total_idr, 0, ',', '.'); ?></td>
	</tr>
	<tr>
		<td><?php echo "Discount"; ?></td>
		<td>USD</td><td align="right"><?php echo number_format($data_pay['irb_discount'], 3, ',', '.'); ?></td>
		<td>IDR</td><td align="right"><?php echo number_format($data_pay['irb_discount_rp'], 0, ',', '.'); ?></td>
	</tr>
	<tr>
		<td><?php echo "Tax"; ?></td>
		<td>USD</td><td align="right"><?php echo number_format($data_pay['irb_tax'], 3, ',', '.'); ?></td>
		<td>IDR</td><td align="right"><?php echo number_format($data_pay['irb_tax_rp'], 0, ',', '.'); ?></td>
	</tr>
	<tr>
		<td colspan="5"><hr/></td>
	</tr>
</table>
<table class="gridtable">
	<tr>
		<td width="15%"><?php echo "Total"; ?></td><td width="17%"><?php echo str_replace('_',' ',$data_pay['irb_payment_type'])?></td>
		<td width="13%">USD</td><td align="right" width="20%"><?php echo number_format($data_pay['irb_paid_usd'], 3, ',', '.'); ?></td>
		<td width="13%">IDR</td><td align="right" width="21%"><?php echo number_format($data_pay['irb_paid_idr'], 0, ',', '.'); ?></td>
	</tr>
	<?php if ($data_pay['irb_payment_type_2'] != '-') {?>
	<tr>
		<td></td><td><?php echo str_replace('_',' ',$data_pay['irb_payment_type_2'])?></td>
		<td>USD</td><td align="right"><?php echo number_format($data_pay['irb_paid_usd_2'], 3, ',', '.'); ?></td>
		<td>IDR</td><td align="right"><?php echo number_format($data_pay['irb_paid_idr_2'], 0, ',', '.'); ?></td>
	</tr>
	<?php } ?>
    <tr>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">Transaction By :  </td><td colspan="3"><?php echo $data_pay['irb_transaction_by']?></td>
	</tr>
	<tr>
		<td colspan="3" height="30px">Date :  </td><td colspan="3"><?php echo $data_pay['irb_paid_date']?></td>
	</tr>
	<tr>
		<td colspan="6" height="10px"></td>
	</tr>
	<tr>
		<td colspan="6" align="center">Terima Kasih Atas Kunjungan Anda</td>
	</tr>
</table>
</body>
</html>