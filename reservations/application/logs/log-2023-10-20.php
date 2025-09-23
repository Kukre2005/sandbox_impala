<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-10-20 13:24:26 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-10-20 16:14:58 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-10-20 16:15:18 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT *
FROM `hotels`
WHERE `status` = '1' and (id in (select hotels from hotelgroups where name = 'TeresaKing' and `type` = 'private_transport') or find_in_set(id,(select hotels from hotelgroups where name = 'TeresaKing' and type = 'private_transport')))
ORDER BY `name` asc
ERROR - 2023-10-20 16:15:19 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT *
FROM `hotels`
WHERE `status` = '1' and (id in (select hotels from hotelgroups where name = 'TeresaKing' and `type` = 'private_transport') or find_in_set(id,(select hotels from hotelgroups where name = 'TeresaKing' and type = 'private_transport')))
ORDER BY `name` asc
ERROR - 2023-10-20 18:44:36 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
