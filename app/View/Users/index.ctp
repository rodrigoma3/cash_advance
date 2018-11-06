<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php echo __('Users'); ?>		</h2>
		<hr>

		<table class="dataTables table table-striped table-bordered table-responsive">
			<thead>
				<tr>
					<th></th>
					<th><?php echo __('Name'); ?></th>
					<th><?php echo __('Email'); ?></th>
					<th><?php echo __('Role'); ?></th>
					<th><?php echo __('Enabled'); ?></th>
					<th><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th></th>
					<th><?php echo __('Name'); ?></th>
					<th><?php echo __('Email'); ?></th>
					<th><?php echo __('Role'); ?></th>
					<th><?php echo __('Enabled'); ?></th>
					<th><?php echo __('Actions'); ?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($users as $user): ?>
					<tr>
						<td>&nbsp;</td>
						<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
						<td><?php echo h($user['Role']['name']); ?>&nbsp;</td>
						<td><?php echo h($user['Enabled']['name']); ?>&nbsp;</td>
						<td class="actions">
							<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['users']['resetPassword']) || in_array('semAutenticacao', $this->Session->read('perms')['users']['resetPassword'])): ?>
								<?php echo $this->Html->link('<i class="fas fa-key text-info"></i>&nbsp;', array('action' => 'resetPassword', $user['User']['id']), array('escape' => false, 'title' => __('Reset Password'))); ?>
							<?php endif; ?>
							<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['users']['edit']) || in_array('semAutenticacao', $this->Session->read('perms')['users']['edit'])): ?>
								<?php echo $this->Html->link('<i class="fas fa-pencil-alt text-warning"></i>&nbsp;', array('action' => 'edit', $user['User']['id']), array('escape' => false, 'title' => __('Edit'))); ?>
							<?php endif; ?>
							<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['users']['delete']) || in_array('semAutenticacao', $this->Session->read('perms')['users']['delete'])): ?>
								<?php echo $this->Form->postLink('<i class="fas fa-trash text-danger"></i>&nbsp;', array('action' => 'delete', $user['User']['id']), array('escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete "%s"?', $user['User']['email']))); ?>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	</div>
</div>

<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['users']['add']) || in_array('semAutenticacao', $this->Session->read('perms')['users']['add'])): ?>
	<div class="hr hr-24"></div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-actions">
				<?php echo $this->Html->link('<i class="fas fa-plus"></i>&nbsp;'.__('New User'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
