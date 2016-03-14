<?php echo Form::open(); ?>

<div class="row">
<?php foreach ($players as $player) : ?>

	<div class="small-4 large-3 columns end">
	
		<?php echo $player->thumbnail(); ?>
	
	</div>

<?php endforeach; ?>
</div>

<div class="row">
	<div class="small-12 columns">
		<?php echo Form::submit(array(
			'name'		=> 'submit',
			'value'		=> 'Commencer une nouvelle partie',
			'class'		=> 'button expanded',
			'style'		=> 'position: fixed; bottom: 0;'
		)); ?>
	</div>
</div>

<?php echo Form::close(); ?>