<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php echo __('Edit User'); ?>		</h2>
		<hr>

        <?php echo $this->Form->create(
			'User',
			array(
				'class' => 'form-inline',
				'role' => 'form',
				'inputDefaults' => array(
					'div' => 'form-group',
					'class' => 'form-control'
				)
			)
		); ?>		<?php echo $this->Form->inputs($fields, $blacklist, array('legend' => false, 'fieldset' => false)); ?>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="form-actions">
			<?php echo $this->Form->button('<i class="fas fa-check"></i>&nbsp;'.__('Submit'), array('type' => 'submit', 'class' => 'btn btn-success', 'div' => false)); ?>			<?php echo $this->Form->button('<i class="fas fa-undo"></i>&nbsp;'.__('Reset'), array('type' => 'reset', 'class' => 'btn btn-yellow')); ?>			<?php echo $this->Form->end(); ?>			<?php echo $this->Html->link('<i class="fas fa-times"></i>&nbsp;'.__('Cancel'), array('action' => 'index'), array('class' => 'btn', 'escape' => false)); ?>		</div>
	</div>
</div>
