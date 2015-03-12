<?php
c::set('routes', array(
			// STATS Counter
			array(
				'pattern' => '/(:all?)',
				'action'  => function($param) {
						$s = site()->visit($param);
						snippet('stats', array('param' => $param));
						return $s;
					}
				),
			array(
				'pattern' => '(:any)',
				'action'  => function($param) {
						$s = site()->visit($param);
						snippet('stats', array('param' => $param));
						return $s;
					}
				),
			array(
				'pattern' => '(:any)/(:all)',
				'action'  => function($param, $param2) {
						$param = $param . "/" . $param2;
						$s = site()->visit($param);
						snippet('stats', array('param' => $param));
						return $s;
					}
				),
			));

