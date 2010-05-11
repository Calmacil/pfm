<?php

	class WebAdmin {

		private static $basedir = "./modules/";

		public static function createModule($params) {

			$module_name = $params[1];
			$default_controller = "default";

			if (isset($params[2]))
				$default_controller = $params[2];

			$ret = "";

			$ret .= WebAdmin::createDir($module_name);
			$ret .= WebAdmin::createDir($module_name . "/templates");
			$ret .= WebAdmin::createDir($module_name . "/controllers");
			$ret .= WebAdmin::createDir($module_name . "/areas");
			$ret .= WebAdmin::createDir($module_name . "/includes");
			$ret .= WebAdmin::createDir($module_name . "/includes/images");
			$ret .= WebAdmin::createDir($module_name . "/includes/js");
			$ret .= WebAdmin::createDir($module_name . "/includes/css");


			$ret .= "\nCréation du module '" . $module_name . "' terminée.\n";

			return $ret;

		}

		public static function createController($module, $controller) {

			$filename = WebAdmin::$basedir . $module . "/controllers/" . $controller . ".php";

			$file = fopen($filename, "a+");

			fputs($file, "<?php");
			fputs($file, "\n");
			fputs($file, "\tclass " . $controller . "Ctrl extends PwController {");
			fputs($file, "\n");
			fputs($file, "\n");
			fputs($file, "\n");
			fputs($file, "\n");
			fputs($file, "\n");
			fputs($file, "\t}");
			fputs($file, "\n");
			fputs($file, "?>");

			fclose($file);

			return "Création du controlleur " . $controller . " dans le module " . $module . "\n";

		}

		public static function createDir($path) {


			$s = WebAdmin::$basedir . $path;
			mkdir($s, 0777);

			return "Création du répertoire " . $path . "\n";

		}

	}

?>
