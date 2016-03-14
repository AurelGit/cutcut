<?php echo Form::open(array(
	'enctype'		=> 'multipart/form-data',
)); ?>

<?php echo Form::hidden('player_id', $player->id()); ?>

<div class="row">
	<div class="small-4 columns">
		<?php echo Asset::img($player->get_picture()); ?>
	</div>
	<div class="small-8 columns">
		<div class="row">
			<div class="small-12 columns">
				<label>
					Surnom
					<?php echo Form::input(array(
						'name'		=> 'nickname',
						'value'		=> $player->nickname,
					)); ?>
				</label>
			</div>
			<div class="small-12 columns">
				<label>
					Nom *
					<?php echo Form::input(array(
						'name'		=> 'lastname',
						'value'		=> $player->lastname,
					)); ?>
				</label>
			</div>
			<div class="small-12 columns">
				<label>
					Prénom *
					<?php echo Form::input(array(
						'name'		=> 'firstname',
						'value'		=> $player->firstname,
					)); ?>
				</label>
			</div>
			<div class="small-12 columns">
				<label>
					Photo
					<?php echo Form::file(array(
						'name'		=> 'picture',
					)); ?>
				</label>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="small-12 columns">
		<?php echo Form::submit(array(
			'name'		=> 'submit',
			'value'		=> 'Enregistrer',
			'class'		=> 'button expanded',
		)); ?>
	</div>
</div>

<?php echo Form::close(); ?>