<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-11-30 14:18:10 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-11-30 14:18:51 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT *
FROM `hotels`
WHERE `status` = '1' and (id in (select hotels from hotelgroups where name = 'TeresaKing' and `type` = 'private_transport') or find_in_set(id,(select hotels from hotelgroups where name = 'TeresaKing' and type = 'private_transport')))
ORDER BY `name` asc
ERROR - 2023-11-30 14:18:51 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT *
FROM `hotels`
WHERE `status` = '1' and (id in (select hotels from hotelgroups where name = 'TeresaKing' and `type` = 'private_transport') or find_in_set(id,(select hotels from hotelgroups where name = 'TeresaKing' and type = 'private_transport')))
ORDER BY `name` asc
ERROR - 2023-11-30 22:54:48 --> Query error: Unknown column 'cost_undefined_1_5' in 'field list' - Invalid query: SELECT cost_undefined_1_5
FROM `hotelgroups`
WHERE find_in_set('undefined',hotels) !=0 and `type` = 'undefined'
ERROR - 2023-11-30 22:55:03 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT *
FROM `hotels`
WHERE `status` = '1' and (id in (select hotels from hotelgroups where name = 'TeresaKing' and `type` = 'private_transport') or find_in_set(id,(select hotels from hotelgroups where name = 'TeresaKing' and type = 'private_transport')))
ORDER BY `name` asc
ERROR - 2023-11-30 22:55:03 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT *
FROM `hotels`
WHERE `status` = '1' and (id in (select hotels from hotelgroups where name = 'TeresaKing' and `type` = 'private_transport') or find_in_set(id,(select hotels from hotelgroups where name = 'TeresaKing' and type = 'private_transport')))
ORDER BY `name` asc
