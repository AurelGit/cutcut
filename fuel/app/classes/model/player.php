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
}