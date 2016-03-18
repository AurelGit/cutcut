<div class="player-thumbnail" data-id="<?php echo $game_player->get_player()->id(); ?>">
	<?php echo Asset::img($game_player->get_player()->get_picture(), array(
			'class'		=> 'picture',
		)); ?>
	<div class="level">
		<span class="label level-value level-<?php echo $game_player->get_player()->level; ?>">Niveau <?php echo $game_player->get_player()->level; ?></span>
	</div>
	<div class="name">
		<span class="label"><?php echo $game_player->get_player()->get_name(); ?></span>
	</div>
	<div class="remainder">
		<span class="badge"><?php echo $game_player->remainder; ?></span>
	</div>
</div>


<?php if ($game_player->get_player()->get_sounds()) : ?>
<audio id="sound-<?php echo $game_player->get_player()->id(); ?>">
	<source src="/assets/sounds/<?php echo $game_player->get_player()->id(); ?>/<?php echo $game_player->get_player()->get_sounds()[0]->file; ?>">
</audio>
<?php endif; ?>