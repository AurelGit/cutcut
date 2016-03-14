<div class="row">
	<div class="small-2 columns">
		<?php echo Html::anchor('#', '<span class="fa fa-arrow-left"></span> Annuler', array(
			'name'		=> 'cancel',
			'style'		=> 'color:red'
		)); ?>
	</div>
</div>

<!-- Joueurs en place -->
<div class="row live-players">
	<?php foreach ($playing_players as $player) : ?>
		<div class="small-5 columns">
			<div class="row">
				<div class="small-12 columns text-center">
					<?php echo $player->player_thumbnail(); ?>
				</div>
			</div>
			<hr/>
			
			<div class="actions">
				<div class="row">
					<div class="small-12 columns">
						<?php echo Form::button(array(
							'name'			=> 'action',
							'value'			=> 'BUT',
							'class'			=> 'button expanded',
							'data-action'	=> Model_Game_Action::TYPE_GOAL,
							'data-player'	=> $player->player_id,
							'data-game'		=> $player->game_id,
						)); ?>
					</div>
				</div>
				<div class="row">
					<div class="small-12 columns">
						<?php echo Form::button(array(
							'name'			=> 'action',
							'value'			=> 'GAMELLE',
							'class'			=> 'button expanded',
							'data-action'	=> Model_Game_Action::TYPE_GAMELLE,
							'data-player'	=> $player->player_id,
							'data-game'		=> $player->game_id,
						)); ?>
					</div>
				</div>
				<div class="row">
					<div class="small-12 columns">
						<?php echo Html::anchor('#', '+ actions spéciales', array(
						)); ?>
					</div>
				</div>
			</div>
		</div>
		
		<?php if (!isset($middle)) : ?>
			<?php $middle = true; ?>
			<div class="small-2 columns text-center">
				<div class="row vs">
					<div class="small-12 columns">
						VS.
					</div>
				</div>
				<div class="row timer">
					<div class="small-12 columns">
						<span id="timer-value">00:00</span>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>

<hr/>

<!-- Joueurs en attente -->
<div class="row">
	<div class="small-12 columns">
		<h5>Prochains joueurs à entrer en jeu</h5>
	</div>
	<?php foreach ($waiting_players as $player) : ?>
		<div class="small-2 columns end">
			<?php echo $player->player_thumbnail(); ?>
		</div>
	<?php endforeach; ?>
</div>