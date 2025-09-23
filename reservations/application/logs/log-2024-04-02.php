<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-04-02 11:05:56 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
