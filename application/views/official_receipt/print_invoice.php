<!DOCTYPE html>
 <html><head>
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
            #table {
                font-family: sans-serif;
                border-collapse: collapse;
                width: 100%;
                font-size: 12px;
                text-align: center;
                line-height: 12px
            }

			#table2 {
                font-family: sans-serif;
                border-collapse: collapse;
                width: 50%;
                font-size: 12px;
                text-align: center;
                line-height: 12px
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 4px;
            }
            #table th {
                padding-top: 5px;
                padding-bottom: 5px;
                text-align: left;
                background-color: #fff;
                color: black;
                text-align: left;
            }

        </style>
</head><body >
	<h3>INVOICE</h3>
	<br><br>

	<table id="table" style="text-align: left;" >
		<tr>
			<td style="border: 1px solid black;width:49%">
			<span style="font-size: 13px;"><i><b>In Account With :</b> </i></span>
			<h3>PT. JAPENANSI NUSANTARA</h3>
			<p style="font: 12px;"> <b>INTERNATIONAL ADJUSTERS * SURVEYORS</b></p>
			<table id="table"  style="font: 11px;">
					<tr> 
						<td style="width: 160px;border: 1 !important;text-align: left;padding: 2px;vertical-align: text-top;" rowspan="3"><?= $sett_apps->alamat ?></td>
						<td style="text-align: left;border: 1 !important;vertical-align: text-top;">Tel : <?= $sett_apps->telpon ?> </td>
					</tr>
					<tr> 
						<td style="text-align: left;border: 1 !important;vertical-align: text-top;">Fax : <?= $sett_apps->fax ?> </td>
					</tr>
					<tr> 
						<td style="text-align: left;border: 1 !important;vertical-align: text-top;">Email : <?= $sett_apps->email ?> </td>
					</tr>
			</table>
			</td >
			<td style="border: 1px solid black;border-top-style: none;border-bottom-style: none;width:1%">
			</td >

			<td style="border: 1px solid black;width:49%">
				<span style="font-size: 13px;"><i> <b>Debit :</b> </i></span>
				<h3 style="margin-left: 10px;"><?= strtoupper($insurer_name) ?></h3>
				<table id="table"  style="font: 11px;margin-left: 7px;">
					<tr> 
						<td style="width: 160px;border: 1 !important;text-align: justify;padding: 2px;vertical-align: text-top;" rowspan="3"><?= $address ?></td>
						<td style="text-align: left;border: 1 !important;vertical-align: text-top;"> </td>
					</tr>
			</table>

			<table id="table"  style="font: 11px;">
					<tr> 
						<td style="width: 40px;border: 1 !important;text-align: left;vertical-align: text-top;">Bill No</td>
						<td style="width: 2px;text-align: left;border: 1 !important;vertical-align: text-top;">: </td>
						<td style="width: 100px;text-align: left;border: 1 !important;vertical-align: text-top;"><?= $invoice_no ?> </td>
						<td style="width: 20px;text-align: left;border: 1 !important;vertical-align: text-top;text-align:left">Date</td>
						<td style="width: 2px;text-align: left;border: 1 !important;vertical-align: text-top;">: </td>
						<td style="text-align: left;border: 1 !important;vertical-align: text-top;"><?= date('d-F-Y') ?></td>
					</tr>
					<tr> 
						<td style="width: 40px;border: 1 !important;text-align: left;vertical-align: text-top;">Our Ref</td>
						<td style="width: 2px;text-align: left;border: 1 !important;vertical-align: text-top;">: </td>
						<td style="width: 100px;text-align: left;border: 1 !important;vertical-align: text-top;" colspan="3"><?= $ref_no ?></td>
					</tr>
			</table>


			</td>
		</tr>
	</table>
	
	
	
<br><br>
<table id="table">
		<tr>
			<th style="border: 1px solid black;">
			<table id="table"  style="font: 12px; margin-left:10px;margin-right:30px;">
			<tr> 
                <td style="width: 70px;text-align: justify;border: 1 !important;vertical-align: text-top;">Assignment : </td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;" colspan="6">Survey and Adjusment on Windtrom Claim of <b><?= strtoupper($insured) ?></b> </td>
            </tr>
			<tr > 
                <td style="text-align: justify;border: 1 !important;vertical-align: text-top;"></td>
				<td style="width: 100px;text-align: justify;border: 1 !important;vertical-align: text-top;" >Situation of Damage</td>
				<td style="width: 3px;text-align: justify;border: 1 !important;vertical-align: text-top;">:</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;" colspan="4"><?= $situation_of_loss ?></td>
            </tr>
			<tr> 
                <td style="text-align: justify;border: 1 !important;vertical-align: text-top;"></td>
				<td style="width: 100px;text-align: justify;border: 1 !important;vertical-align: text-top;">Policy No</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;">:</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;" colspan="4"><?= $policy_number ?></td>
            </tr>
			<tr> 
                <td style="text-align: justify;border: 1 !important;vertical-align: text-top;"></td>
				<td style="width: 100px;text-align: justify;border: 1 !important;vertical-align: text-top;">Date of Loss</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;">:</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;" colspan="4"><?= $date_of_loss ?></td>
            </tr>
			<tr> 
                <td style="text-align: justify;border: 1 !important;vertical-align: text-top;"></td>
				<td style="width: 100px;text-align: justify;border: 1 !important;vertical-align: text-top;">Refer to OR No</td>
				<td style="width: 2px; text-align: justify;border: 1 !important;vertical-align: text-top;">:</td>
				<td style="width: 100px;text-align: justify;border: 1 !important;vertical-align: text-top;"><?= $or_no ?></td>
				<td style="width: 10px;text-align: justify;border: 1 !important;vertical-align: text-top;">Date</td>
				<td style="width: 3px;text-align: justify;border: 1 !important;vertical-align: text-top;">:</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;"><?= $or_date ?></td>
            </tr>
    </table> 
			</th>
		</tr>
		
	</table><br><br>

	<?php if($vat=='Before Expense'){ ?>
		<table id="table">
		<tr>
			<th style="border: 1px solid black;">
			<table id="table" border="" style="font: 12px; margin-left:10px;margin-right:30px;" >
			<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;"></th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;"></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"></td>
					<td style="width: 20%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"></td>
                </tr>
                <tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;height: 180px;">FEE <?= $percentage ?> %</th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;"></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"><?= $currency_code ?></td>
					<td style="width: 20%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"><?= rupiah($total_fee) ?></td>
                </tr>
				<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;"></th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;text-align: right;"><span style="margin-right: 20px;">(+) 10 % VAT</span></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"><?= $currency_code ?></td>
					<td style="width: 20%;text-align: right;border: 0 !important;vertical-align: text-top;font-size:14px"><?= rupiah(($total_fee)*10/100) ?></td>
                </tr>
				<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;"></th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;text-align: right;"> <span style="margin-right: 20px;">EXPENSE</span> </th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"> <?= $currency_code ?></td>
					<td style="width: 20%;border: 0 !important;text-align: right;vertical-align: text-top;font-size:14px"> <?= rupiah($expense) ?></td>
                </tr>
				<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;">DISBURSEMENT : </th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;text-align: right;"><span style="margin-right: 20px;">(-) Discount</span></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"><?= $currency_code ?></td>
					<td style="width: 20%;text-align: right;border: 0 !important;vertical-align: text-top;font-size:14px"><?= rupiah($discount) ?></td>
                </tr>
				<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;"></th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;"></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"></td>
					<td style="width: 20%;text-align: right;border: 0 !important;vertical-align: text-top;font-size:14px"></td>
                </tr>
        	</table>
			</th>
		</tr>
	</table>

	<?php }else if($vat=='After Expense'){ ?>
		<table id="table">
		<tr>
			<th style="border: 1px solid black;">
			<table id="table" border="" style="font: 12px; margin-left:10px;margin-right:30px;" >
			<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;"></th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;"></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"></td>
					<td style="width: 20%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"></td>
                </tr>
                <tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;height: 180px;">FEE <?= $percentage ?> %</th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;"></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"><?= $currency_code ?></td>
					<td style="width: 20%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"><?= rupiah($total_fee) ?></td>
                </tr>
				<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;"></th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;text-align: right;"> <span style="margin-right: 20px;">EXPENSE</span> </th>
					<td style="width: 10%;border-bottom: 1pt solid black;border-top-style: none;border-right-style: none;border-left-style: none;vertical-align: text-top;text-align: right; font-size:14px"> <?= $currency_code ?></td>
					<td style="width: 20%;border-bottom: 1pt solid black;border-top-style: none;border-right-style: none;border-left-style: none;text-align: right;vertical-align: text-top;font-size:14px"> <?= rupiah($expense) ?></td>
                </tr>
				<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;"></th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;"></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"><?= $currency_code ?></td>
					<td style="width: 20%;text-align: right;border: 0 !important;vertical-align: text-top;font-size:14px"><?= rupiah($total_fee + $expense) ?></td>
                </tr>
				<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;"></th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;"></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"></td>
					<td style="width: 20%;text-align: right;border: 0 !important;vertical-align: text-top;font-size:14px"></td>
                </tr>
				<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;"></th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;text-align: right;"><span style="margin-right: 20px;">(+) 10 % VAT</span></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"><?= $currency_code ?></td>
					<td style="width: 20%;text-align: right;border: 0 !important;vertical-align: text-top;font-size:14px"><?= rupiah(($total_fee + $expense)*10/100) ?></td>
                </tr>
				<tr> 
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;">DISBURSEMENT : </th>
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;text-align: right;"><span style="margin-right: 20px;">(-) Discount</span></th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"><?= $currency_code ?></td>
					<td style="width: 20%;text-align: right;border: 0 !important;vertical-align: text-top;font-size:14px"><?= rupiah($discount) ?></td>
                </tr>
        	</table>
			</th>
		</tr>
	</table>
	<?php } ?>



	<table
	 id="table">
		<tr>
			<th style="border: 1px solid black;">
			<table id="table" style="font: 12px; margin-left:10px;margin-right:30px;" >
				<tr> 
                    <th style="width: 70%;border: 0 !important;vertical-align: text-top;text-align: justify"></th>
					<td style="width: 10%;border-bottom: 1pt solid black;border-top-style: none;border-right-style: none;border-left-style: none;vertical-align: text-top;text-align: right; font-size:14px"> IDR</td>

					<?php if($vat=='Before Expense'){ ?>
						<td style="width: 20%;border-bottom: 1pt solid black;border-top-style: none;border-right-style: none;border-left-style: none;text-align: right;vertical-align: text-top;font-size:14px"> <b><?= rupiah((($total_fee + $expense)+($total_fee)*10/100)-$discount) ?></b> </td>
					<?php }else if($vat=='After Expense'){ ?>
						<td style="width: 20%;border-bottom: 1pt solid black;border-top-style: none;border-right-style: none;border-left-style: none;text-align: right;vertical-align: text-top;font-size:14px">  <b><?= rupiah((($total_fee + $expense)+($total_fee + $expense)*10/100)- $discount) ?></b></td>
					<?php } ?>
                </tr>

				<tr> 
                    <td style="width: 70%;border: 0 !important;vertical-align: text-top;text-align: left"></td>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"></td>
					<td style="width: 20%;text-align: right;border: 0 !important;vertical-align: text-top;font-size:14px"></td>
                </tr>
				<br><br>
        	</table>
			</th>
		</tr>
	</table><br><br>
	<table id="table">
		<tr>
			<th style="border: 1px solid black;">
			<table id="table"  style="font: 12px; margin-left:10px;margin-right:30px;" >
                <tr> 
                    <th style="text-align: justify;border: 1 !important;vertical-align: text-top;"> <b>IMPORTANT NOTE</b></th>
                    <td style="text-align: justify;border: 1 !important;vertical-align: text-top;"></td>
                </tr>
				
				<tr> 
                <td style="width: 60%px;text-align: justify;border: 1 !important;vertical-align: text-top;">
				The related Tax Invoice will be dated ad the end of the following month or upon payment
				receipt whichever comes earlier, the Tax Invoice, however, will be delivered to you after
				payment has been settled, We recommend therefore that payment is made before the
				end of next month, so that you can obtain credit for the value Added Tax (VAT) in the correct tax period.
				<p>Please remit the copy of bank transfer immediately to us, Income Tax (Article 23) should
					be withheld at 6% of the amount excluding VAT (there is no withholding on VAT)
				</p>
				<center><b>NPWP : 01-558-330-5-073-000</b></center>
				</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;"></td>
            </tr>
        	</table>
			</th>
		</tr>
	</table>

