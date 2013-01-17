CREATE TABLE IF NOT EXISTS ost_comments (
  co_pk bigint(20) NOT NULL AUTO_INCREMENT,
  co_i_fk bigint(20) NOT NULL,
  co_u_fk bigint(20) NOT NULL,
  co_date datetime NOT NULL,
  co_comment varchar(1000) NOT NULL,
  PRIMARY KEY (co_pk)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS ost_follow (
  f_pk bigint(20) NOT NULL AUTO_INCREMENT,
  f_me_u_fk bigint(20) NOT NULL,
  f_follow_u_fk int(11) NOT NULL,
  f_date datetime NOT NULL,
  f_confirmed datetime NOT NULL,
  PRIMARY KEY (f_pk)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS ost_groups (
  g_pk bigint(20) NOT NULL AUTO_INCREMENT,
  g_name varchar(50) NOT NULL,
  g_u_fk bigint(20) NOT NULL,
  PRIMARY KEY (g_pk)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS ost_images (
  i_pk bigint(20) NOT NULL AUTO_INCREMENT,
  i_u_fk bigint(20) NOT NULL,
  i_key vharchar(50) NOT NULL,
  i_date datetime NOT NULL,
  i_file varchar(255) NOT NULL,
  i_public tinyint(4) NOT NULL,
  i_title varchar(255) NOT NULL,
  i_g_fk bigint(20) NOT NULL,
  i_lat double NOT NULL,
  i_lng double NOT NULL,
  i_location varchar(255) NOT NULL,
  i_star tinyint(4) NOT NULL,
  PRIMARY KEY (i_pk)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS ost_settings (
  s_pk bigint(20) NOT NULL AUTO_INCREMENT,
  s_subtitle varchar(255) NOT NULL,
  s_allowregistration tinyint(4) NOT NULL,
  s_allowfriendsstreams tinyint(4) NOT NULL,
  s_welcometext text NOT NULL,
  s_title varchar(50) NOT NULL,
  PRIMARY KEY (s_pk)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS ost_user (
  u_pk bigint(20) NOT NULL AUTO_INCREMENT,
  u_email varchar(255) NOT NULL,
  u_password varchar(255) NOT NULL,
  u_registered datetime NOT NULL,
  u_confirmed datetime NOT NULL,
  u_nickname varchar(255) NOT NULL,
  u_country varchar(255) NOT NULL,
  u_city varchar(255) NOT NULL,
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

