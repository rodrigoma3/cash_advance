<div class="proas view">
<h2><?php echo __('Proa'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($proa['Proa']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Proa'); ?></dt>
		<dd>
			<?php echo h($proa['Proa']['proa']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Proa Pct'); ?></dt>
		<dd>
			<?php echo h($proa['Proa']['proa_pct']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Value'); ?></dt>
		<dd>
			<?php echo h($proa['Proa']['total_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value Used'); ?></dt>
		<dd>
			<?php echo h($proa['Proa']['value_used']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remaining Value'); ?></dt>
		<dd>
			<?php echo h($proa['Proa']['remaining_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($proa['Proa']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($proa['Proa']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pct Date'); ?></dt>
		<dd>
			<?php echo h($proa['Proa']['pct_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($proa['User']['name'], array('controller' => 'users', 'action' => 'view', $proa['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rubric'); ?></dt>
		<dd>
			<?php echo $this->Html->link($proa['Rubric']['name'], array('controller' => 'rubrics', 'action' => 'view', $proa['Rubric']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Proa'), array('action' => 'edit', $proa['Proa']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Proa'), array('action' => 'delete', $proa['Proa']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $proa['Proa']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Proas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proa'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rubrics'), array('controller' => 'rubrics', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rubric'), array('controller' => 'rubrics', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Checks'), array('controller' => 'checks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check'), array('controller' => 'checks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Checks'); ?></h3>
	<?php if (!empty($proa['Check'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Number'); ?></th>
		<th><?php echo __('Proa Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($proa['Check'] as $check): ?>
		<tr>
			<td><?php echo $check['id']; ?></td>
			<td><?php echo $check['date']; ?></td>
			<td><?php echo $check['value']; ?></td>
			<td><?php echo $check['number']; ?></td>
			<td><?php echo $check['proa_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'checks', 'action' => 'view', $check['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'checks', 'action' => 'edit', $check['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'checks', 'action' => 'delete', $check['id']), array('confirm' => __('Are you sure you want to delete # %s?', $check['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Check'), array('controller' => 'checks', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
