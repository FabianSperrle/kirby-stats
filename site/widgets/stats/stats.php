<?php
require_once('helpers.php');

return array(
		'title' => 'Site stats',
		'html'  => function() {
			$site = site();
			// Get the content in the default language
			$stats = page('kirbystats');
			/*if ($site->multilang()) {
				$l = $site->defaultLanguage()->code();
				$stats = $stats->content($l);
			}**/
			if (!$stats) {
				return tpl::load(__DIR__ . DS . 'template.php', array('nodata' => true));
			}

			// Save the values of the default language 
			// We'll compare all other languages with them later to make sure we
			// don't include the count for the default language multiple times just 
			// because we don't have data for that language yet.
			$data = $stats->pages()->yaml();
			$hits = $stats->total_stats_count()->int();
			$dates = $stats->dates()->yaml();

			$clean = array();
			$history = array();

			// Remove one level of nesting and calculate percentage of total hits
			foreach ($data as $page => $arr) {
				$clean[$page] = $arr['count'];
			}
			// Unnest
			foreach ($dates as $date => $arr) {
				$history[$date] = $arr['count'];
			}

			// Sort and keep 5 most important pages
			arsort($clean);
			$clean = array_slice($clean, 0, 5, true);
			return tpl::load(__DIR__ . DS . 'template.php', array('nodata' => false, 'data' => $clean, 'history' => $history, 'total' => $hits));
		}
		);
