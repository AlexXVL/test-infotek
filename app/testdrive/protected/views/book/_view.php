<?php
/* @var $this BookController */
/* @var $data Book */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('название')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('год выпуска')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('описание')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isbn')); ?>:</b>
	<?php echo CHtml::encode($data->isbn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('обложка')); ?>:</b>
    <?php echo CHtml::image($data->image); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('авторы')); ?>:</b>
    <?php
    // Получаем список авторов через связь many-to-many
    $authors = $data->authors;
    $authorsList = array();
    foreach ($authors as $author) {
        $authorsList[] = CHtml::link(CHtml::encode($author->name), '?r=author/view&id=' . $author->id); // предполагаем, что в модели Author есть поле name
    }
    echo implode(', ', $authorsList);
    ?>
</div>