<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined offset: 0 /home1/eagle7/public_html/insideloscabos.com/application/controllers/Blogs.php 102
ERROR - 2017-12-20 10:17:24 --> Severity: Warning --> extract() expects parameter 1 to be array, null given /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 1
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: authorImage /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 14
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: author /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 17
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: createdAt /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 18
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: image /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 26
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: name /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 26
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: name /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 32
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: description /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 35
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: slug /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 53
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: slug /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 56
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: name /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 59
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: name /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 59
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: slug /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 59
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: id /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 94
ERROR - 2017-12-20 10:17:24 --> Severity: Notice --> Undefined variable: id /home1/eagle7/public_html/insideloscabos.com/application/views/module/blog-detail.php 186
ERROR - 2017-12-20 10:27:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '= 0',tags)
ORDER BY `blogs`.`createdAt` desc
 LIMIT 2' at line 4 - Invalid query: SELECT blogs.*, createdAt, concat('https://www.insideloscabos.com/cms_images/blog_images/original/', blogs.image) as image, concat('https://www.insideloscabos.com/cms_images/user_images/thumb/', admin.image) as authorImage
FROM `blogs`
INNER JOIN `admin` ON `admin`.`id` = `blogs`.`authorId`
WHERE `blogs`.`status` = '1' and find_in_set('%20CABO'A = 0',tags)
ORDER BY `blogs`.`createdAt` desc
 LIMIT 2
