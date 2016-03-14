<div class="player-thumbnail">
	<?php echo Asset::img($game_player->get_player()->get_picture()); ?>
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