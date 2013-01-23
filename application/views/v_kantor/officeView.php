<div class="content">
	<h1><?php echo $title; ?></h1>
	<div class="data">
	<table>
		<tr>
			<td width="30%">ID</td>
			<td><?php echo $office->id; ?></td>
		</tr>
		<tr>
			<td valign="top">Kode Kementerian</td>
			<td><?php echo $office->kdmenteri; ?></td>
		</tr>
		<tr>
			<td valign="top">Kode Eselon I</td>
			<td><?php echo $office->kdes1; ?></td>
		</tr>
				<tr>
			<td valign="top">Kode Eselon II</td>
			<td><?php echo $office->kdes2; ?></td>
		</tr>
		<tr>
			<td valign="top">Kode Satker</td>
			<td><?php echo $office->kdsatker; ?></td>
		</tr>
		<tr>
			<td valign="top">Alamat</td>
			<td><?php echo $office->alamat; ?></td>
		</tr>
		<tr>
			<td valign="top">Kode Pos</td>
			<td><?php echo $office->kodepos; ?></td>
		</tr>
		<tr>
			<td valign="top">No.Telepon</td>
			<td><?php echo $office->telp; ?></td>
		</tr>
		<tr>
			<td valign="top">No.Fax</td>
			<td><?php echo $office->fax; ?></td>
		</tr>
		<tr>
			<td valign="top">E-mail</td>
			<td><?php echo $office->email; ?></td>
		</tr>
		<tr>
			<td valign="top">Website</td>
			<td><?php echo $office->website; ?></td>
		</tr>
		<tr>
			<td valign="top">No.SMS Gateway</td>
			<td><?php echo $office->smsgateway; ?></td>
		</tr>
	</table>
	</div>
	<br />
	<?php echo $link_back; ?>
</div>

