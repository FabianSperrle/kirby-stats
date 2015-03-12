<?php
c::set('language.detect', true);
c::set('languages', array(
				'code'    => 'de-de',
				'name'    => 'Deutschland',
				'locale'  => 'de_DE',
				'url'     => '/de',
				'default' => true,
				),
			));

c::set('routes', array(
			// STATS Counter
			array(
				'pattern' => 'de/(:all)',
				'action'  => function($param) {
						$s = site()->visit($param);
						snippet('stats', array('param' => $param));
						return $s;
					}
				),
			));

