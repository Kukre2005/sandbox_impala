<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-03-20 01:29:40 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' Hurricane'',tags)
ORDER BY `blogs`.`createdAt` desc
 LIMIT 2' at line 4 - Invalid query: SELECT blogs.*, createdAt, concat('https://www.insideloscabos.com/cms_images/blog_images/original/', blogs.image) as image, concat('https://www.insideloscabos.com/cms_images/user_images/thumb/', admin.image) as authorImage
FROM `blogs`
INNER JOIN `admin` ON `admin`.`id` = `blogs`.`authorId`
WHERE `blogs`.`status` = '1' and find_in_set(' Hurricane'',tags)
ORDER BY `blogs`.`createdAt` desc
 LIMIT 2
ERROR - 2018-03-20 06:47:48 --> Severity: Notice --> Undefined variable: html /home1/eagle7/public_html/insideloscabos.com/application/controllers/Blogs.php 248
