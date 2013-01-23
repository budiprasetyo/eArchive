	<div class="content">
		<h1>Surat Masuk</h1>
		<div class="paging"><?php echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		<br />
		<?php echo anchor('c_suratmasuk/add/','tambah data baru',array('class'=>'add')); ?>
	</div>
</body>
</html>
