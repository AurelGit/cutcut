<?php

class Model_Game_Player extends Model_Crud
{
	const STATUS_RED = 1;
	const STATUS_BLUE = 2;
	const STATUS_WAITING = 3;
	
	protected static $_table_name = 'game_player';
	protected static $_properties = array(
		'game_id',
		'player_id',
		'rank',
		'handicap',
		'status',
		'remainder',
	);
	
	protected static $_defaults = array(
		'handicap'		=> 0,
		'remainder'		=> Model_Game::BASE_SCORE,
	);
	
	protected $_player = false;
	
	public function get_player()
	{
		if ($this->_player === false) {
			$this->_player = Model_Player::find_by_pk($this->player_id);
		}
		
		return $this->_player;
	}
	
	public function player_thumbnail()
	{
		$view = Presenter::forge('player/live');
		$view->set('game_player', $this);
		
		return $view;
	}
}