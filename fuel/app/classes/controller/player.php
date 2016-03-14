<?php

class Controller_Player extends Controller_Template
{
	public function before()
	{
		parent::before();
		
		$this->template->js = array(
			'player.js',
		);
	}
	
	public function action_index()
	{
		
	}
	
	/**
	 * Création d'un nouveau joueur
	 */
	public function action_add()
	{
		$view = Presenter::forge('player/edit');
		$view->set('player', new Model_Player());
		
		$this->template->content = $view;
	}
	
	/**
	 * Edition d'un joueur
	 * @param unknown $player_id
	 */
	public function action_edit($player_id)
	{
		if (!($player = Model_Player::find_by_pk($player_id))) {
			return Response::redirect(Config::get('routes._root_'));	
		}
		
		$view = Presenter::forge('player/edit');
		$view->set('player', $player);
		
		$this->template->content = $view;
	}
}