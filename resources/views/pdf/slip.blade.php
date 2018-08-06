<html>
<head>
<title>Slip Pembayaran</title>
<style type="text/css">
	#page-wrap {
		width: 700px;
		margin: 0 auto;
	}
	.center-justified {
		text-align: justify;
		margin: 0 auto;
		width: 30em;
	}
	table.outline-table {
		border: 1px solid;
		border-spacing: 0;
	}
	tr.border-bottom td, td.border-bottom {
		border-bottom: 1px solid;
	}
	tr.border-top td, td.border-top {
		border-top: 1px solid;
	}
	tr.border-right td, td.border-right {
		border-right: 1px solid;
	}
	tr.border-right td:last-child {
		border-right: 0px;
	}
	tr.center td, td.center {
		text-align: center;
		vertical-align: text-top;
	}
	td.pad-left {
		padding-left: 5px;
	}
	tr.right-center td, td.right-center {
		text-align: right;
		padding-right: 50px;
	}
	tr.right td, td.right {
		text-align: right;
	}
	.grey {
		background:grey;
	}
	.management {
    width: 50%;
    float: left;
}
</style>
</head>
<body>
	<div id="page-wrap">
		<table width="100%">
			<tbody>
				<tr>
					<td width="30%">
						
					</td>
					<td width="70%">
						<h2>Slip Pembayaran Denda</h2><br>
						<strong>Date:</strong> {{date('d/M/Y')}} <br>
						<strong>No. Peminjaman:</strong> {{ $return->nomor_peminjaman }}<br>
                        <strong>Member:</strong> {{ $return->user->name }}<br>
                        <strong>Tanggal Pengembalian:</strong> {{ date("d-m-Y", strtotime($return->tanggal_pinjam)) }}<br>
                        <strong>Tanggal Pengembalian:</strong> {{ date("d-m-Y", strtotime($return->updated_at)) }}<br>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			</tbody>
		</table>
		<p>&nbsp;</p>
		 <table width="100%" class="outline-table">
			<tbody>
				<tr class="border-bottom border-right grey">
					<td colspan="5"><strong>Detail Denda</strong></td>
				</tr>
				<tr class="border-bottom border-right center">
					<td width="45%"><strong>Jumlah Buku</strong></td>
					<td width="25%"><strong>Jumlah Hari</strong></td>
					<td width="30%"><strong>Denda / Hari</strong></td>
				</tr>
                
				<tr class="border-right">
					<td class="center">{{ $return->details->count() }}</td>
					<td class="center">{{ $return->getDays($return->tanggal_pinjam) }}</td>
					<td class="center">{{ 'Rp '. number_format( $setting->biaya_denda , 2 , '.' , ',' ) }}</td>
				</tr>
                
			</tbody>
		</table>
        <br>
		
        <h4>Total : {{ 'Rp '. number_format( $return->denda , 2 , '.' , ',' )}}</h4>
		<p>&nbsp;</p>
		
		<br>
		<center>
		<div class="management">
		<h5>Dinas Kearsipan dan Perpustakaan,</h5>
		<br>
		<br>
		<br>
    	<hr style="margin-left:25%;width:50%">
     </div>
    <div class="management">
		<h5>Member,</h5>
		<br>
		<br>
		<br>
    	<hr style="margin-left:25%;width:50%">
     </div>
     </center>
	</div>
</body>
</html>