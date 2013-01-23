<div class="content">
	<h1><?php echo $title; ?></h1>
	<div class="data">
	<table>
		<tr>
			<td width="30%">ID</td>
			<td><?php echo $kementerian->id; ?></td>
		</tr>
		<tr>
			<td valign="top">Kode Kementerian</td>
			<td><?php echo $kementerian->kdmenteri; ?></td>
		</tr>
		<tr>
			<td valign="top">Nama Kementerian</td>
			<td><?php echo $kementerian->nmmenteri; ?></td>
		</tr>
		<tr>
			<td valign="top">Kode Eselon I</td>
			<td><?php echo $kementerian->kdes1; ?></td>
		</tr>
		<tr>
			<td valign="top">Nama Eselon I</td>
			<td><?php echo $kementerian->nmes1; ?></td>
		</tr>
		<tr>
			<td valign="top">Kode Eselon II</td>
			<td><?php echo $kementerian->kdes2; ?></td>
		</tr>
		<tr>
			<td valign="top">Nama Eselon II</td>
			<td><?php echo $kementerian->nmes2; ?></td>
		</tr>
	</table>
	</div>
	<br />
	<?php echo $link_back; ?>
</div>

