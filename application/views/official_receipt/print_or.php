<!DOCTYPE html>
 <html><head>
    <title>Official Receipt</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
            #table {
                font-family: sans-serif;
                border-collapse: collapse;
                width: 100%;
                font-size: 12px;
                text-align: center;
                line-height: 6px
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
<table id="table">
		<tr>
			<th style="border: 1px solid black;">
			<h1 style="margin-top: 0px;">PT. JAPENANSI NUSANTARA</h1>
			<p style="font: 13px;"> <b>INTERNATIONAL ADJUSTERS * SURVEYORS</b></p>

			<table id="table"  style="font: 12px;">
					<tr> 
						<td style="width: 180px;border: 1 !important;text-align: left;padding: 2px;vertical-align: text-top;" rowspan="3"><?= $sett_apps->alamat ?></td>
						<td style="text-align: left;border: 1 !important;vertical-align: text-top;">Tel : <?= $sett_apps->telpon ?> </td>
					</tr>
					<tr> 
						<td style="text-align: left;border: 1 !important;vertical-align: text-top;">Fax : <?= $sett_apps->fax ?> </td>
					</tr>
					<tr> 
						<td style="text-align: left;border: 1 !important;vertical-align: text-top;">Email : <?= $sett_apps->email ?> </td>
					</tr>
			</table>
			<center>
				<h1>OFFICIAL RECEIPT</h1>
			</center><br><br>
			<h3 style="margin-left:18px">No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?= $or_no ?></h5>
			<br>

			</th>
		
		</tr>
		
	</table>
	<p></p>
	
	<table id="table">
		<tr>
			<th style="border: 1px solid black;">
			<table id="table" style="font: 12px; margin-left:10px;margin-right:30px;" >
                <tr> 
                    <th style="width: 120px;border: 0 !important;vertical-align: text-top;">Received From</th>
                    <th style="width: 2px;border: 0 !important;vertical-align: text-top;">:</th>
					<td style="text-align: justify;border: 0 !important;vertical-align: text-top;"> <b><?= strtoupper($insurer_name) ?></b></td>
                </tr>
				<tr>
                    <th style="width: 120px;border: 0 !important;vertical-align: text-top;">Address</th>
                    <th style="width: 2px;border: 0 !important;vertical-align: text-top;">:</th>
					<td style="text-align: justify;border: 0 !important;vertical-align: text-top;"> <span style="margin-right: 250px;"> <?= $address ?></span> </td>
                </tr>
				<tr>
                    <th style="width: 120px;border: 0 !important;vertical-align: text-top;">Received In</th>
                    <th style="width: 2px;border: 0 !important;vertical-align: text-top;">:</th>
					<td style="text-align: justify;border: 0 !important;vertical-align: text-top;"> <b>Cash / Giro / Cheque / Slip Transfer No. _________________________________________________</b></th>
                </tr>
				<tr style="margin-right: 100px;">
                    <th style="width: 120px;border: 0 !important;vertical-align: text-top;">Say</th>
                    <th style="width: 2px;border: 0 !important;vertical-align: text-top;">:</th>
					<td style="text-align: justify;border: 0 !important;vertical-align: text-top;background-color: #ccc;height:40px"><?= toEnglish($hasil)?> <?= $says ?></td>
                </tr>
				<tr>
                    <th style="width: 120px;border: 0 !important;vertical-align: text-top;">In Payment of</th>
                    <th style="width: 2px;border: 0 !important;vertical-align: text-top;">:</th>
					<td style="text-align: justify;border: 0 !important;vertical-align: text-top;"> <b>Survey and Adjustment on Windstoem Claim of <?= strtoupper($insured) ?></b></td>
                </tr>
				<tr>
                    <th style="width: 120px;border: 0 !important;"></th>
                    <th style="width: 2px;border: 0 !important;"></th>
					<td style="text-align: justify;border: 0 !important;vertical-align: text-top;">Our Ref No : <?= $insurer_ref_no ?> &nbsp;&nbsp;&nbsp;&nbsp; Policy No : <?= $policy_number ?> </td>
                </tr>
				<tr>
                    <th style="width: 120px;border: 0 !important;"></th>
                    <th style="width: 2px;border: 0 !important;"></th>
					<td style="text-align: justify;border: 0 !important;vertical-align: text-top;">Date of Loss : <?= $date_of_loss ?> </td>
                </tr>

        </table>
		<table id="table" style="font: 12px; margin-left:10px;margin-right:30px;" >
                <tr> 
                    <th style="width: 50%;border: 1 !important;vertical-align: text-top;">
					<div style="background-color: #ccc;height:30px;">
					<center><p style="font-size:16px;margin-top:3px"><b> Amount &nbsp;&nbsp;&nbsp;&nbsp; <?= $currency_code ?> <?= rupiah($hasil) ?></b></p></center>
					
				</div></th>
                    <th style="width: 50%;border: 1 !important;text-align: center;">Jakarta, <?= date('d-F-Y') ?></th>
                </tr>
				<tr> 
                    <th style="width: 50%;border: 1 !important;vertical-align: text-bottom;height:60"></th>
                    <th style="width: 50%;border: 1 !important;vertical-align: text-bottom;height:60">
				</th>
                </tr>
				<tr> 
                    <th style="width: 50%;border: 1 !important;vertical-align: text-top;">Note :
					This Official Receipt is valid only <br>
					after cheque/bilyet giro has been cleared
				</th>
                    <th style="width: 50%;border: 1 !important;text-align: center;vertical-align: text-top;"><u>Bram Petrus Smit</u> </th>
                </tr>
        </table>
			</th>
		
		</tr>
		
	</table>

