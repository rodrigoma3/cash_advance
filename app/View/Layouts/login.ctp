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
			'signin',
			// 'floating-labels',
			'custom',
        ));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body class="text-center">

	<main role="main" class="container">

		<?php echo $this->Flash->render('auth'); ?>

		<?php echo $this->Flash->render(); ?>

		<?php echo $this->fetch('content'); ?>

	</main>

    <?php echo $this->Html->script(array(
        'jquery-3.3.1.min',
        'popper.min',
        'bootstrap.min',
		'custom.js',
    )); ?>

</body>
</html>
