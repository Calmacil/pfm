<?php
/**
*	Gestion des erreurs
*	@author Thomas Lenoël
*	@version 0.2
*	@package libs
*
*/

	/**
	*	Classe chargée de l'affichage des erreurs
	*	@package libs
	*/
	class PwError extends ErrorException{
	
		public function __construct($message, $code = 0) {
			parent::__construct($message, $code);
		}

		/**
		*	Affiche l'erreur générée de manière 'human-friendly'
		*/
		public function say() {
		
			echo '<div style="background-color: #f88; border: solid red 2px;">
	<strong>Erreur !</strong><br />
	<em>Fichier: ' . $this->getFile() . ' à la ligne ' . $this->getLine() . '</em>
	<br />' . $this->getMessage . '</div>';
		
		}
	
	}

	/**
	*	Fonction pour lacher une exception
	*	@param string $m Le message de l'exception
	* 	@param int $c Le code de l'exception
	*
	*	Exemple d'utilisation:
	*	<code>
	*	mysql_query($sql) or throwException("Impossible d'exécuter la requête", 17);
	*	</code>
	*/
	function throwException($m = null, $c = 0) {
		throw new PwError($m, $c);
	}


?>
