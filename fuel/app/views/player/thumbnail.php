<div class="player-thumbnail">
	<label for="player_<?php echo $player->id(); ?>">
		<?php echo Asset::img($player->get_picture()); ?>
		<div class="level">
			<span class="label level-value level-<?php echo $player->level; ?>">Niveau <?php echo $player->level; ?></span>
		</div>
		<div class="name">
			<span class="label"><?php echo $player->get_name(); ?></span>
		</div>
	</label>
	<?php echo Form::checkbox(array(
		'id'		=> 'player_'.$player->id(),
		'name'		=> 'players[]',
		'value'		=> $player->id(),
		'class'		=> 'hide',
	)); ?>
</div>