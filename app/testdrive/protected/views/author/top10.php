<?php
/* @var $this AuthorController */
/* @var $dataProvider CActiveDataProvider */
/* @var $year int */

$this->breadcrumbs=array(
        'Authors'=>array('index'), 'Top10'
);


$this->menu=array(
	array('label'=>'Create Author', 'url'=>array('create')),
	array('label'=>'Manage Author', 'url'=>array('admin')),
);
?>

<h1>Топ 10 авторов в <?php echo $year ?> году</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_top10',
)); ?>
