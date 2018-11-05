<?php echo $this->Form->create(
    'User',
    array(
        'class' => 'form-signin',
        'role' => 'form',
        'inputDefaults' => array(
            'div' => false,
            'class' => 'form-control',
            'label' => array(
                'class' => 'sr-only',
            ),
        )
    )
); ?>

<h1 class="h3 mb-3 font-weight-normal"><?php echo __('Forgot Password'); ?></h1>

<?php echo $this->Form->inputs($fields, $blacklist, array('legend' => false, 'fieldset' => false)); ?>
<br>
<?php echo $this->Form->button(__('Reset Password'), array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block', 'div' => false)); ?>

<br>
<p><?php echo $this->Html->link(__('Sign in? click here'), array('action' => 'login')) ?></p>

<p class="mt-5 mb-3 text-muted">&copy; 2018</p>

<?php echo $this->Form->end(); ?>
