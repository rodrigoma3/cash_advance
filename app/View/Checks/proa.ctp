<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php echo __('Checks'); ?>		</h2>
		<hr>

		<table class="dataTables table table-striped table-bordered table-responsive">
			<thead>
				<tr>
					<th></th>
					<th><?php echo __('Date'); ?></th>
					<th><?php echo __('Value'); ?></th>
					<th><?php echo __('Number'); ?></th>
					<th><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th></th>
					<th><?php echo __('Date'); ?></th>
					<th><?php echo __('Value'); ?></th>
					<th><?php echo __('Number'); ?></th>
					<th><?php echo __('Actions'); ?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($checks as $check): ?>
	<tr>
		<td>&nbsp;</td>
		<td><?php echo h($check['Check']['date']); ?>&nbsp;</td>
		<td><?php echo h($check['Check']['value']); ?>&nbsp;</td>
		<td><?php echo h($check['Check']['number']); ?>&nbsp;</td>
		<td class="actions">
			<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['checks']['edit']) || in_array('semAutenticacao', $this->Session->read('perms')['checks']['edit'])): ?>
				<?php echo $this->Html->link('<i class="fas fa-pencil-alt text-warning"></i>&nbsp;', array('action' => 'edit', $check['Check']['id']), array('escape' => false, 'title' => __('Edit'))); ?>
			<?php endif; ?>
			<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['checks']['delete']) || in_array('semAutenticacao', $this->Session->read('perms')['checks']['delete'])): ?>
				<?php echo $this->Form->postLink('<i class="fas fa-trash text-danger"></i>&nbsp;', array('action' => 'delete', $check['Check']['id']), array('escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete "%s"?', $check['Check']['number']))); ?>
			<?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>
			</tbody>
		</table>

	</div>
</div>


<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['checks']['add']) || in_array('semAutenticacao', $this->Session->read('perms')['checks']['add'])): ?>
	<div class="hr hr-24"></div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-actions">
				<?php echo $this->Html->link('<i class="fas fa-plus"></i>&nbsp;'.__('New Check'), array('action' => 'add', $this->request->pass[0]), array('class' => 'btn btn-success', 'escape' => false)); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
