<?php
$UPDATE_SQL = array();
/*
$UPDATE_SQL[0] = array('type' => 'newfield', 'table' => 'co_groups', 'field' => 'cg_closed', 'query' => 'ALTER TABLE  `co_groups` ADD  `cg_closed` TINYINT NOT NULL');
$UPDATE_SQL[2] = array('type' => 'newtable', 'table' => 'co_groups_apps', 'query' => 'CREATE TABLE `co_groups_apps` (`ga_pk` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,`ga_cg_fk` BIGINT NOT NULL ,`ga_ca_fk` BIGINT NOT NULL) ENGINE = MYISAM');
$UPDATE_SQL[21] = array('type' => 'newentry', 'countquery' => "SELECT count(*) FROM co_apps WHERE ca_id='zuweisen'", 'query'=>"INSERT INTO `co_apps` (`ca_fe_fk`, `ca_id`, `ca_title`, `ca_url`, `ca_url_groupapp`, `ca_publisher_url`, `ca_head`, `ca_type`, `ca_key`, `ca_info`, `ca_masterapp`) VALUES ( 1, 'zuweisen', 'Zuweisen', 'apps/app.zuweisen.php?action=anzeigealle', 'apps/app.zuweisen.php?action=anzeigegruppe', 'apps/app.zuweisen.php?action=zuweisen', '', 'display', '02fba780f8d1d6f8ec1ff76027d88d5e', 'Einen Artikel einer oder mehreren Personen zuweisen.', 0);");
$UPDATE_SQL[22] = array('type' => 'alter', 'query' => "ALTER TABLE `fe_user` CHANGE `fe_type` `fe_type` ENUM( 'user', 'app', 'group', 'cron' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'user'");

callAfter um nach SQL noch eine Funktion aufzurufen


 */

$UPDATE_SQL[0] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_welcometext', 'query' => 'ALTER TABLE `ost_settings` ADD `s_welcometext` TEXT NOT NULL ');
$UPDATE_SQL[1] = array('type' => 'newtable', 'table' => 'ost_views', 'query' => 'CREATE TABLE IF NOT EXISTS `ost_views` (  `v_pk` bigint(20) NOT NULL AUTO_INCREMENT, `v_u_fk` bigint(20) NOT NULL,  `v_i_fk` bigint(20) NOT NULL, `v_date` datetime NOT NULL,   PRIMARY KEY (`v_pk`),  KEY `v_u_fk` (`v_u_fk`,`v_i_fk`) ) ENGINE=InnoDB ');
$UPDATE_SQL[2] = array('type' => 'newfield', 'table' => 'ost_settings', 'field' => 's_title', 'query' => 'ALTER TABLE `ost_settings` ADD `s_title` VARCHAR(50) NOT NULL ');
$UPDATE_SQL[3] = array('type' => 'newtable', 'table' => 'ost_groups', 'query' => 'CREATE TABLE IF NOT EXISTS ost_groups ( `g_pk` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `g_name` VARCHAR( 50 ) NOT NULL , `g_u_fk` BIGINT NOT NULL ) ENGINE = InnoDB');
$UPDATE_SQL[4] = array('type' => 'newfield', 'table' => 'ost_images', 'field' => 'i_g_fk', 'query' => 'ALTER TABLE `ost_images` ADD `i_g_fk` bigint(20) NOT NULL ');

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


