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
			<?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?>
		</h2>
		<hr>

		<table class="dataTables table table-striped table-bordered table-responsive">
			<thead>
				<tr>
					<th></th>
					<?php foreach ($fields as $field): ?>
						<th><?php printf("<?php echo __('%s'); ?>", Inflector::humanize($field)); ?></th>
					<?php endforeach; ?>
					<th><?php echo "<?php echo __('Actions'); ?>"; ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th></th>
					<?php foreach ($fields as $field): ?>
						<th><?php printf("<?php echo __('%s'); ?>", Inflector::humanize($field)); ?></th>
					<?php endforeach; ?>
					<th><?php echo "<?php echo __('Actions'); ?>"; ?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php
				echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
				echo "\t<tr>\n";
					echo "\t\t<td>&nbsp;</td>\n";
					foreach ($fields as $field) {
						$isKey = false;
						if (!empty($associations['belongsTo'])) {
							foreach ($associations['belongsTo'] as $alias => $details) {
								if ($field === $details['foreignKey']) {
									$isKey = true;
									echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
									break;
								}
							}
						}
						if ($isKey !== true) {
							echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
						}
					}

					echo "\t\t<td class=\"actions\">\n";
					echo "\t\t\t<?php echo \$this->Html->link('<i class=\"fas fa-lg fa-eye text-success\"></i>&nbsp;', array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false, 'title' => __('View'))); ?>\n";
					echo "\t\t\t<?php echo \$this->Html->link('<i class=\"fas fa-lg fa-pencil-alt text-warning\"></i>&nbsp;', array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false, 'title' => __('Edit'))); ?>\n";
					echo "\t\t\t<?php echo \$this->Form->postLink('<i class=\"fas fa-lg fa-trash text-danger\"></i>&nbsp;', array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}']))); ?>\n";
					echo "\t\t</td>\n";
				echo "\t</tr>\n";

				echo "<?php endforeach; ?>\n";
				?>
			</tbody>
		</table>

	</div>
</div>

<div class="hr hr-24"></div>


<div class="row">
	<div class="col-md-12">
		<div class="form-actions">
			<?php echo "<?php echo \$this->Html->link('<i class=\"fas fa-plus\"></i>&nbsp;'.__('New " . $singularHumanName . "'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>"; ?>
		</div>
	</div>
</div>
