<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-12-15 05:01:24 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-12-15 05:01:25 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-12-15 06:03:14 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-12-15 11:41:27 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-12-15 11:41:39 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-12-15 14:13:18 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-12-15 14:20:36 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-12-15 14:20:59 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT *
FROM `hotels`
WHERE `status` = '1' and (id in (select hotels from hotelgroups where name = 'A&T2024' and `type` = 'private_transport') or find_in_set(id,(select hotels from hotelgroups where name = 'A&T2024' and type = 'private_transport')))
ORDER BY `name` asc
ERROR - 2023-12-15 14:21:00 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT *
FROM `hotels`
WHERE `status` = '1' and (id in (select hotels from hotelgroups where name = 'A&T2024' and `type` = 'private_transport') or find_in_set(id,(select hotels from hotelgroups where name = 'A&T2024' and type = 'private_transport')))
ORDER BY `name` asc
