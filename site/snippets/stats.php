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
$data = $stats->pages()->yaml();
$dates = $stats->dates()->yaml();
$date = date("d.m.y");
$val = (array_key_exists($param, $data)) ? (int) $data[$param]['count'] + 1 : 1;
$today = (array_key_exists($date, $dates)) ? (int) $dates[$date]['count'] + 1 : 1;
$total = (!$stats->total_stats_count()->isEmpty()) ? $stats->total_stats_count()->int() + 1 : 1;
$data[$param] = array('count' => $val);
$dates[$date] = array('count' => $today);
$dates = array_slice($dates, -5, 5, true);
try {
	$stats->update(array('pages' => yaml::encode($data), 'dates' => yaml::encode($dates), 'total_stats_count' => $total, ));
} catch (Exception $e) {
	echo $e->getMessage();
	exit;
}
