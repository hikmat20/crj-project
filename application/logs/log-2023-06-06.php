<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-06-06 08:40:51 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/crj/application/modules/users/views/login_animate.php 6
ERROR - 2023-06-06 08:40:52 --> 404 Page Not Found: /index
ERROR - 2023-06-06 08:48:01 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/crj/application/modules/users/views/login_animate.php 6
ERROR - 2023-06-06 08:48:02 --> 404 Page Not Found: /index
ERROR - 2023-06-06 08:48:06 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/crj/application/modules/users/views/login_animate.php 6
ERROR - 2023-06-06 08:48:06 --> 404 Page Not Found: /index
ERROR - 2023-06-06 08:48:22 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/crj/application/modules/menus/views/menus_form.php 70
ERROR - 2023-06-06 16:40:11 --> 404 Page Not Found: /index
ERROR - 2023-06-06 16:40:12 --> Query error: Table 'crj_db.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = '6c3e8ea75663fd6caee4aa2a2d86aa81a2d93f58'
ERROR - 2023-06-06 16:40:13 --> Query error: Table 'crj_db.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = 'e130dad57ffdc135f2547d6199dafe24ec3913bf'
ERROR - 2023-06-06 16:40:15 --> Query error: Table 'crj_db.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = '0a13c0667b946963e5146135129d583f8deb98bc'
ERROR - 2023-06-06 16:40:15 --> Query error: Table 'crj_db.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = 'a551c44717c5becc7635db3a6c54fc3e38abddef'
ERROR - 2023-06-06 16:40:15 --> Query error: Table 'crj_db.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = 'c02aceb2698ec99c750e8ca2ed1d5ed3f847d265'
ERROR - 2023-06-06 16:40:15 --> Query error: Table 'crj_db.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = '0132414869075a8ba7fcaaf1f816a253cee535e9'
ERROR - 2023-06-06 16:40:16 --> Query error: Table 'crj_db.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = 'eb17e188bc19e0f3b19187a476fe3de6d43c4c9f'
ERROR - 2023-06-06 16:40:16 --> Query error: Table 'crj_db.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = 'fda757acb746e3e1e2f39866396ee8bdfb264cdf'
ERROR - 2023-06-06 16:40:16 --> Query error: Table 'crj_db.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = '3e165ddfeff0a02554501413ff085315912b83e5'
ERROR - 2023-06-06 16:40:17 --> Query error: Table 'crj_db.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = '8ef48285ecac23759d1b1396856c4da6801fede3'
ERROR - 2023-06-06 16:40:54 --> Query error: Table 'crj_db.identitas' doesn't exist - Invalid query: SELECT *
FROM `identitas`
WHERE `identitas`.`ididentitas` = 1
ERROR - 2023-06-06 16:41:45 --> 404 Page Not Found: /index
ERROR - 2023-06-06 16:41:45 --> 404 Page Not Found: /index
ERROR - 2023-06-06 16:41:53 --> Query error: Table 'crj_db.group_permissions' doesn't exist - Invalid query: SELECT `permissions`.`id_permission`
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
JOIN `group_permissions` ON `user_groups`.`id_group` = `group_permissions`.`id_group`
JOIN `permissions` ON `group_permissions`.`id_permission` = `permissions`.`id_permission`
WHERE `users`.`id_user` = '1'
ERROR - 2023-06-06 16:43:10 --> Query error: Table 'crj_db.menus' doesn't exist - Invalid query: SELECT `t1`.*
FROM `menus` as `t1`
LEFT JOIN `menus` as `t2` ON `t1`.`id` = `t2`.`parent_id`
WHERE `t1`.`parent_id` =0
AND `t1`.`group_menu` = 1
AND `t1`.`status` = 1
GROUP BY `t1`.`id`
ORDER BY `t1`.`order` ASC
ERROR - 2023-06-06 16:43:11 --> Query error: Table 'crj_db.menus' doesn't exist - Invalid query: SELECT `t1`.*
FROM `menus` as `t1`
LEFT JOIN `menus` as `t2` ON `t1`.`id` = `t2`.`parent_id`
WHERE `t1`.`parent_id` =0
AND `t1`.`group_menu` = 1
AND `t1`.`status` = 1
GROUP BY `t1`.`id`
ORDER BY `t1`.`order` ASC
ERROR - 2023-06-06 16:43:11 --> Query error: Table 'crj_db.menus' doesn't exist - Invalid query: SELECT `t1`.*
FROM `menus` as `t1`
LEFT JOIN `menus` as `t2` ON `t1`.`id` = `t2`.`parent_id`
WHERE `t1`.`parent_id` =0
AND `t1`.`group_menu` = 1
AND `t1`.`status` = 1
GROUP BY `t1`.`id`
ORDER BY `t1`.`order` ASC
ERROR - 2023-06-06 16:48:54 --> Query error: Table 'crj_db.department_center' doesn't exist - Invalid query: SELECT `a`.*, `b`.`cost_center` as `cost_center`
FROM `ms_karyawan` `a`
JOIN `department_center` `b` ON `b`.`id`=`a`.`divisi`
WHERE `deleted` = '0'
ERROR - 2023-06-06 16:49:02 --> Severity: error --> Exception: Unable to locate the model you have specified: Crud_model F:\SENTRAL\CRJ\crj-project\system\core\Loader.php 344
ERROR - 2023-06-06 16:49:06 --> 404 Page Not Found: /index
ERROR - 2023-06-06 16:49:10 --> Query error: Table 'crj_db.master_customers' doesn't exist - Invalid query: SELECT `a`.*, `d`.`nama_karyawan`
FROM `master_customers` `a`
LEFT JOIN `ms_karyawan` `d` ON `d`.`id_karyawan`=`a`.`id_karyawan`
WHERE `a`.`deleted` = '0'
ERROR - 2023-06-06 16:50:28 --> Query error: Table 'crj_db.master_customers' doesn't exist - Invalid query: SELECT `a`.*, `d`.`nama_karyawan`
FROM `master_customers` `a`
LEFT JOIN `ms_karyawan` `d` ON `d`.`id_karyawan`=`a`.`id_karyawan`
WHERE `a`.`deleted` = '0'
ERROR - 2023-06-06 16:50:33 --> Severity: error --> Exception: Unable to locate the model you have specified: Cabang_model F:\SENTRAL\CRJ\crj-project\system\core\Loader.php 344
ERROR - 2023-06-06 16:50:37 --> Severity: Notice --> Undefined variable: datgroupmenu F:\SENTRAL\CRJ\crj-project\application\modules\menus\views\menus_form.php 70
ERROR - 2023-06-06 16:50:45 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:05:52 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:05:52 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:05:52 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:05:53 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:05:53 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:05:53 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:05:53 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:05:54 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:53 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:53 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:53 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:53 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:53 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:53 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:54 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:54 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:56 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:56 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:56 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:56 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:56 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:56 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:56 --> 404 Page Not Found: /index
ERROR - 2023-06-06 17:16:56 --> 404 Page Not Found: /index
