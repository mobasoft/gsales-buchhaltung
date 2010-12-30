<?php
include_once('../init.php');
include_once(GBLIBS.DS.'ofc'.DS.'open-flash-chart.php');
$x = new x_axis();
$x->set_3d(5);
$x->set_colour('#b1b1b1');
$x->set_grid_colour('#ffffff');
$x->set_range(0,1);
$x->set_labels_from_array(array('Eingang','Ausgang'));

$y = new y_axis();
$y->set_colour('#b1b1b1');
$y->set_grid_colour('#ffffff');
$y->set_range(0,1100);

$title = new title('Umsatz Heute');
$title->set_style('{font-size:11px;color:#b1b1b1}');

$bar = new bar();
$bar->set_values(array(1050,600));
$bar->set_colour('#4552df');
$bar->set_on_show(new bar_on_show('grow-up',0.7,0.3));

$chart = new open_flash_chart();
$chart->set_title($title);
$chart->set_bg_colour('#ffffff');
$chart->set_x_axis($x);
$chart->set_y_axis($y);
$chart->add_element($bar);
echo $chart->toPrettyString();