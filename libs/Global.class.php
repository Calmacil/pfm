<?php
/**
*	Fichier de globales
*
*	@author Thomas Lenoël
*	@version 0.1
*	@package app
*/

	/**
	* Classe fourre-tout
	* Ces variables sont accessibles de toute l'application
	*
	* @package app
	*/
	class PwGlobal {

		/**
		* 	Url de base.
		*
		*	Sert pour l'inclusion de fichiers externes (CSS, javascript)
		*	@var String
		*/
		public $BASEURL = '.';
		
		/**
		 * 	Variable de sessions
		 * @var mixed[]
		 */
		public $sessions = array();
		
		/**
		 * 	Variable de get ET posts
		 * 
		 * 	Les posts écrivent par dessus les gets par défaut
		 * 	@var mixed[]
		 */
		public $params = array();
	}
?>