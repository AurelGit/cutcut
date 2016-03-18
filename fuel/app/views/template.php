<!doctype html>

<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">

	<title><?php echo isset($title) ? $title : null; ?></title>
	<meta name="author" content="Aur�lien">
	
	<?php echo Asset::css(array(
		'foundation.min.css',
		'vendor/fa/font-awesome.min.css',
		'template.css',
		'loading.css',
	)); ?>
	
	<?php echo isset($css) ? Asset::css($css) : null;?>
	
	<?php echo Asset::js(array(
		'jquery-2.2.0.min.js',
		'foundation.min.js',
		'template.js',
// 		'vendor/what-input.min.js',
	)); ?>
	
	<?php echo isset($js) ? Asset::js($js) : null;?>
</head>

<body>
	<div id="message" class="row hide">
		<div class="small-12 columns">
			<div class="callout" data-closable>
				<p class="content"></p>
				<button class="close-button" type="button" data-close>
			    	<span aria-hidden="true">&times;</span>
			  	</button>
			</div>
		</div>
	</div>
	<div id="main">
		<?php echo isset($content) ? $content : null; ?>
	</div>
	
	<script>
		$(document).foundation();
	</script>
</body>
</html>