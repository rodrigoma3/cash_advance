<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php echo __('Users'); ?>		</h2>
		<hr>

		<table class="dataTables table table-striped table-bordered table-responsive">
			<thead>
				<tr>
					<th></th>
											<th><?php echo __('Id'); ?></th>
											<th><?php echo __('Name'); ?></th>
											<th><?php echo __('Email'); ?></th>
											<th><?php echo __('Password'); ?></th>
											<th><?php echo __('Role'); ?></th>
										<th><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th></th>
											<th><?php echo __('Id'); ?></th>
											<th><?php echo __('Name'); ?></th>
											<th><?php echo __('Email'); ?></th>
											<th><?php echo __('Password'); ?></th>
											<th><?php echo __('Role'); ?></th>
										<th><?php echo __('Actions'); ?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($users as $user): ?>
	<tr>
		<td>&nbsp;</td>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['role']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link('<i class="fas fa-lg fa-eye text-success"></i>&nbsp;', array('action' => 'view', $user['User']['id']), array('escape' => false, 'title' => __('View'))); ?>
			<?php echo $this->Html->link('<i class="fas fa-lg fa-pencil-alt text-warning"></i>&nbsp;', array('action' => 'edit', $user['User']['id']), array('escape' => false, 'title' => __('Edit'))); ?>
			<?php echo $this->Form->postLink('<i class="fas fa-lg fa-trash text-danger"></i>&nbsp;', array('action' => 'delete', $user['User']['id']), array('escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
			</tbody>
		</table>

	</div>
</div>

<div class="hr hr-24"></div>


<div class="row">
	<div class="col-md-12">
		<div class="form-actions">
			<?php echo $this->Html->link('<i class="fas fa-plus"></i>&nbsp;'.__('New User'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>		</div>
	</div>
</div>