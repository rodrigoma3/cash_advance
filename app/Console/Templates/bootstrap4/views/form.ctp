<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">
			<?php
				$act = $action;
				if ($action == 'add') {
					$act = 'new';
				}
				printf("<?php echo __('%s %s'); ?>", Inflector::humanize($act), $singularHumanName);
			?>
		</h2>
		<hr>

        <?php echo "<?php echo \$this->Form->create(
			'{$modelClass}',
			array(
				'class' => 'form-inline',
				'role' => 'form',
				'inputDefaults' => array(
					'div' => 'form-group',
					'class' => 'form-control'
				)
			)
		); ?>"; ?>
		<?php echo "<?php echo \$this->Form->inputs(\$fields, \$blacklist, array('legend' => false, 'fieldset' => false)); ?>"; ?>

    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="form-actions">
			<?php echo "<?php echo \$this->Form->button('<i class=\"fas fa-check\"></i>&nbsp;'.__('Submit'), array('type' => 'submit', 'class' => 'btn btn-success', 'div' => false)); ?>"; ?>
			<?php echo "<?php echo \$this->Form->button('<i class=\"fas fa-undo\"></i>&nbsp;'.__('Reset'), array('type' => 'reset', 'class' => 'btn btn-yellow')); ?>"; ?>
			<?php echo "<?php echo \$this->Form->end(); ?>"; ?>
			<?php echo "<?php echo \$this->Html->link('<i class=\"fas fa-times\"></i>&nbsp;'.__('Cancel'), array('action' => 'index'), array('class' => 'btn', 'escape' => false)); ?>"; ?>
		</div>
	</div>
</div>
