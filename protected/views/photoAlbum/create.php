<?php
/* @var $this PhotoAlbumController */
/* @var $model PhotoAlbum */

$this->breadcrumbs=array(
	'Photo Albums'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage PhotoAlbum', 'url'=>array('admin')),
);
?>

<h1>Create PhotoAlbum</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
