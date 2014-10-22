<h2>Manage Users</h2>

<div class="actionBar">
[<?= CHtml::link('New User', array('create')) ?>]
</div>

<table class="dataGrid">
  <tr>
    <th><?= $sort->link('username') ?></th>
    <th><?= $sort->link('role') ?></th>
	<th>Actions</th>
  </tr>
<? foreach($userList as $n=>$model) { ?>
  <tr class="<?= $n%2?'even':'odd';?>">
    <td><?= CHtml::link(CHtml::encode($model->username), array('show', 'id'=>$model->id)) ?></td>
    <td><?= CHtml::encode($model->getRoleName()) ?></td>
    <td>
      <?= CHtml::link('Edit',array('update','id'=>$model->id)) ?>
      <?= CHtml::linkButton('Delete',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->id),
      	  'confirm'=>"Are you sure to delete " . CHtml::encode($model->username) ."?")) ?>
	</td>
  </tr>
<? } ?>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)) ?>
