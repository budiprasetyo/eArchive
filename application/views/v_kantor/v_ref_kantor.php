	<div class="content">
		<h1>Referensi Satker</h1>
		<div class="paging"><?php echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		<br />
		<?php echo anchor('c_ref_kantor/add/','tambah data baru',array('class'=>'add')); ?>
	</div>
</body>
</html>
