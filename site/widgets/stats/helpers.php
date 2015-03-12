<?php

function getPage($page = 'kirbystats') {
	$stats = kirby()->site()->pages()->find('kirbystats');
	if (!$stats) {
		try {
			$stats = site()->pages()->create('kirbystats', 'stats');
		} catch (Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}

	return $stats;
}
