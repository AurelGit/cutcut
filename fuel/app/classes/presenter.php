<?php


class Presenter extends Fuel\Core\Presenter
{
	public static function forge($presenter, $method = 'view', $auto_filter = null, $view = null)
	{
		try {
			return parent::forge($presenter, $method, $auto_filter, $view);
		} catch (OutOfBoundsException $exception) {
			return View::forge($presenter);
		}
	}
}