<?php

class Presenter_Game_Edit extends Presenter
{
	public function view()
	{
		$this->players = Model_Player::find(function($query) {
			$query
				->where('enabled', true)
				->order_by('level', 'DESC')
			;
		}, 'id');
	}
}