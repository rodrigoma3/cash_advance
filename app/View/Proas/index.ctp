<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php echo __('Proas'); ?>		</h2>
		<hr>

		<table class="dataTables table table-striped table-bordered table-sm table-responsive">
			<thead>
				<tr>
					<th></th>
					<th><?php echo __('User'); ?></th>
					<th><?php echo __('Proa'); ?></th>
					<th><?php echo __('Proa Pct'); ?></th>
					<th><?php echo __('Rubric'); ?></th>
					<th><?php echo __('Total Value'); ?></th>
					<th><?php echo __('Used Value'); ?></th>
					<th><?php echo __('Remaining Value'); ?></th>
					<th><?php echo __('Start Date'); ?></th>
					<th><?php echo __('End Date'); ?></th>
					<th><?php echo __('Pct Date'); ?></th>
					<th><?php echo __('Freeze'); ?></th>
					<th><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th></th>
					<th><?php echo __('User'); ?></th>
					<th><?php echo __('Proa'); ?></th>
					<th><?php echo __('Proa Pct'); ?></th>
					<th><?php echo __('Rubric'); ?></th>
					<th><?php echo __('Total Value'); ?></th>
					<th><?php echo __('Used Value'); ?></th>
					<th><?php echo __('Remaining Value'); ?></th>
					<th><?php echo __('Start Date'); ?></th>
					<th><?php echo __('End Date'); ?></th>
					<th><?php echo __('Pct Date'); ?></th>
					<th><?php echo __('Freeze'); ?></th>
					<th><?php echo __('Actions'); ?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php
					$totalUsedValue = 0;
					$totalRemainingValue = 0;
				 ?>
				<?php foreach ($proas as $proa): ?>
					<?php
						$usedValue = array_sum(Hash::extract($proa['Check'], '{n}.value'));
						if (!is_numeric($usedValue)) {
							$usedValue = 0.00;
						}
						$remainingValue = $proa['Proa']['total_value'] - $usedValue;
						$totalUsedValue = $totalUsedValue + $usedValue;
						$totalRemainingValue = $totalRemainingValue + $remainingValue;
					 ?>
					<tr>
						<td>&nbsp;</td>
						<td>
							<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['users']['edit']) || in_array('semAutenticacao', $this->Session->read('perms')['users']['edit'])): ?>
								<?php echo $this->Html->link($proa['User']['name'], array('controller' => 'users', 'action' => 'edit', $proa['User']['id'])); ?>
							<?php else: ?>
								<?php echo h($proa['User']['name']); ?>
							<?php endif; ?>
						</td>
						<td>
							<?php if ((in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['checks']['proa']) || in_array('semAutenticacao', $this->Session->read('perms')['checks']['proa'])) && ((!$proa['Proa']['freeze'] && $this->Session->read('Auth.User.role') != 'admin') || $this->Session->read('Auth.User.role') == 'admin')): ?>
								<?php echo $this->Html->link($proa['Proa']['proa'], array('controller' => 'checks', 'action' => 'proa', $proa['Proa']['id'])); ?>
							<?php else: ?>
								<?php echo h($proa['Proa']['proa']); ?>
							<?php endif; ?>
						</td>
						<td><?php echo h($proa['Proa']['proa_pct']); ?>&nbsp;</td>
						<td>
							<?php echo h($proa['Rubric']['number'] . ' - ' . $proa['Rubric']['description']); ?>
						</td>
						<td><?php echo h(CakeNumber::currency($proa['Proa']['total_value'], 'BRL')); ?>&nbsp;</td>
						<td><?php echo h(CakeNumber::currency($usedValue, 'BRL')); ?>&nbsp;</td>
						<td><?php echo h(CakeNumber::currency($remainingValue, 'BRL')); ?>&nbsp;</td>
						<td><?php echo h(date('d/m/Y', strtotime($proa['Proa']['start_date']))); ?>&nbsp;</td>
						<td><?php echo h(date('d/m/Y', strtotime($proa['Proa']['end_date']))); ?>&nbsp;</td>
						<td><?php echo h(date('d/m/Y', strtotime($proa['Proa']['pct_date']))); ?>&nbsp;</td>
						<td><?php echo h($proa['Freeze']['name']); ?>&nbsp;</td>
						<td class="actions">
							<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['checks']['proa']) || in_array('semAutenticacao', $this->Session->read('perms')['checks']['proa'])): ?>
								<?php if ((!$proa['Proa']['freeze'] && $this->Session->read('Auth.User.role') != 'admin') || $this->Session->read('Auth.User.role') == 'admin'): ?>
									<?php echo $this->Html->link('<i class="fas fa-eye text-success"></i>&nbsp;', array('controller' => 'checks', 'action' => 'proa', $proa['Proa']['id']), array('escape' => false, 'title' => __('View'))); ?>
								<?php endif; ?>
							<?php endif; ?>
							<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['proas']['informProaPct']) || in_array('semAutenticacao', $this->Session->read('perms')['proas']['informProaPct'])): ?>
								<?php if ((!$proa['Proa']['freeze'] && $this->Session->read('Auth.User.role') != 'admin')): ?>
									<?php echo $this->Html->link('<i class="fas fa-award text-primary"></i>&nbsp;', array('action' => 'informProaPct', $proa['Proa']['id']), array('escape' => false, 'title' => __('Inform Proa Pct'))); ?>
								<?php endif; ?>
							<?php endif; ?>
							<?php if ($proa['Proa']['freeze']): ?>
								<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['proas']['unfreeze']) || in_array('semAutenticacao', $this->Session->read('perms')['proas']['unfreeze'])): ?>
									<?php echo $this->Form->postLink('<i class="fas fa-snowflake text-info"></i>&nbsp;', array('action' => 'unfreeze', $proa['Proa']['id']), array('escape' => false, 'title' => __('Unfreeze'), 'confirm' => __('Are you sure you want to unfreeze proa %s?', $proa['Proa']['proa']))); ?>
								<?php endif; ?>
							<?php else: ?>
								<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['proas']['freeze']) || in_array('semAutenticacao', $this->Session->read('perms')['proas']['freeze'])): ?>
									<?php echo $this->Form->postLink('<i class="fas fa-snowflake text-info"></i>&nbsp;', array('action' => 'freeze', $proa['Proa']['id']), array('escape' => false, 'title' => __('Freeze'), 'confirm' => __('Are you sure you want to freeze proa %s?', $proa['Proa']['proa']))); ?>
								<?php endif; ?>
							<?php endif; ?>
							<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['proas']['edit']) || in_array('semAutenticacao', $this->Session->read('perms')['proas']['edit'])): ?>
								<?php echo $this->Html->link('<i class="fas fa-pencil-alt text-warning"></i>&nbsp;', array('action' => 'edit', $proa['Proa']['id']), array('escape' => false, 'title' => __('Edit'))); ?>
							<?php endif; ?>
							<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['proas']['delete']) || in_array('semAutenticacao', $this->Session->read('perms')['proas']['delete'])): ?>
								<?php echo $this->Form->postLink('<i class="fas fa-trash text-danger"></i>&nbsp;', array('action' => 'delete', $proa['Proa']['id']), array('escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete proa %s?', $proa['Proa']['proa']))); ?>
							<?php endif; ?>
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
		<strong><?php echo __('Total Value: %s %s', '</strong>', CakeNumber::currency(array_sum(Hash::extract($proas, '{n}.Proa.total_value')), 'BRL')); ?>&nbsp;
		<strong><?php echo __('Total Used Value: %s %s', '</strong>', CakeNumber::currency($totalUsedValue, 'BRL')); ?>&nbsp;
		<strong><?php echo __('Total Remaining Value: %s %s', '</strong>', CakeNumber::currency($totalRemainingValue, 'BRL')); ?>&nbsp;
	</div>
</div>

<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['proas']['add']) || in_array('semAutenticacao', $this->Session->read('perms')['proas']['add'])): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="form-actions">
				<?php echo $this->Html->link('<i class="fas fa-plus"></i>&nbsp;'.__('New Proa'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
