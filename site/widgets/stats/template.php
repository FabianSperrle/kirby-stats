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
	<div class="field">
		<canvas id="myChart"></canvas>
	</div>
	<h2 class="hgroup hgroup-single-line cf">
	    <span class="hgroup-title">Most visited pages</span>
	</h2>
	<div class="field">
		<div class="dashboard-box">
			<ul id="stats2" class="sidebar-list">
				<?php $site = kirby()->site();
				// Determines if the list should link to the respective pages 
				$links = c::get('stats.links', true);
				// Detrmines the output format (absolut, percentage, both)
				$format = c::get('stats.format', 'percentage');
				foreach($data as $page => $hits):
					if ($links) {
						$open = '<a href="' . $site->url() . '/' . $page . '" target="_blank" ><i class="icon icon-left fa fa-file-o"></i>';
						$close = '</a>';
					} else {
						$open = '<span style="padding: .5em 1em;display:block">';
						$close = '</span>';
					}
					$value;
					switch ($format) {
						case "absolut":
							$value = $hits;
							break;

						case "percentage":
							$value = round($hits / $total, 2) * 100 . "%";
							break;

						case "both":
							$value = $hits . ' (' . round($hits / $total, 2) * 100 . "%)";
							break;
					}
					?>
					<li><?= $open ?><?= $page ?><span style="position:absolute;right:10px" class="shiv shiv-left shiv-grey"><?= $value ?></span><?= $close ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>

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
