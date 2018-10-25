<div class="checks view">
<h2><?php echo __('Check'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($check['Check']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($check['Check']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($check['Check']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($check['Check']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Proa'); ?></dt>
		<dd>
			<?php echo $this->Html->link($check['Proa']['id'], array('controller' => 'proas', 'action' => 'view', $check['Proa']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Check'), array('action' => 'edit', $check['Check']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Check'), array('action' => 'delete', $check['Check']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $check['Check']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Checks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Proas'), array('controller' => 'proas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proa'), array('controller' => 'proas', 'action' => 'add')); ?> </li>
	</ul>
</div>
