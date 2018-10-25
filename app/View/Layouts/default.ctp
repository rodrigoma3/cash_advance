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
		<?php echo $this->Html->link(__('Cash advance'), '/', array('escape' => false, 'class' => 'navbar-brand')); ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
              <?php echo $this->Html->link('<i class="fas fa-folder-open"></i>&nbsp;'.__('Proas'), array('controller' => 'proas', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
          </li>
          <li class="nav-item">
            <?php echo $this->Html->link('<i class="fas fa-file-signature"></i>&nbsp;'.__('Rubrics'), array('controller' => 'rubrics', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
          </li>
          <li class="nav-item">
              <?php echo $this->Html->link('<i class="fas fa-users"></i>&nbsp;'.__('Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="container">
	<!-- <div class="container"> -->

		<?php echo $this->Flash->render(); ?>

		<?php echo $this->fetch('content'); ?>
	<!-- </div> -->


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
		'custom.js',
    )); ?>

</body>
</html>
