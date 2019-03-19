<?php

class Preview extends \App\Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->view->render('layout/global', array('content' => 'preview/preview'));
	}

}