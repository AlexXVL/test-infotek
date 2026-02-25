<?php
/* @var $this AuthorController */
/* @var $data Author */
?>

<div class="view">

	<b><?php echo CHtml::encode('Упоминаний'); ?>:</b>
	<?php echo CHtml::encode($data['count']); ?>
	<br />

	<?php echo CHtml::encode($data['name']); ?>
	<br />

</div>