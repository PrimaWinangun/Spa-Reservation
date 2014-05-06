<script type="text/javascript">
function hitungtotal()
{
	var rate = document.getElementById("rate");
	var rate_dollar =document.getElementById("rate_dollar");
	var ppn = document.getElementById("tax");
	var dis = document.getElementById("dis");
	var disc_idr = document.getElementById("dis_idr");
	var disc_usd = document.getElementById("dis_usd");
	
	var dis_idr = Number(dis.value)*Number(rate.value)/100;
	var dis_usd = Number(dis.value)*Number(rate_dollar.value)/100;

	var total_idr = Number(rate.value) - dis_idr;
	var total_usd = Number(rate_dollar.value) - dis_usd;

	var tax_idr = Number(ppn.value)*total_idr/100;
	var tax_usd = Number(ppn.value)*total_usd/100;

	var final_idr = total_idr + tax_idr;
	var final_usd = total_usd + tax_usd;
	
	var pay_type = '';
	var discount = 0;
	

	document.getElementById("dis_idr").value = dis_idr;
	document.getElementById("dis_usd").value = dis_usd.toFixed(2);
	document.getElementById("tax_idr").value = tax_idr;
	document.getElementById("tax_usd").value = tax_usd.toFixed(2);
	document.getElementById("grand_idr").value = final_idr;
	document.getElementById("grand_usd").value = final_usd.toFixed(2);
	document.getElementById("grand_idr_2").value = 0;
	document.getElementById("grand_usd_2").value = 0;
}

function hitungPaymentType()
{
	var rate = document.getElementById("rate");
	var rate_dollar =document.getElementById("rate_dollar");
	var ppn = document.getElementById("tax");
	var pay_type = document.getElementById("promo").value;
	var discount = 0;
	
	<?php foreach ($payment_type as $pay_row){ 
		echo 'if ( pay_type == "'.$pay_row->pay_payment_type.'") { discount = '.$pay_row->pay_discount.'}';
	} ?>
	
	var dis_idr = Number(rate.value)*discount/100;
	var dis_usd = Number(rate_dollar.value)*discount/100;
	
	var total_idr = Number(rate.value) - dis_idr;
	var total_usd = Number(rate_dollar.value) - dis_usd; 

	var tax_idr = Number(ppn.value)*total_idr/100;
	var tax_usd = Number(ppn.value)*total_usd/100;

	var final_idr = total_idr + tax_idr;
	var final_usd = total_usd + tax_usd;

	document.getElementById("tax_idr").value = tax_idr;
	document.getElementById("tax_usd").value = tax_usd.toFixed(2);
	document.getElementById("dis").value = discount;
	document.getElementById("dis_idr").value = dis_idr;
	document.getElementById("dis_usd").value = dis_usd.toFixed(2);
	document.getElementById("grand_idr").value = final_idr;
	document.getElementById("grand_usd").value = final_usd.toFixed(2);
	document.getElementById("grand_idr_2").value = 0;
	document.getElementById("grand_usd_2").value = 0;
}

function hitungdiscount()
{
	var rate = document.getElementById("rate");
	var rate_dollar =document.getElementById("rate_dollar");
	var ppn = document.getElementById("tax");
	var disc_idr = document.getElementById("dis_idr");
	var disc_usd = document.getElementById("dis_usd");

	var total_idr = Number(rate.value) - Number(disc_idr.value);
	var total_usd = Number(rate_dollar.value) - Number(disc_usd.value); 

	var tax_idr = Number(ppn.value)*total_idr/100;
	var tax_usd = Number(ppn.value)*total_usd/100;

	var final_idr = total_idr + tax_idr;
	var final_usd = total_usd + tax_usd;

	document.getElementById("tax_idr").value = tax_idr;
	document.getElementById("tax_usd").value = tax_usd.toFixed(2);
	document.getElementById("grand_idr").value = final_idr;
	document.getElementById("grand_usd").value = final_usd.toFixed(2);
	document.getElementById("grand_idr_2").value = 0;
	document.getElementById("grand_usd_2").value = 0;
}

function hitungpayment_idr()
{
	var payment_idr_1 = document.getElementById("grand_idr");
	var payment_idr_2 = document.getElementById("grand_idr_2");
	var rate = document.getElementById("rate");
	var ppn = document.getElementById("tax");
	var tax = Number(ppn.value)*Number(rate.value)/100;
	
	if (Number(payment_idr_2.value) == 0)
	{
		document.getElementById("grand_idr").value = Number(rate.value)+tax;
	} else {
		if (Number(payment_idr_2.value) > Number(payment_idr_1.value))
		{
			alert('overlimit');
			
			document.getElementById("grand_idr_2").value = 0;
		} else {
			var grand_idr_1 = Number(payment_idr_1.value) - Number(payment_idr_2.value);

			document.getElementById("grand_idr").value = grand_idr_1;
		}
	}
}

function hitungpayment_usd()
{
	var payment_usd_1 = document.getElementById("grand_usd");
	var payment_usd_2 = document.getElementById("grand_usd_2");
	var rate = document.getElementById("rate_dollar");
	var ppn = document.getElementById("tax");
	var tax = Number(ppn.value)*Number(rate.value)/100;
	
	if (Number(payment_usd_2.value) == 0)
	{
		document.getElementById("grand_usd").value = (Number(rate.value)+tax).toFixed(2);
	} else {
		if ((Number(payment_usd_2.value) > Number(payment_usd_1.value)))
		{
			alert('overlimit');
			
			document.getElementById("grand_usd_2").value = 0;
		} else {
			var grand_usd_1 = Number(payment_usd_1.value) - Number(payment_usd_2.value); 

			document.getElementById("grand_usd").value = grand_usd_1.toFixed(2);
		}
	}
}

function disabledEnabled()
{
	var pay_type = document.getElementById("pay_type_2").value;
	
	var rate_idr = document.getElementById("rate");
	var rate_usd = document.getElementById("rate_dollar");
	var ppn = document.getElementById("tax");
	var tax_idr = Number(ppn.value)*Number(rate_idr.value)/100;
	var tax_usd = Number(ppn.value)*Number(rate_usd.value)/100;
	
	if ( pay_type != '-')
	{
		if ( pay_type == 'Credit_Card' || pay_type == 'Debit_Card')
		{
			$('.cc_detail').show();
			$("#cc_id").removeAttr("disabled"); 
			$("#cc_name").removeAttr("disabled"); 
		} else {
			$('.cc_detail').hide();
			$("#cc_id").attr("disabled", "disabled"); 
			$("#cc_name").attr("disabled", "disabled"); 
		}
		$("#grand_idr_2").removeAttr("disabled"); 
		$("#grand_usd_2").removeAttr("disabled"); 
	} else {
		document.getElementById("grand_usd").value = (Number(rate_usd.value)+tax_usd).toFixed(2);
		document.getElementById("grand_usd_2").value = 0;
		document.getElementById("grand_idr").value = Number(rate_idr.value)+tax_idr;
		document.getElementById("grand_idr_2").value = 0;
		
		$("#grand_idr_2").attr("disabled", "disabled"); 
		$("#grand_usd_2").attr("disabled", "disabled"); 
		$('.cc_detail').hide();
		$("#cc_id").attr("disabled", "disabled"); 
		$("#cc_name").attr("disabled", "disabled"); 
	}
}

function showCCDetail()
{
	var pay_type = document.getElementById("pay_type").value;
	if ( pay_type == 'Credit_Card' || pay_type == 'Debit_Card')
	{
		$('.cc_detail').show();
		$("#cc_id").removeAttr("disabled"); 
		$("#cc_name").removeAttr("disabled"); 
	} else {
		$('.cc_detail').hide();
		$("#grand_idr_2").attr("disabled", "disabled"); 
		$("#grand_usd_2").attr("disabled", "disabled"); 
	}
}

</script>