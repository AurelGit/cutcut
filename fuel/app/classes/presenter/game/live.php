<?php

class Presenter_Game_Live extends Presenter
{
	public function view()
	{
		$this->playing_players = $this->game->get_playing_players();
		$this->waiting_players = $this->game->get_waiting_players();
	}
}