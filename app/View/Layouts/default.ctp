<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>

	<script type="text/javascript">
		var locale = "<?php echo Router::url('/plugins/locale/').Configure::read('Config.language').'.json'; ?>";
		var lang = "<?php echo Configure::read('Config.language'); ?>";
		var exportTable = true;
	</script>

	<?php
		echo $this->Html->meta(array(
            'name' => 'viewport',
            'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no',
        ));
        echo $this->Html->meta(array(
            'name' => 'description',
            'content' => '',
        ));
        echo $this->Html->meta(array(
            'name' => 'author',
            'content' => '',
        ));
        echo $this->Html->meta('icon');

		echo $this->Html->css(array(
            'bootstrap.min',
            '/fontawesome-free-5.4.1-web/css/all.min',
			'/plugins/DataTables-1_10_19/datatables.min',
			'/plugins/bootstrap-datetimepicker-4_17_45/css/bootstrap-datetimepicker.min',
			'/plugins/select2-4.0.6/css/select2.min',
            'sticky-footer-navbar',
			'custom',
        ));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>

	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<div class="container">
			<?php echo $this->Html->link(Configure::read('AppProperties.app_name'), '/', array('escape' => false, 'class' => 'navbar-brand')); ?>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['proas']['index']) || in_array('semAutenticacao', $this->Session->read('perms')['proas']['index'])): ?>
					<li class="nav-item <?php if ($this->params['controller'] == 'proas' && $this->params['action'] == 'index') echo 'active'; ?>">
						<?php echo $this->Html->link('<i class="fas fa-folder-open"></i>&nbsp;'.__('Proas'), array('controller' => 'proas', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
					</li>
				<?php endif; ?>
				<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['rubrics']['index']) || in_array('semAutenticacao', $this->Session->read('perms')['rubrics']['index'])): ?>
					<li class="nav-item <?php if ($this->params['controller'] == 'rubrics' && $this->params['action'] == 'index') echo 'active'; ?>">
						<?php echo $this->Html->link('<i class="fas fa-file-signature"></i>&nbsp;'.__('Rubrics'), array('controller' => 'rubrics', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
					</li>
				<?php endif; ?>
				<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['users']['index']) || in_array('semAutenticacao', $this->Session->read('perms')['users']['index'])): ?>
					<li class="nav-item <?php if ($this->params['controller'] == 'users' && $this->params['action'] == 'index') echo 'active'; ?>">
						<?php echo $this->Html->link('<i class="fas fa-users"></i>&nbsp;'.__('Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
					</li>
				<?php endif; ?>
				<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['appProperties']['index']) || in_array('semAutenticacao', $this->Session->read('perms')['appProperties']['index']) || in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['appProperties']['email']) || in_array('semAutenticacao', $this->Session->read('perms')['appProperties']['email'])): ?>
					<li class="nav-item <?php if ($this->params['controller'] == 'appProperties') echo 'active'; ?> dropdown">
						<?php echo $this->Html->link('<i class="fas fa-cogs"></i>&nbsp;'.__('App Properties'), '#', array('escape' => false, 'class' => 'nav-link dropdown-toggle', 'id' => 'dropdown01', 'data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false')); ?>
						<div class="dropdown-menu" aria-labelledby="dropdown01">
							<?php echo $this->Html->link(__('General'), array('controller' => 'appProperties', 'action' => 'index'), array('escape' => false, 'class' => 'dropdown-item')); ?>
							<?php echo $this->Html->link(__('Email'), array('controller' => 'appProperties', 'action' => 'email'), array('escape' => false, 'class' => 'dropdown-item')); ?>
						</div>
					</li>
				<?php endif; ?>
				<?php if (in_array($this->Session->read('Auth.User.role'), $this->Session->read('perms')['users']['updatePassword']) || in_array('semAutenticacao', $this->Session->read('perms')['users']['updatePassword'])): ?>
					<li class="nav-item <?php if ($this->params['controller'] == 'users' && $this->params['action'] == 'updatePassword') echo 'active'; ?>">
						<?php echo $this->Html->link('<i class="fas fa-key"></i>&nbsp;'.__('Update Password'), array('controller' => 'users', 'action' => 'updatePassword'), array('escape' => false, 'class' => 'nav-link')); ?>
					</li>
				<?php endif; ?>
			</ul>
			<ul class="navbar-nav pull-right">
				<?php if (!empty($this->Session->read('Auth'))): ?>
					<li class="nav-item">
						<?php echo $this->Html->link('<i class="fas fa-sign-out-alt"></i>&nbsp;'.__('Logout'), array('controller' => 'users', 'action' => 'logout'), array('escape' => false, 'class' => 'nav-link')); ?>
					</li>
				<?php endif; ?>
			</ul>
		  </div>
		</div>
	</nav>

    <main role="main" class="container">

		<?php echo $this->Flash->render('auth'); ?>

		<?php echo $this->Flash->render(); ?>

		<?php echo $this->fetch('content'); ?>

    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted"><?php echo __('Development by RMA3 &copy; 2018') ?></span>
      </div>
    </footer>

    <?php echo $this->Html->script(array(
        'jquery-3.3.1.min',
        'popper.min',
        'bootstrap.min',
		'/plugins/DataTables-1_10_19/datatables.min',
		'dataTables.default',
		'/plugins/moment-2_17_1/moment.min',
		'/plugins/bootstrap-datetimepicker-4_17_45/js/bootstrap-datetimepicker.min',
		'/plugins/select2-4.0.6/js/select2.min',
		'/plugins/select2-4.0.6/js/i18n/'.Configure::read('Config.language'),
		'custom.js',
    )); ?>

</body>
</html>
