<?php

class View {

	public function render($tpl, $pageData) {
		include 'views/'. $tpl;
        exit();
	}

}