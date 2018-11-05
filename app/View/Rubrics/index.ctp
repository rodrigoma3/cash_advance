<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php echo __('Rubrics'); ?>
		</h2>
		<hr>

		<table class="dataTables table table-striped table-bordered table-responsive">
			<thead>
				<tr>
					<th></th>
					<th><?php echo __('Number'); ?></th>
					<th><?php echo __('Description'); ?></th>
					<th><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th></th>
					<th><?php echo __('Number'); ?></th>
					<th><?php echo __('Description'); ?></th>
					<th><?php echo __('Actions'); ?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($rubrics as $rubric): ?>
					<tr>
						<td>&nbsp;</td>
						<td><?php echo h($rubric['Rubric']['number']); ?>&nbsp;</td>
						<td><?php echo h($rubric['Rubric']['description']); ?>&nbsp;</td>
						<td class="actions action-buttons">
							<?php echo $this->Html->link('<i class="fas fa-pencil-alt text-warning"></i>&nbsp;', array('action' => 'edit', $rubric['Rubric']['id']), array('escape' => false, 'title' => __('Edit'))); ?>
							<?php echo $this->Form->postLink('<i class="fas fa-trash text-danger"></i>&nbsp;', array('action' => 'delete', $rubric['Rubric']['id']), array('escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete "%s"?', $rubric['Rubric']['number']))); ?>
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
			<?php echo $this->Html->link('<i class="fas fa-plus"></i>&nbsp;'.__('New Rubric'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
		</div>
	</div>
</div>
