<?php

class Controller_Rest_Game extends Controller_Rest
{
	public function post_action()
	{
		try {
			$game = Model_Game::find_by_pk(Input::post('game_id'));
			$playing_players = $game->get_playing_players();
			
			foreach ($playing_players as $player) {
				if ($player->player_id != Input::post('player_id')) {
					$versus_player_id = $player->player_id;
				}
			}
			
			$action = new Model_Game_Action(array(
				'game_id'			=> $game->id(),
				'player_id'			=> Input::post('player_id'),
				'versus_player_id'	=> $versus_player_id,
				'type'				=> Input::post('action'),
				'date'				=> date('Y-m-d H:i:s'),
			));
			
			$action->save();
			
			$response = array(
				'error'		=> false,
				'redirect'	=> Uri::create('game/live/'.$game->id()),
			);
			
			
			//Calcul des scores et changement de joueurs
			if ($action->process()) { //Fin de partie
				$response['redirect'] = 'game/stat/'.$game->id();
			}
			
		} catch (Exception $e) {
			$response = array(
				'error'		=> true,
				'message'	=> $e->getMessage(),
			);
		}
		
		return $this->response($response);
	}
	
	public function post_stat()
	{
		try {
			$response = array(
				'error'		=> false,
				'actions'	=> array(),
			);
			
			$game = Model_Game::find_by_pk(Input::post('game_id'));
			if (!$game) {
				throw new Exception('Partie invalide');
			}

			$scores = array();
			$players = $game->get_players();
			if (!$players) {
				throw new Exception('Aucun joueur sur cette partie');
			}
			
			foreach ($players as $player) {
				$score = $scores[$player->player_id] = Model_Game::BASE_SCORE + $player->handicap;
				$response['actions'][$player->player_id] = array(
					array(
						'date'		=> 0,
						'score'		=> $score,
					),
				);
				
				$response['users'][$player->player_id] = Model_Player::find_by_pk($player->player_id)->get_name();
			}
			
			
			$actions = $game->get_actions();
			
			if ($actions) {
				$i = 0;
				foreach ($actions as $action) {
					foreach ($players as $player) {
						if ($player->player_id == $action->player_id && $action->type == Model_Game_Action::TYPE_GOAL) {
							$response['actions'][$player->player_id][] = array(
								'date'		=> $i,
								'score'		=> $scores[$player->player_id]--,
							);
						} else if ($player->player_id == $action->versus_player_id && $action->type == Model_Game_Action::TYPE_GAMELLE) {
							$response['actions'][$player->player_id][] = array(
								'date'		=> $i,
								'score'		=> $scores[$player->player_id]++,
							);
						} else {
							$response['actions'][$player->player_id][] = array(
								'date'		=> $i,
								'score'		=> $scores[$player->player_id],
							);
						}
					}
					$i++;
				}
			}
			
			
		} catch (Exception $e) {
			$response = array(
				'error'		=> true,
				'message'	=> $e->getMessage(),
			);
		}
		
		return $this->response($response);
	}
}