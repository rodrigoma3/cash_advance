<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php echo __('App Properties'); ?>
			<hr>
		</h2>

        <?php echo $this->Form->create(
			'AppProperty',
			array(
				'class' => 'form-inline',
				'role' => 'form',
				'inputDefaults' => array(
					'div' => 'form-group',
					'class' => 'form-control'
				)
			)
		); ?>
		<?php echo $this->Form->inputs($fields, $blacklist, array('legend' => false, 'fieldset' => false)); ?>

    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="form-actions">
			<?php echo $this->Form->button('<i class="fas fa-check"></i>&nbsp;'.__('Submit'), array('type' => 'submit', 'class' => 'btn btn-success', 'div' => false)); ?>
			<?php echo $this->Form->button('<i class="fas fa-undo"></i>&nbsp;'.__('Reset'), array('type' => 'reset', 'class' => 'btn btn-yellow')); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
