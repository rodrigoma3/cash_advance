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
							$usedValue = 0;
						}
						$remainingValue = $proa['Proa']['total_value'] - $usedValue;
						$totalUsedValue = $totalUsedValue + $usedValue;
						$totalRemainingValue = $totalRemainingValue + $remainingValue;
					 ?>
					<tr>
						<td>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($proa['User']['name'], array('controller' => 'users', 'action' => 'edit', $proa['User']['id'])); ?>
						</td>
						<td>
							<?php echo $this->Html->link($proa['Proa']['proa'], array('controller' => 'checks', 'action' => 'proa', $proa['Proa']['id'])); ?>
						</td>
						<td><?php echo h($proa['Proa']['proa_pct']); ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($proa['Rubric']['number'] . ' - ' . $proa['Rubric']['description'], array('controller' => 'rubrics', 'action' => 'edit', $proa['Rubric']['id'])); ?>
						</td>
						<td><?php echo h($proa['Proa']['total_value']); ?>&nbsp;</td>
						<td><?php echo h($usedValue); ?>&nbsp;</td>
						<td><?php echo h($remainingValue); ?>&nbsp;</td>
						<td><?php echo h($proa['Proa']['start_date']); ?>&nbsp;</td>
						<td><?php echo h($proa['Proa']['end_date']); ?>&nbsp;</td>
						<td><?php echo h($proa['Proa']['pct_date']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<i class="fas fa-eye text-success"></i>&nbsp;', array('controller' => 'checks', 'action' => 'proa', $proa['Proa']['id']), array('escape' => false, 'title' => __('View'))); ?>
							<?php echo $this->Html->link('<i class="fas fa-pencil-alt text-warning"></i>&nbsp;', array('action' => 'edit', $proa['Proa']['id']), array('escape' => false, 'title' => __('Edit'))); ?>
							<?php echo $this->Form->postLink('<i class="fas fa-trash text-danger"></i>&nbsp;', array('action' => 'delete', $proa['Proa']['id']), array('escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete proa %s?', $proa['Proa']['proa']))); ?>
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
		<strong><?php echo __('Total Value: %s R$ %s', '</strong>', array_sum(Hash::extract($proas, '{n}.Proa.total_value'))); ?>&nbsp;
		<strong><?php echo __('Total Used Value: %s R$ %s', '</strong>', $totalUsedValue); ?>&nbsp;
		<strong><?php echo __('Total Remaining Value: %s R$ %s', '</strong>', $totalRemainingValue); ?>&nbsp;
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="form-actions">
			<?php echo $this->Html->link('<i class="fas fa-plus"></i>&nbsp;'.__('New Proa'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
		</div>
	</div>
</div>
