<?php

class Model_Player extends Model_Crud
{
	protected static $_table_name = 'player';
	protected static $_properties = array(
		'id',
		'lastname',
		'firstname',
		'nickname',
		'level',
		'enabled',
	);
	
	protected static $_defaults = array(
		'level'			=> 0,
		'enabled'		=> true,
	);
	
	protected static $_rules = array(
		'lastname'		=> 'required',
		'firstname'		=> 'required',
	);
	
	/**
	 * @var Model_Player_Sound[]
	 */
	protected $_sounds = false;
	
	public function get_picture()
	{
		$filename = 'player/'.$this->id().'.jpg';
		
		if ($this->is_new() || !Asset::get_file($filename, 'img')) {
			return 'player/default.png';
		}
		
		return $filename;
	}
	
	public function get_name()
	{
		return ($this->nickname ?: $this->firstname.' '.strtoupper($this->lastname[0]).'.');
	}
	
	public function thumbnail()
	{
		$view = Presenter::forge('player/thumbnail');
		$view->set('player', $this);
		
		return $view;
	}
	
	/**
	 * @return Model_Player_Sound[]
	 */
	public function get_sounds()
	{
		if ($this->_sounds === false) {
			$this->_sounds = Model_Player_Sound::find_by('player_id', $this->id());
		}
		
		return $this->_sounds;
	}
}