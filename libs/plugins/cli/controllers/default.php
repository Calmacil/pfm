<?php


	class defaultCtrl extends PwController {


		private function common() {
			$vue = $this->getView();
			$vue->setTemplate('~console');
			$vue->setTitle('PFM WebCli Administration Tool');
			$vue->jQuery();
			$vue->jQueryTerminal();
			return $vue;
		}

		public function index() {

			$vue = $this->common();



			$vue->render();

		}


		public function listener() {

			$params = explode(' ', $this->params('input'));

			$retour = "";

			switch($params[0]) {

				case 'help':
					$retour = "Afficher l'aide";
					break;
				case 'createmodule':
					$retour = WebAdmin::createModule($params);
					break;
				case 'createctrl':
					$retour = WebAdmin::createController($params[1], $params[2]);
					break;

				default:
					$retour = "Afficher l'aide";
			}

			print $retour . "\n";

		}

	}

?>
