<?php
require_once('helpers.php');

return array(
		'title' => 'Site stats',
		'html'  => function() {
			$stats = kirby()->site()->pages()->find('kirbystats');
			if (!$stats) {
				return tpl::load(__DIR__ . DS . 'template.php', array('nodata' => true));
			}
			$data = $stats->pages()->yaml();
			$hits = $stats->total_stats_count()->int();
			$dates = $stats->dates()->yaml();

			$clean = array();
			$history = array();

			// Remove one level of nesting and calculate percentage of total hits
			foreach ($data as $page => $arr) {
				$clean[$page] = round($arr['count'] / $hits, 2);
			}
			// Unnest
			foreach ($dates as $date => $arr) {
				$history[$date] = $arr['count'];
			}

			// Sort and keep 5 most important pages
			arsort($clean);
			$clean = array_slice($clean, 0, 5, true);
		}
		);
