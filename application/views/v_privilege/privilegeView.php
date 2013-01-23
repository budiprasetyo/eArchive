<div class="content">
	<h1><?php echo $title; ?></h1>
	<div class="data">
	<table>
		<tr>
			<td width="30%">ID</td>
			<td><?php echo $privilege->id_r_privilege; ?></td>
		</tr>
		<tr>
			<td valign="top">Privilege</td>
			<td><?php echo $privilege->privilege; ?></td>
		</tr>
		<tr>
			<td valign="top">Kode Privilege</td>
			<td><?php echo $privilege->id_dyn_menu; ?></td>
		</tr>
	</table>
	</div>
	<br />
	<?php echo $link_back; ?>
</div>

