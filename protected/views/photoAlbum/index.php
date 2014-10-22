<?php
/* @var $this PhotoAlbumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Photo Albums',
);

$this->menu=array(
	array('label'=>'Create PhotoAlbum', 'url'=>array('create')),
	array('label'=>'Manage PhotoAlbum', 'url'=>array('admin')),
);
?>

<h1>Photo Albums</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
