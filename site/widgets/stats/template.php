<div width="100%"><canvas id="myChart"></canvas></div>
<ul id="stats" class="sidebar-list">
	<?php foreach($data as $page => $percentage): ?>
		<li><span><?php echo $page ?>:</span><small class="marginalia shiv shiv-left shiv-white"><?php echo $percentage * 100 ?>%</small></li>
	<?php endforeach; ?>
</ul>

<?php echo js("assets/js/Chart.js"); ?>
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

