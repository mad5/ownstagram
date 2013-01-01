CREATE TABLE IF NOT EXISTS ost_comments (
  co_pk bigint(20) NOT NULL AUTO_INCREMENT,
  co_i_fk bigint(20) NOT NULL,
  co_u_fk bigint(20) NOT NULL,
  co_date datetime NOT NULL,
  co_comment varchar(1000) NOT NULL,
  PRIMARY KEY (co_pk)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS ost_images (
  i_pk bigint(20) NOT NULL AUTO_INCREMENT,
  i_u_fk bigint(20) NOT NULL,
  i_date datetime NOT NULL,
  i_file varchar(255) NOT NULL,
  i_public tinyint(4) NOT NULL,
  i_title varchar(255) NOT NULL,
  PRIMARY KEY (i_pk)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS ost_settings (
  s_pk bigint(20) NOT NULL AUTO_INCREMENT,
  s_subtitle varchar(255) NOT NULL,
  s_allowregistration tinyint(4) NOT NULL,
  s_allowfriendsstreams tinyint(4) NOT NULL,
  s_welcometext text NOT NULL,
  PRIMARY KEY (s_pk)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS ost_user (
  u_pk bigint(20) NOT NULL AUTO_INCREMENT,
  u_email varchar(255) NOT NULL,
  u_password varchar(255) NOT NULL,
  u_registered datetime NOT NULL,
  u_confirmed datetime NOT NULL,
  PRIMARY KEY (u_pk)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS ost_views (
  v_pk bigint(20) NOT NULL AUTO_INCREMENT,
  v_u_fk bigint(20) NOT NULL,
  v_i_fk bigint(20) NOT NULL,
  v_date datetime NOT NULL,
  PRIMARY KEY (v_pk),
  KEY v_u_fk (v_u_fk,v_i_fk)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

