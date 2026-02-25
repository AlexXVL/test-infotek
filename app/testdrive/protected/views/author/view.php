<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs=array(
	'Authors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Author', 'url'=>array('index')),
	array('label'=>'Create Author', 'url'=>array('create')),
	array('label'=>'Update Author', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Author', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Author', 'url'=>array('admin')),
);
?>

<h1>View Author #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
	),
)); ?>

<div class="subscription-form">
    <?php

    // Проверяем, подписан ли уже пользователь
    $isSubscribed = Yii::app()->user->isGuest ? false : Subscription::model()->findByAttributes(array(
            'email' => Yii::app()->user->email,
            'author_id' => $model->id
    ));

    if ($isSubscribed) {
        echo CHtml::encode('вы подписаны на этого автора');
//        echo CHtml::link('Отписаться от автора', array('subscription/unsubscribe', 'id' => $isSubscribed->id), array('class' => 'btn btn-danger'));
    } else {
        $this->beginWidget(CActiveForm::class, array(
                'id' => 'subscription-form',
                'action' => array('subscription/create'),
                'method' => 'post', // или 'get'
                'enableAjaxValidation' => false,
        ));

        echo CHtml::hiddenField('Subscription[author_id]', $model->id);
        echo CHtml::emailField('Subscription[email]', Yii::app()?->user->email ?? '');
        echo CHtml::submitButton('Подписаться на автора', array('class' => 'btn btn-primary'));

        $this->endWidget();
    }
    ?>
</div>
