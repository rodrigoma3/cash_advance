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

<h1 class="h3 mb-3 font-weight-normal"><?php echo Configure::read('AppProperties.app_name'); ?></h1>

<?php echo $this->Form->inputs($fields, $blacklist, array('legend' => false, 'fieldset' => false)); ?>

<?php echo $this->Form->button(__('Sign in'), array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block', 'div' => false)); ?>
<?php if (Configure::read('AppProperties.email_send_mail')): ?>
    <br>
    <p><?php echo $this->Html->link(__('Forgot password? click here'), array('action' => 'forgotPassword')) ?></p>
<?php endif; ?>

<p class="mt-5 mb-3 text-muted">&copy; 2018</p>

<?php echo $this->Form->end(); ?>
