<?php 
$site = site();

/* Check if data should be logged for the current user */

// Roles for which nothing is logged 
$ignore = c::get('stats.roles.ignore', "");
// Number of days to keep per-day totals for. Ensure that this is positive...
$days = c::get('stats.days', 5);
$days = ($days < 0) ? 5 : $days;
// Date format
$date_format = c::get('stats.date.format', 'd.m.y');

// Home doesn't have any url parameter apart from / which gets truncated, 
// set one by hand
if ($param == ""){
	$param = c::get('home', 'home');
}

// Check whether to ignore the current user
if ($user = $site->user()) {
	// Ignore everybody
	if ($ignore == "_all") {
		return;
	}

	// Multiple rules to be ignored, test each of them
	if (is_array($ignore)) {
		foreach ($ignore as $role) {
			if($user->hasRole($role)) {
				return;
			}
		}
	}

	// Only one rule or empty string if ignoring nobody
	if ($user->hasRole($ignore)) {
		return;
	}
}

/* Session mode */

if (c::get('stats.session', false)) {
	s::start();
	// Get the already visited pages
	$urls = s::get('stats', array());
	// User has visited this page already in this session. Do nothing.
	if (in_array($param, $urls)) {
		return;
	}
	// User has never been here. Add the url and put back in the session storage
	$urls[] = $param;
	s::set('stats', $urls);
}

require_once(__DIR__ . DS . '../widgets/stats/helpers.php');

$stats = getPage();

// Get data
$data = $stats->pages()->yaml();
$dates = $stats->dates()->yaml();
$date = date($date_format);

if ($data == null) $data = array();
if ($dates == null) $dates = array();

// calculate new values
$val = (array_key_exists($param, $data)) ? (int) $data[$param]['count'] + 1 : 1;
$today = (array_key_exists($date, $dates)) ? (int) $dates[$date]['count'] + 1 : 1;
$total = (!$stats->total_stats_count()->isEmpty()) ? $stats->total_stats_count()->int() + 1 : 1;

// update arrays
$data[$param] = array('count' => $val);
$dates[$date] = array('count' => $today);

// keep only the last $days days
$dates = array_slice($dates, $days * -1, $days, true);

try {
	$stats->update(array('pages' => yaml::encode($data), 'dates' => yaml::encode($dates), 'total_stats_count' => $total, ));
} catch (Exception $e) {
	echo $e->getMessage();
	exit;
}
//}
