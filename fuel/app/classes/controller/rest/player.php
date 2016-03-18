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
			
			$config = array(
			    'path' 			=> DOCROOT.'assets/sounds/'.$player->id(),
			    'ext_whitelist' => array('mp3', 'ogg', 'mp4'),
			);
			
			Upload::process($config);
			
			if (Upload::is_valid()) {
			    Upload::save();
			    $sound = new Model_Player_Sound(array(
		    		'player_id'		=> $player->id(),
		    		'file'			=> Upload::get_files(0)['saved_as'],
			    ));
			    $sound->save();
			}
			
			$response = array(
				'error'		=> false,
				'player_id'	=> $player->id(),
				'message'	=> 'Enregistrement effectué avec succès',
				'redirect'	=> '/player/edit/'.$player->id(),
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