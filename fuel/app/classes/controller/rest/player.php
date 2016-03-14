<?php

class Controller_Rest_Player extends Controller_Rest
{
	public function post_save()
	{
		try {
			$player = Model_Player::find_by_pk(Input::post('player_id')) ?: new Model_Player();
			
			$player->set(array(
				'lastname'		=> Input::post('lastname'),	
				'firstname'		=> Input::post('firstname'),	
				'nickname'		=> Input::post('nickname'),	
			));
			
			if (!$player->save() && $player->validation()->error()) {
				throw new Exception($player->validation()->show_errors());
			}
			
			$response = array(
				'error'		=> false,
				'player_id'	=> $player->id(),
				'message'	=> 'Enregistrement effectué avec succès',
				'redirect'	=> '/'.Config::get('routes._root_'),
			);
		} catch (Exception $e) {
			$response = array(
				'error'		=> true,
				'message'	=> $e->getMessage(),
			);
		}
		
		return $this->response($response);
	}
}