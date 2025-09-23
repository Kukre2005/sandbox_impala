<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-10-25 03:04:52 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
