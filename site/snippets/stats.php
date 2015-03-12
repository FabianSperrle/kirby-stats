<?php 

$site = site();
$stats = page('stats');
if (!$stats) {
	try {
		$stats = site()->pages()->create('stats', 'stats');
	} catch (Exception $e) {
		echo $e->getMessage();
		exit;
	}
}

// Get current information
$pages = $stats->pages()->yaml();
$dates = $stats->dates()->yaml();
$date = date("d.m.y");

// Update or create depending on result
$val = (array_key_exists($param, $pages)) ? (int) $pages[$param]['count'] + 1 : 1;
$today = (array_key_exists($date, $dates)) ? (int) $dates[$date]['count'] + 1 : 1;
$total = (!$stats->total_stats_count()->isEmpty()) ? $stats->total_stats_count()->int() + 1 : 1;

// Create new data
$pages[$param] = array('count' => $val);
$dates[$date] = array('count' => $today);
$dates = array_slice($dates, -5, 5, true);

// Save
try {
	$stats->update(array('pages' => yaml::encode($pages), 'dates' => yaml::encode($dates), 'total_stats_count' => $total, ));
} catch (Exception $e) {
	echo $e->getMessage();
	exit;
}
