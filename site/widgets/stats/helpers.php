<?php

function getPage($page = 'kirbystats') {
	$stats = page('kirbystats');
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
