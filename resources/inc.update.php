<?php
$UPDATE_SQL = array();
/*
callAfter um nach SQL noch eine Funktion aufzurufen
*/

$UPDATE_SQL[0] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_welcometext', 'query' => 'ALTER TABLE `ost_settings` ADD `s_welcometext` TEXT NOT NULL ');
$UPDATE_SQL[1] = array('type' => 'newtable', 'table' => 'ost_views', 'query' => 'CREATE TABLE IF NOT EXISTS `ost_views` (  `v_pk` bigint(20) NOT NULL AUTO_INCREMENT, `v_u_fk` bigint(20) NOT NULL,  `v_i_fk` bigint(20) NOT NULL, `v_date` datetime NOT NULL,   PRIMARY KEY (`v_pk`),  KEY `v_u_fk` (`v_u_fk`,`v_i_fk`) ) ENGINE=InnoDB ');
$UPDATE_SQL[2] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_title', 'query' => 'ALTER TABLE `ost_settings` ADD `s_title` VARCHAR(50) NOT NULL ');
$UPDATE_SQL[3] = array('type' => 'newtable', 'table' => 'ost_groups', 'query' => 'CREATE TABLE IF NOT EXISTS ost_groups ( `g_pk` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `g_name` VARCHAR( 50 ) NOT NULL , `g_u_fk` BIGINT NOT NULL ) ENGINE = InnoDB');
$UPDATE_SQL[4] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_g_fk', 'query' => 'ALTER TABLE `ost_images` ADD `i_g_fk` bigint(20) NOT NULL ');
$UPDATE_SQL[5] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_lat', 'query' => 'ALTER TABLE `ost_images` ADD `i_lat` double NOT NULL ');
$UPDATE_SQL[6] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_lng', 'query' => 'ALTER TABLE `ost_images` ADD `i_lng` double NOT NULL ');
$UPDATE_SQL[7] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_location', 'query' => 'ALTER TABLE `ost_images` ADD `i_location` varchar(255) NOT NULL ');
$UPDATE_SQL[8] = array('type' => 'newfield', 'table' => 'ost_user', 'field' => 'u_nickname', 'query' => 'ALTER TABLE `ost_user` ADD `u_nickname` varchar(255) NOT NULL ');
$UPDATE_SQL[9] = array('type' => 'newfield', 'table' => 'ost_user', 'field' => 'u_country', 'query' => 'ALTER TABLE `ost_user` ADD `u_country` varchar(255) NOT NULL ');
$UPDATE_SQL[10] = array('type' => 'newfield', 'table' => 'ost_user', 'field' => 'u_city', 'query' => 'ALTER TABLE `ost_user` ADD `u_city` varchar(255) NOT NULL ');
$UPDATE_SQL[11] = array('type' => 'newtable', 'table' => 'ost_groups', 'query' => 'CREATE TABLE ost_follow ( `f_pk` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `f_me_u_fk` BIGINT NOT NULL , `f_follow_u_fk` INT NOT NULL , `f_date` DATETIME NOT NULL , `f_confirmed` DATETIME NOT NULL ) ENGINE = InnoDB ');
$UPDATE_SQL[12] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_star', 'query' => 'ALTER TABLE `ost_images` ADD `i_star` tinyint NOT NULL ');
$UPDATE_SQL[13] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_key', 'query' => array("ALTER TABLE `ost_images` ADD `i_key` varchar(50) NOT NULL", "UPDATE ost_images SET i_key=md5(concat(i_file,i_pk,i_date)) WHERE i_key='' "));
$UPDATE_SQL[14] = array('type' => 'newfield', 'table' => 'ost_user', 'field' => 'u_remoteserver', 'query' => 'ALTER TABLE `ost_user` ADD `u_remoteserver` varchar(255) NOT NULL ');
$UPDATE_SQL[15] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_instance', 'query' => array('ALTER TABLE `ost_settings` ADD `s_instance` varchar(255) NOT NULL ', "UPDATE ost_settings SET s_instance=md5('".$_SERVER['HTTP_HOST'].microtime(true)."')"));
$UPDATE_SQL[16] = array('type' => 'newtable', 'table' => 'ost_remotes', 'query' => 'CREATE TABLE ost_remotes (`r_pk` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `r_u_fk` BIGINT NOT NULL , `r_server` VARCHAR(255) NOT NULL ) ENGINE = InnoDB');
$UPDATE_SQL[17] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_rotation', 'query' => 'ALTER TABLE `ost_images` ADD `i_rotation` tinyint NOT NULL ');
$UPDATE_SQL[18] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_imprint', 'query' => array('ALTER TABLE `ost_settings` ADD `s_imprint` TEXT NOT NULL '));
$UPDATE_SQL[19] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_privacy', 'query' => array('ALTER TABLE `ost_settings` ADD `s_privacy` TEXT NOT NULL '));
$UPDATE_SQL[20] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_osm', 'query' => array('ALTER TABLE `ost_settings` ADD `s_osm` TINYINT NOT NULL DEFAULT 1'));
$UPDATE_SQL[21] = array('type' => 'newtable', 'table' => 'ost_sets', 'query' => 'CREATE TABLE `ost_sets` ( `se_pk` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `se_u_fk` BIGINT NOT NULL , `se_date` DATETIME NOT NULL , `se_name` VARCHAR( 50 ) NOT NULL ) ENGINE = InnoDB');
$UPDATE_SQL[22] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_set', 'query' => 'ALTER TABLE `ost_images` ADD `i_set` bigint(20) NOT NULL ');
$UPDATE_SQL[23] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_homecontent', 'query' => array('ALTER TABLE `ost_settings` ADD `s_homecontent` TINYINT NOT NULL DEFAULT 1 '));
$UPDATE_SQL[24] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_style', 'query' => array('ALTER TABLE `ost_settings` ADD `s_style` varchar(255) NOT NULL '));
$UPDATE_SQL[25] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_square', 'query' => 'ALTER TABLE `ost_images` ADD `i_square` TINYINT NOT NULL DEFAULT 1 ');
$UPDATE_SQL[26] = array('type' => 'newtable', 'table' => 'ost_emailin', 'query' => 'CREATE TABLE `ost_emailin` (`ei_pk` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,`ei_u_fk` BIGINT NOT NULL ,`ei_email` VARCHAR( 255 ) NOT NULL ,`ei_key` VARCHAR( 255 ) NOT NULL) ENGINE = InnoDB');
$UPDATE_SQL[27] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_global', 'query' => array('ALTER TABLE `ost_settings` ADD `s_global` TINYINT NOT NULL DEFAULT 0 ','ALTER TABLE `ost_settings` ADD `s_global_lastcheck` DATETIME NOT NULL '));
$UPDATE_SQL[28] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_watermark', 'query' => array('ALTER TABLE `ost_settings` ADD `s_watermark` varchar(50) NOT NULL '));
$UPDATE_SQL[29] = array('type' => 'newtable', 'table' => 'ost_global', 'query' => 'CREATE TABLE `ost_global` (`gl_pk` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,`gl_changed` DATETIME NOT NULL ,`gl_host` VARCHAR( 255 ) NOT NULL) ENGINE = InnoDB');
$UPDATE_SQL[30] = array('type' => 'newfield', 'table' => 'ost_global', 'field' => 'gl_last_checked', 'query' => array('ALTER TABLE `ost_global` ADD `gl_last_checked` datetime NOT NULL '));
$UPDATE_SQL[31] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_changed', 'query' => array('ALTER TABLE `ost_images` ADD `i_changed` DATETIME NOT NULL AFTER `i_u_fk`', 'UPDATE ost_images SET i_changed=i_date'));
$UPDATE_SQL[32] = array('type' => 'newtable', 'table' => 'ost_global_images', 'query' => 'CREATE TABLE `ost_global_images` (`gi_pk` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,`gi_gl_fk` BIGINT NOT NULL ,`gi_changed` DATETIME NOT NULL ,`gi_date` DATETIME NOT NULL ,`gi_title` VARCHAR( 255 ) NOT NULL ,`gi_location` VARCHAR( 255 ) NOT NULL ,`gi_lat` DOUBLE NOT NULL ,`gi_lng` DOUBLE NOT NULL ,`gi_id` VARCHAR( 255 ) NOT NULL ,`gi_imgid` VARCHAR( 255 ) NOT NULL) ENGINE = InnoDB');
$UPDATE_SQL[33] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_views', 'query' => array('ALTER TABLE `ost_images` ADD `i_views` bigint(20) NOT NULL'));
$UPDATE_SQL[34] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_created', 'query' => array('ALTER TABLE `ost_images` ADD `i_created` DATETIME NOT NULL AFTER `i_u_fk`', 'UPDATE ost_images SET i_created=i_date', 'ALTER TABLE `ost_images` CHANGE `i_date` `i_date` DATE NOT NULL '));
$UPDATE_SQL[35] = array('type' => 'alter', 'query' => array("TRUNCATE TABLE ost_global_images", "UPDATE ost_global SET gl_last_checked='0000-00-00 00:00:00' "));

$STEP = -1;
if(file_exists($update_fn.'.count')) $STEP = file_get_contents($update_fn.'.count');

for($i=0;$i<count($UPDATE_SQL);$i++) {
	// {{{
	
	if(!is_array($UPDATE_SQL[$i]['query'])) $UPDATE_SQL[$i]['query'] = array($UPDATE_SQL[$i]['query']);
	
	if($i<=$STEP) continue;
	
	if($UPDATE_SQL[$i]['type']=='newfield') {
		// {{{
		if(!$own->DC->fieldExists($UPDATE_SQL[$i]['table'], $UPDATE_SQL[$i]['field'])) {
			for($j=0;$j<count($UPDATE_SQL[$i]['query']);$j++) {
				$own->DC->sendQuery($UPDATE_SQL[$i]['query'][$j]);
			}
			file_put_contents($update_fn,date("Y-m-d H:i:s")."\t"."UPDATE-SQL-STEP ".$i, FILE_APPEND);
		}
		file_put_contents($update_fn.'.count', $i);
		// }}}
	}
	
	if($UPDATE_SQL[$i]['type']=='newtable') {
		// {{{
		if(!$own->DC->tableExists($UPDATE_SQL[$i]['table'])) {
			for($j=0;$j<count($UPDATE_SQL[$i]['query']);$j++) {
				$own->DC->sendQuery($UPDATE_SQL[$i]['query'][$j]);
			}
			file_put_contents($update_fn,date("Y-m-d H:i:s")."\t". "UPDATE-SQL-STEP ".$i, FILE_APPEND);
		}
		file_put_contents($update_fn.'.count', $i);
		// }}}
	}
	
	if($UPDATE_SQL[$i]['type']=='newentry') {
		// {{{
		if($own->DC->countByQuery($UPDATE_SQL[$i]['countquery'])==0) {
			for($j=0;$j<count($UPDATE_SQL[$i]['query']);$j++) {
				$own->DC->sendQuery($UPDATE_SQL[$i]['query'][$j]);
			}
		}
		file_put_contents($update_fn.'.count', $i);
		// }}}
	}
	if($UPDATE_SQL[$i]['type']=='alter') {
		// {{{
		for($j=0;$j<count($UPDATE_SQL[$i]['query']);$j++) {
			$own->DC->sendQuery($UPDATE_SQL[$i]['query'][$j]);
		}
		file_put_contents($update_fn.'.count', $i);
		// }}}
	}
		
        if(isset($UPDATE_SQL[$i]['callAfter']) && $UPDATE_SQL[$i]['callAfter']!="") {
            $UPDATE_SQL[$i]['callAfter']();
        }
        
	// }}}
}


