<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<ul>
    <li><a href="?r=book/">Список книг</a></li>
    <li><a href="?r=author/">Список авторов</a></li>
    <li><a href="?r=author/top10&year=2026">Топ 10 авторов</a></li>
</ul>

