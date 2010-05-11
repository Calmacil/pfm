<?php
/**
 *	Contrôleur principal
 *
 *	Procède à l'inclusion des autres librairies
 *
 *	@author Thomas Lenoël
 *	@version 1.0
 *	@package libs
 */

	session_start();

	/**
	*/
	require_once('config.ini.php');
	require_once('PwError.class.php');
	require_once('PwController.class.php');
	require_once('PwView.class.php');
	require_once('PwArea.class.php');
	require_once('PwForm.class.php');
	require_once('Global.class.php');

	$GLOBALS['glob'] = new PwGlobal();
	$GLOBALS['conf'] = new AppConfig();

	if (in_array('db', $GLOBALS['conf']->active_plugins)) {
		require_once('plugins/db/PwDb.class.php');
		if (in_array('auth', $GLOBALS['conf']->active_plugins)) {
			require_once('plugins/auth/PwUser.class.php');
			require_once('plugins/auth/PwGroup.class.php');
			PwUser::init();
		}
	}
	if (in_array('pdf', $GLOBALS['conf']->active_plugins)) require_once('plugins/fpdf/fpdf.php');
	if (in_array('cli', $GLOBALS['conf']->active_plugins)) require_once('plugins/cli/WebAdmin.class.php');


	foreach($GLOBALS['conf']->db_models as $file) require_once('./model/'.$file.'Model.php');

	/**
	*	Contrôleur principal de l'application
	*
	*	Valide la pseudo-url.<br />
	*	Instancie le contrôleur approprié du module approprié et exécute l'action demandée
	*
	*	@package libs
	*/
	class MainController {

		/**
		*	Module appelé par la pseudo-url
		*	@var String
		*/
		private $MC_MODULE;

		/**
		*	Contrôleur appelé par la pseudo-url
		*	@var String
		*/
		private $MC_CONTROLLER;

		/**
		*	Action exécutée par le contrôleur
		*	@var String
		*/
		private $MC_ACTION;

		/**
		*	Préfixe des URLS
		*	@var String
		*/
		private $MC_BASEURL = '.';

		/**
		*	Constructeur du MC
		*
		*	Les contrôles de validité de la pseudo-url sont effectués ici.<br/>
		*	Si la pseudo-url est absente ou incomplète on charge les valeurs par défaut.
		*/
		public function __construct() {
			try {
				$actionCommand = explode('index.php', $_SERVER['REQUEST_URI']);
				if (isset($actionCommand[0])) $GLOBALS['GLOB']->BASEURL = "http://".$_SERVER['SERVER_NAME']."/".$GLOBALS['conf']->app_name;
				if (isset($actionCommand[1])) {
					$uri = explode('/', $actionCommand[1]);

					if (isset($uri[1])) $this->MC_MODULE = $uri[1];
					if (isset($uri[2])) $this->MC_CONTROLLER = $uri[2];
					if (isset($uri[3])) $this->MC_ACTION = $uri[3];
				}
				// chargement des valeurs par défaut
				if (empty($this->MC_ACTION)) $this->MC_ACTION = $GLOBALS['conf']->default_action;
				if (empty($this->MC_CONTROLLER)) $this->MC_CONTROLLER = $GLOBALS['conf']->default_controller;
				if (empty($this->MC_MODULE)) $this->MC_MODULE = $GLOBALS['conf']->default_module;

				$this->selectController();

			} catch ( PwError $e ) {
				$e->say();
			}

		}

		/**
		*	Sélecteur de script
		*
		*	Appelle et exécute le triplet module/controleur/action chargé dans le constructeur
		*/
		private function selectController() {
			try {

				require_once('./libs/PwController.class.php');


				if (in_array('cli', $GLOBALS['conf']->active_plugins) && $this->MC_MODULE == $GLOBALS['conf']->cli_modulename)
					require_once($this->MC_BASEURL . '/libs/plugins/cli/controllers/default.php');
				else
					require_once($this->MC_BASEURL . '/modules/' . $this->MC_MODULE . '/controllers/' . $this->MC_CONTROLLER . '.php');

				$ctrlCaller = $this->MC_CONTROLLER . 'Ctrl';
				$actCaller = $this->MC_ACTION;
				$ctrl = new $ctrlCaller(new PwView($GLOBALS['conf'], $this->MC_MODULE));
				$ctrl->$actCaller();

			} catch (PwError $e) {
				$e->say;
			}
		}

	}

?>
