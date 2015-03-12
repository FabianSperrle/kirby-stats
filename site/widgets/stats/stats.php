<?php
return array(
		'title' => 'Site stats',
		'html'  => function() {
		$stats = kirby()->site()->pages()->find('stats');
		$data = $stats->pages()->yaml();
		$hits = $stats->total_stats_count()->int();
		$dates = $stats->dates()->yaml();
		// Remove one level of nesting
		$clean = array();
		$history = array();
		foreach ($data as $page => $arr) {
			$clean[$page] = round($arr['count'] / $hits, 2);
		}
		foreach ($dates as $date => $arr) {
			$history[$date] = $arr['count'];
		}
		// Sort and keep 5 most important pages
		arsort($clean);
		$clean = array_slice($clean, 0, 5, true);
		return tpl::load(__DIR__ . DS . 'template.php', array('data' => $clean, 'history' => $history));
		}
		);
