<?php

namespace app\controllers;
use app\models\AddToDb;
use app\classes\View;

class Controller {

	protected $result = [];

	public function run(){
		$model = new AddToDb;
		$view = new View;

		($record = $model->countrecord()[0]['count']) && $result = $model->randomrecord(mt_rand(0, $record-1));

		$model->updatestatus($result[0]['name']);
		$view->display($result);
	}
}