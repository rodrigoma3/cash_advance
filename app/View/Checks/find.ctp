<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php echo __('Find Check'); ?>		</h2>
		<hr>

        <?php echo $this->Form->create(
			'Check',
			array(
				'class' => 'form-inline',
				'role' => 'form',
				'inputDefaults' => array(
					'div' => false,
					'class' => 'form-control'
				)
			)
		); ?>
		<?php echo $this->Form->inputs($fields, $blacklist, array('legend' => false, 'fieldset' => false)); ?>

		<?php echo $this->Form->button('<i class="fas fa-search"></i>&nbsp;'.__('Search'), array('type' => 'submit', 'class' => 'btn btn-success')); ?>
		<?php echo $this->Form->end(); ?>
    </div>
</div>




<?php if (isset($checks) && !empty($checks)): ?>
	<div class="row">
		<div class="col-md-12">
			<h2 class="page-header">
				<?php echo __('Found Checks'); ?>		</h2>
				<hr>

				<table class="dataTables table table-striped table-bordered table-responsive">
					<thead>
						<tr>
							<th></th>
							<th><?php echo __('Date'); ?></th>
							<th><?php echo __('Value'); ?></th>
							<th><?php echo __('Number'); ?></th>
							<th><?php echo __('Description'); ?></th>
							<th><?php echo __('Proa'); ?></th>
							<th><?php echo __('User'); ?></th>
							<th><?php echo __('Rubric'); ?></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th><?php echo __('Date'); ?></th>
							<th><?php echo __('Value'); ?></th>
							<th><?php echo __('Number'); ?></th>
							<th><?php echo __('Description'); ?></th>
							<th><?php echo __('Proa'); ?></th>
							<th><?php echo __('User'); ?></th>
							<th><?php echo __('Rubric'); ?></th>
						</tr>
					</tfoot>
					<tbody>
						<?php foreach ($checks as $check): ?>
							<tr>
								<td>&nbsp;</td>
								<td><?php echo h(date('d/m/Y', strtotime($check['Check']['date']))); ?>&nbsp;</td>
								<td><?php echo h(CakeNumber::currency($check['Check']['value'], 'BRL')); ?>&nbsp;</td>
								<td><?php echo h($check['Check']['number']); ?>&nbsp;</td>
								<td><?php echo h($check['Check']['description']); ?>&nbsp;</td>
								<td><?php echo h($check['Proa']['proa']); ?>&nbsp;</td>
								<td><?php echo h($check['Proa']['User']['name']); ?>&nbsp;</td>
								<td><?php echo h($check['Proa']['Rubric']['number'] . ' - ' . $check['Proa']['Rubric']['description']); ?>&nbsp;</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

			</div>
		</div>
<?php endif; ?>
