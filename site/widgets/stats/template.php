<?php if($nodata): ?>
	<div class="dashboard-box">
		<div class="text">
			<h3>No data yet...</h3>
			You don't seem to have visited any pages yet. Did you just install the plugin?
			Browse through your site and come back here in a minute!
			<h3>...still nothing?</h3>
			If this message persists the plugin is unable to create a new page to store its data.
			Please head over <a href="https://github.com/FabianSperrle/kirby-stats/issues">to Github</a> and file a report!
		</div>
	</div>
<?php else: ?>
	<div width="100%"><canvas id="myChart"></canvas></div>
	<ul id="stats" class="sidebar-list">
		<?php foreach($data as $page => $percentage): ?>
			<li><span><?php echo $page ?>:</span><small class="marginalia shiv shiv-left shiv-white"><?php echo $percentage * 100 ?>%</small></li>
		<?php endforeach; ?>
	</ul>

	<?php echo js("assets/js/Chart.min.js"); ?>
	<script>
	var ctx = document.getElementById("myChart").getContext("2d");
	var data = {
		labels: <?php echo a::json(array_keys($history)) ?>,
		datasets: [
			{
				label: "Kirby Stats",
				fillColor: "rgba(141, 174, 40, 0.3)",
				strokeColor: "rgba(141, 174, 40, 0.8)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: <?php echo a::json(array_values($history)) ?>,
			},
		]
	};
	var myLineChart = new Chart(ctx).Line(data, {
		'bezierCurve': false,
		'responsive': true,
	});
	</script>
<?php endif; ?>
