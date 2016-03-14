<?php

class Model_Game extends Model_Crud
{
	const BASE_SCORE = 7;
	
	protected static $_table_name = 'game';
	protected static $_properties = array(
		'id',
		'begin',
		'end',
	);
	
	protected $_players = false;
	protected $_playing_players = false;
	protected $_waiting_players = false;
	
	public function get_players()
	{
		if ($this->_players === false) {
			$this->_players = Model_Game_Player::find(function($query) {
				$query
					->where('game_id', $this->id())
					->order_by('rank', 'ASC')
				;
			});
		}
		
		return $this->_players;
	}
	
	public function get_playing_players()
	{
		if ($this->_playing_players === false) {
			$this->_playing_players = Model_Game_Player::find(function($query) {
				$query
					->where('game_id', $this->id())
					->where('status', 'IN', array(Model_Game_Player::STATUS_BLUE, Model_Game_Player::STATUS_RED))
					->order_by('status', 'ASC')
				;
			});
		}
		
		return $this->_playing_players;
	}
	
	public function get_waiting_players()
	{
		if ($this->_waiting_players === false) {
			$this->_waiting_players = Model_Game_Player::find(function($query) {
				$query
					->where('game_id', $this->id())
					->where('status', Model_Game_Player::STATUS_WAITING)
					->order_by('rank', 'ASC')
				;
			});
		}
		
		return $this->_waiting_players;
	}
}