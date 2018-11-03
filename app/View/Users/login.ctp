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

<h1 class="h3 mb-3 font-weight-normal"><?php echo __(Configure::read('AppProperties.App.app_name')); ?></h1>

<?php echo $this->Form->inputs($fields, $blacklist, array('legend' => false, 'fieldset' => false)); ?>

<?php echo $this->Form->button(__('Sign in'), array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block', 'div' => false)); ?>

<p class="mt-5 mb-3 text-muted">&copy; 2018</p>

<?php echo $this->Form->end(); ?>
