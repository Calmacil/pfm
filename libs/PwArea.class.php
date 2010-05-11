<?php
/**
*	Fichier de définition des zones d'affichage
*
*	@version 1.0
*	@author Thomas Lenoël
*	@package libs
*/

	/**
	*	Zone d'affichage
	*	Correspond à une zone sur la vue appelante
	*	@package libs
	*/
	class PwArea {

		/**
		*	Nom du template associé
		*	@var String
		*/
		private $TPL;

		/**
		*	Module appelant
		*	@var String
		*/
		private $MODULE;

		/**
		*	Constructeur de la Zone
		*	@param string $mod Le module appelant
		*	@param string $tpl Le template associé
		*/
		public function __construct($mod, $tpl = null) {
			$this->MODULE = $mod;
			if (isset($tpl)) $this->setTemplate($tpl);
		}

		/**
		*	Getteur du template
		*	
		*	Retourne le template associé à la zone
		*	@return $tpl
		*/
		public function getTemplate() {
		
			$tpl = 'modules/'.$this->MODULE.'/areas/'.$this->TPL.'.tpl';
		
			return $tpl;
		}

		/**
		*	Setter du template
		*	
		*	Associe un template à la zone.<br />
		*	/!\ obligatoire si un template n'a pas été donné au constructeur.
		*	@param $tpl String = nom de template
		*/
		public function setTemplate($tpl) {
			$this->TPL = $tpl;
		}
	
	}

?>