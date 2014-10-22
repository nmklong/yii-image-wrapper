<h2>View User <?php echo $user->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('New User',array('create')); ?>]
[<?php echo CHtml::link('Update User',array('update','id'=>$user->id)); ?>]
[<?php echo CHtml::linkButton('Delete User',array('submit'=>array('delete','id'=>$user->id),'confirm'=>'Are you sure?')); ?>
]
[<?php echo CHtml::link('Manage User',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($user->getAttributeLabel('username')); ?>
</th>
    <td><?php echo CHtml::encode($user->username); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($user->getAttributeLabel('email')); ?>
</th>
    <td><?php echo CHtml::encode($user->email); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($user->getAttributeLabel('role')); ?>
</th>
    <td><?php echo CHtml::encode($user->getRoleName()); ?>
</td>
</tr>
</table>
