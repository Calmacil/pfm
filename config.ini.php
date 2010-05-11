<?php
/**
 *	Fichier de configuration
 *
 *	@author Thomas LENOEL
 *	@version 0.8
 *	@package app
 */

	/**
	 *	Classe de configuration
	 *	On accède directement aux variables par leur noms
	 *
	 *	@package app
	 */
	class AppConfig {

		// page par défaut de l'application
		public $default_module = 'default';
		public $default_controller = 'default';
		public $default_action = 'index';

		// nom de l'application - chemin d'accès dans Apache !!
		public $app_name = 'PFM';

		// doctype par défaut des vues
		public $default_doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';

		public $active_plugins = array('db', 'auth', 'cli');
		// si mis a false, ce sont les GETS qui écrasent les POSTS
		public $ct_posts_overrides_gets = true;

		// paramètres de la db
		public $db_login = 'pfm';
		public $db_server = 'localhost';
		public $db_name = 'pfm';
		public $db_password = 'pfm';
		public $db_debug = false;

		// plugin auth
		public $auth_pwd_coding = 'md5';
		public $auth_action_success = 'default/default/login';
		public $auth_action_error = 'default/default/error';
		public $auth_action_logout = 'default/default/logout';

		// plugin cli
		public $cli_modulename = 'webcli';

		// modèles que l'appli doit charger
		public $db_models = array();


	}
?>
