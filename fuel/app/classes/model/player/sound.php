<?php

class Model_Player_Sound extends Model_Crud
{
	protected static $_table_name = 'player_sound';
	protected static $_properties = array(
		'id',
		'player_id',
		'file',
	);
}