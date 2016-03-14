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
				$response['redirect'] = 'TODO';
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