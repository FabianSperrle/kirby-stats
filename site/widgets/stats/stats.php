<?php
return array(
		'title' => 'Site stats',
		'html'  => function() {
			$stats = kirby()->site()->pages()->find('stats');
			$pages = $stats->pages()->yaml();
			$dates = $stats->dates()->yaml();
			$hits = $stats->total_stats_count()->int();

			$clean = array();
			$history = array();
			// Remove on nesting level and calculate percentage of total hits
			// in one go
			foreach ($pages as $page => $arr) {
				$clean[$page] = round($arr['count'] / $hits, 2);
			}

			// Remove one level of nesting for the day-specific hit counters
			foreach ($dates as $date => $arr) {
				$history[$date] = $arr['count'];
			}

			// Sort and keep 5 most important (most accessed) pages
			arsort($clean);
			$clean = array_slice($clean, 0, 5, true);

			return tpl::load(__DIR__ . DS . 'template.php', array('data' => $clean, 'history' => $history));
		}
		);
