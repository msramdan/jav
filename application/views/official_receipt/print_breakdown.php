<!DOCTYPE html>
 <html><head>
    <title>Breakdown</title>
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
	<center><h4>BREAKDOWN IN RESPECT OF FEE & EXPENSE</h4></center>
	<br><br>

	<table id="table" style="font: 12px;" >
            <tr> 
                <th style="width: 50%;border: 1 !important;vertical-align: text-top;">To : </th>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;"> Our Ref : <?= $ref_no ?> </td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;"> Date : <?= date('d-F-Y') ?> </td>
            </tr>
			<tr> 
                <td style="text-align: justify;border: 1 !important;vertical-align: text-top;"><b><?= strtoupper($insurer_name) ?></b> <br>
					<span  style="margin-right: 100px;"><?= $address ?></span><br>
					<span>f.a.o.</span> <b>Claim Dept.</b>
					
				</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;">Your Ref :</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;"></td>
            </tr>
    </table> <br><br>

<table id="table">
		<tr>
			<th style="border: 1px solid black;">
			<table id="table" style="font: 12px; margin-left:10px;margin-right:30px;">
			<tr> 
                <td style="width: 80px;text-align: justify;border: 1 !important;vertical-align: text-top;">Re</td>
				<td style="width: 2px;text-align: justify;border: 1 !important;vertical-align: text-top;">:</td>
				<td style="width: 350px;text-align: justify;border: 1 !important;vertical-align: text-top;">Survey and Adjustment on Windstoem Claim of <b><?= strtoupper($insured) ?></b> </td>
            </tr>
			<tr> 
                <td style="text-align: justify;border: 1 !important;vertical-align: text-top;">Situation of Damage</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;">:</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;"><?= $situation_of_loss ?></td>
            </tr>
			<tr> 
                <td style="text-align: justify;border: 1 !important;vertical-align: text-top;">Policy No</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;">:</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;"><?= $policy_number ?></td>
            </tr>
			<tr> 
                <td style="text-align: justify;border: 1 !important;vertical-align: text-top;">Date of Loss</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;">:</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;"><?= $date_of_loss ?></td>
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
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;height: 200px;">FEE <?= $percentage ?> %</th>
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
                    <th style="width: 30%;border: 0 !important;vertical-align: text-top;text-align: right;"> <span style="margin-right: 20px;">(-) Discount</span> </th>
					<td style="width: 10%;border: 0 !important;vertical-align: text-top;text-align: right; font-size:14px"> <?= $currency_code ?></td>
					<td style="width: 20%;border: 0 !important;text-align: right;vertical-align: text-top;font-size:14px"> <?= rupiah($discount) ?></td>
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
                    <th style="width: 40%;border: 0 !important;vertical-align: text-top;height: 200px;">FEE <?= $percentage ?> %</th>
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
	

	<table id="table">
		<tr>
			<th style="border: 1px solid black;">
			<table id="table" style="font: 12px; margin-left:10px;margin-right:30px;" >
				<tr> 
                    <th style="width: 70%;border: 0 !important;vertical-align: text-top;text-align: justify"><b><i>PLEASE PAY WITHIN 30 DAYS</i></b></th>
					<td style="width: 10%;border-bottom: 1pt solid black;border-top-style: none;border-right-style: none;border-left-style: none;vertical-align: text-top;text-align: right; font-size:14px"> <b><?= $currency_code ?></b></td>
					<?php if($vat=='Before Expense'){ ?>
						<td style="width: 20%;border-bottom: 1pt solid black;border-top-style: none;border-right-style: none;border-left-style: none;text-align: right;vertical-align: text-top;font-size:14px"><b><?= rupiah((($total_fee + $expense)+($total_fee)*10/100)-$discount) ?></b> </td>
					<?php }else if($vat=='After Expense'){ ?>
						<td style="width: 20%;border-bottom: 1pt solid black;border-top-style: none;border-right-style: none;border-left-style: none;text-align: right;vertical-align: text-top;font-size:14px"> <b><?= rupiah((($total_fee + $expense)+($total_fee + $expense)*10/100)- $discount) ?></b></td>
					<?php } ?>

				</tr>

				<tr> 
                    <td style="width: 70%;border: 0 !important;vertical-align: text-top;text-align: left">
					To our Rupiah Bank Account in Bank Mandiri (Ex EXIM Cabang Berdharma) 
					<span style="margin-right: 50px;">Jl. Jend. Sudirman Kav.32, Jakarta</span><b>A/C Number : 122-0097042942</b> <br>
					or US$ Bank Account in Standard Chartered Bank, Wisma Standard Chartered <br>
					<span style="margin-right: 41px;">Jl. Jend. Sudirman Kav.33A, Jakarta</span><b>A/C Number : 30 600 182344</b></td>

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
				<br><br>
				<center><b>NPWP : 01-558-330-5-073-000</b></center>
				</td>
				<td style="text-align: justify;border: 1 !important;vertical-align: text-top;"></td>
            </tr>
        	</table>
			</th>
		</tr>
	</table>

