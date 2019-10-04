<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//facilities_level_distribution_chart
$config['facilities_level_distribution_chart_chartview'] = 'pages/dashboard/charts/column_drilldown_view';
$config['facilities_level_distribution_chart_title'] = 'Facility Level Distribution';
$config['facilities_level_distribution_chart_yaxis_title'] = 'facility count';
$config['facilities_level_distribution_chart_source'] = 'Source: ABS';
$config['facilities_level_distribution_chart_has_drilldown'] = TRUE;
$config['facilities_level_distribution_chart_filters'] = array('county', 'subcounty');
$config['facilities_level_distribution_chart_filters_default'] = array();