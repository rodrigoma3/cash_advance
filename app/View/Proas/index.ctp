<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php echo __('Proas'); ?>		</h2>
		<hr>

		<table class="dataTables table table-striped table-bordered table-responsive">
			<thead>
				<tr>
					<th></th>
											<th><?php echo __('Id'); ?></th>
											<th><?php echo __('Proa'); ?></th>
											<th><?php echo __('Proa Pct'); ?></th>
											<th><?php echo __('Total Value'); ?></th>
											<th><?php echo __('Value Used'); ?></th>
											<th><?php echo __('Remaining Value'); ?></th>
											<th><?php echo __('Start Date'); ?></th>
											<th><?php echo __('End Date'); ?></th>
											<th><?php echo __('Pct Date'); ?></th>
											<th><?php echo __('User Id'); ?></th>
											<th><?php echo __('Rubric Id'); ?></th>
										<th><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th></th>
											<th><?php echo __('Id'); ?></th>
											<th><?php echo __('Proa'); ?></th>
											<th><?php echo __('Proa Pct'); ?></th>
											<th><?php echo __('Total Value'); ?></th>
											<th><?php echo __('Value Used'); ?></th>
											<th><?php echo __('Remaining Value'); ?></th>
											<th><?php echo __('Start Date'); ?></th>
											<th><?php echo __('End Date'); ?></th>
											<th><?php echo __('Pct Date'); ?></th>
											<th><?php echo __('User Id'); ?></th>
											<th><?php echo __('Rubric Id'); ?></th>
										<th><?php echo __('Actions'); ?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($proas as $proa): ?>
	<tr>
		<td>&nbsp;</td>
		<td><?php echo h($proa['Proa']['id']); ?>&nbsp;</td>
		<td><?php echo h($proa['Proa']['proa']); ?>&nbsp;</td>
		<td><?php echo h($proa['Proa']['proa_pct']); ?>&nbsp;</td>
		<td><?php echo h($proa['Proa']['total_value']); ?>&nbsp;</td>
		<td><?php echo h($proa['Proa']['value_used']); ?>&nbsp;</td>
		<td><?php echo h($proa['Proa']['remaining_value']); ?>&nbsp;</td>
		<td><?php echo h($proa['Proa']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($proa['Proa']['end_date']); ?>&nbsp;</td>
		<td><?php echo h($proa['Proa']['pct_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($proa['User']['name'], array('controller' => 'users', 'action' => 'edit', $proa['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($proa['Rubric']['name'], array('controller' => 'rubrics', 'action' => 'edit', $proa['Rubric']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link('<i class="fas fa-lg fa-eye text-success"></i>&nbsp;', array('action' => 'view', $proa['Proa']['id']), array('escape' => false, 'title' => __('View'))); ?>
			<?php echo $this->Html->link('<i class="fas fa-lg fa-pencil-alt text-warning"></i>&nbsp;', array('action' => 'edit', $proa['Proa']['id']), array('escape' => false, 'title' => __('Edit'))); ?>
			<?php echo $this->Form->postLink('<i class="fas fa-lg fa-trash text-danger"></i>&nbsp;', array('action' => 'delete', $proa['Proa']['id']), array('escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete # %s?', $proa['Proa']['id']))); ?>
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
			<?php echo $this->Html->link('<i class="fas fa-plus"></i>&nbsp;'.__('New Proa'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>		</div>
	</div>
</div>
