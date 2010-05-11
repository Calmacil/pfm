<?php
/**
*	Fichier de def des contrôleurs
*
*	@author Thomas Lenoël
*	@version 1.0
*	@package libs
*
*/
	/**
	*	Contrôleur générique
	*
	*	Format des contrôleurs: fichier modules/monModule/controllers/MonControlleur.php
	*	<code>
	*		class MonControleurCtrl extends PwController {
	*
	*			public function monAction() {
	*				// code de l'action
	*			}
	*
	*		}
	*	</code>
	*	@package libs
	*/
	class PwController {

		/**
		*	La vue associée au controleur
		*	@var string
		*/
		private $CT_VIEW;

		/**
		*	Constructeur de controleur
		*
		*	@param string: une vue
		*/
		public function __construct($view) {
			$this->CT_VIEW = $view;

			foreach ($_SESSION as $k => $v) $GLOBALS['glob']->sessions[$k] = $v;

			if ($GLOBALS['conf']->ct_posts_overrides_gets) {
				foreach ($_GET as $k => $v)	$GLOBALS['glob']->params[$k] = htmlspecialchars($v);
				foreach ($_POST as $k => $v) $GLOBALS['glob']->params[$k] = htmlspecialchars(addslashes(nl2br($v)));
			} else {
				foreach ($_POST as $k => $v) $GLOBALS['glob']->params[$k] = htmlspecialchars(addslashes(nl2br($v)));
				foreach ($_GET as $k => $v)	$GLOBALS['glob']->params[$k] = htmlspecialchars($v);
			}
		}

		/**
		*	Getter de la vue
		*
		*	Renvoie la vue associée
		*	@return $this->CT_VIEW
		*/
		public function getView() {
			return $this->CT_VIEW;
		}

		/**
		 * Fonction d'accès aux variables de sessions
		 * @param string:
		 * @return mixed:
		 */
		public function session($name) {
			if (isset( $GLOBALS['glob']->sessions[$name])) return  $GLOBALS['glob']->sessions[$name];
			return null;
		}

		public function isSession($name) {
			if (isset($GLOBALS['glob']->sessions[$name])) return true;
			else return false;
		}

		/**
		 * Fonction d'accès aux paramètres
		 * @param string:
		 * @return mixed:
		 */
		public function params($name) {
			return $GLOBALS['glob']->params[$name];
		}

		public function isParam($name) {
			if (isset($GLOBALS['glob']->params[$name])) return true;
			return false;
		}

		public static function redirect($url) {
			$nurl = 'http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['conf']->app_name.'/index.php/'.$url;
			print "<script language=\"javascript\">window.location.replace('".$nurl."');</script>";
		}

	}

?>
