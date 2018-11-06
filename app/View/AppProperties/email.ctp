<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php echo __('App Properties Email'); ?>
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
			<?php echo $this->Form->button('<i class="fas fa-envelope"></i>&nbsp;'.__('Email Test'), array('type' => 'button', 'class' => 'btn btn-primary', 'div' => false, 'data-toggle' => 'modal', 'data-target' => '#testmail')); ?>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="testmail" tabindex="-1" role="dialog" aria-labelledby="testmailLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="testmailLabel"><?php echo __('Email sending test'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<?php echo $this->Form->create(
  			'AppProperty',
  			array(
  				'class' => 'form-inline',
  				'role' => 'form',
  				'inputDefaults' => array(
  					'div' => 'form-group',
  					'class' => 'form-control'
  				),
				'type' => 'get'
  			)
  		); ?>
		<?php echo $this->Form->input('to', array('type' => 'email', 'required' => true)); ?>
      </div>
      <div class="modal-footer">
		  <?php echo $this->Form->button('<i class="fas fa-times"></i>&nbsp;'.__('Close'), array('type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal')); ?>
		  <?php echo $this->Form->button(__('Send').'&nbsp;<i class="fas fa-arrow-right"></i>', array('type' => 'submit', 'class' => 'btn btn-primary', 'div' => false)); ?>
		  <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>
