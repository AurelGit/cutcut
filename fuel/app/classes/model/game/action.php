<?php

class Model_Game_Action extends Model_Crud
{
	const TYPE_GAMELLE = 1;
	const TYPE_GOAL = 2;
	
	protected static $_table_name = 'game_action';
	protected static $_properties = array(
		'id',
		'game_id',
		'player_id',
		'versus_player_id',
		'type',
		'date',
	);
	
	/**
	 * Modifie les scores et status des joueurs en cours de partie 
	 * selon l'action effectuée
	 * 
	 * @return boolean true si la partie est terminée, false sinon
	 */
	public function process()
	{
		$end = false;
		
		$winner = Model_Game_Player::find_one_by(function($query) {
			$query
				->where('game_id', $this->game_id)
				->where('player_id', $this->player_id)
			;
		});

		$looser = Model_Game_Player::find_one_by(function($query) {
			$query
				->where('game_id', $this->game_id)
				->where('player_id', $this->versus_player_id)
			;
		});
		
		$next_player = Model_Game_Player::find_one_by(function($query) use($winner, $looser) {
			$query
				->where('game_id', $this->game_id)
				->where('status', Model_Game_Player::STATUS_WAITING)
				->where('rank', max($winner->rank, $looser->rank) + 1)
			;
		}) ?: Model_Game_Player::find_one_by(function($query) {
			$query
				->where('game_id', $this->game_id)
				->where('status', Model_Game_Player::STATUS_WAITING)
				->order_by('rank', 'ASC')
				->limit(1)
			;
		});
		
		switch ($this->type) {
			case self::TYPE_GOAL:
				//Un point en moins à marquer pourle gagnat
				$winner->remainder--;
				$winner->save();
				
				if ($winner->remainder <= 0) { //fin de partie
					$end = true;
				}
				break;
			case self::TYPE_GAMELLE:
				//Un point en plus à marquer pour le perdant
				$looser->remainder++;
				$looser->save();
				
				break;
			default: 
				throw new Exception('Action invalide');
		}
		
		//Le perdant sort
		$looser->status = Model_Game_Player::STATUS_WAITING;
		$looser->save();
		
		//Nouveau joueur entrant
		$next_player->status = ($winner->status == Model_Game_Player::STATUS_BLUE ? Model_Game_Player::STATUS_RED : Model_Game_Player::STATUS_BLUE);
		$next_player->save();
		
		return $end;
	}
	
}