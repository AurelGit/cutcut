<?php

class Controller_Game extends Controller_Template 
{
	public function before()
	{
		parent::before();
	}
	
	/**
	 * Créer une nouvelle partie
	 */
	public function action_add()
	{
		$this->template->js = array(
			'game/add.js',
		);
		
		$view = Presenter::forge('game/edit');
		$view->set('game', new Model_Game());
		
		if (Input::method() == 'POST') {
			$game = new Model_Game(array(
				'begin'		=> date('Y-m-d H:i:s'),
			));
			$game->save();
			
			$player_ids = Input::post('players');
			
			if (!$player_ids) {
				throw new Exception('Aucun joueur sélectionné');
			}
			
			//Chargement des objets
			$players = array();
			foreach ($player_ids as $player_id) {
				$players[] = Model_Player::find_by_pk($player_id);
			}
			
			//Définition de l'ordre des joueurs
			//Du plus petit niveau au plus élevé
			//En cas d'égalité de niveau, tirage aléatoire
			usort($players, function($a, $b) {
				if ($a->level == $b->level) {
					return ((rand(0, 99) % 2 == 0) ? 1 : -1);
				}
					
				return $a->level > $b->level;
			});
			
			//Définition des scores de base de chaque joueur
			$min_level = $players[0]->level;
			
			foreach ($players as $order => $player) {
				$rank = $order + 1;
				$handicap = $player->level - $min_level;
				
				$game_player = new Model_Game_Player(array(
					'game_id'		=> $game->id(),
					'player_id'		=> $player->id(),
					'rank'			=> $rank,
					'handicap'		=> $handicap,
					'status'		=> $rank == 1 ? Model_Game_Player::STATUS_RED : 
									  ($rank == 2 ? Model_Game_Player::STATUS_BLUE : Model_Game_Player::STATUS_WAITING),
					'remainder'		=> Model_Game::BASE_SCORE + $handicap,
				));
				
				$game_player->save();
			}
			
			return Response::redirect('game/live/'.$game->id());
		}
		
		$this->template->content = $view;
	}
	
	/**
	 * Partie en cours
	 * @param int $game_id
	 */
	public function action_live($game_id)
	{
		$this->template->js = array(
			'game/live.js',
		);
		$this->template->css = array(
			'game/live.css',
		);
		$this->template->title = 'Partie en cours';
		
		if (!($game = Model_Game::find_by_pk($game_id))) {
			return Response::redirect(Config::get('routes._root_'));
		}
		
		$view = Presenter::forge('game/live');
		$view->set('game', $game);
		
		$this->template->content = $view;
	}
	
	public function action_stat($game_id)
	{
		$this->template->js = array(
			'vendor/flot/jquery.flot.min.js',
			'game/stat.js',
		);
		$this->template->css = array(
			'game/stat.css',
		);
		
		$this->template->title = 'Statistiques';
		
		if (!($game = Model_Game::find_by_pk($game_id))) {
			return Response::redirect(Config::get('routes._root_'));
		}
		
		$view = Presenter::forge('game/stat');
		$view->set('game', $game);
		
		$this->template->content = $view;
	}
}