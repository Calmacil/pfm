<?php

	require_once('usersModel.php');
	require_once('groupsModel.php');
	require_once('credentialModel.php');

	class PwUser {

		public static $pwd_coding = "";
		public $user;

		// chaines module/ctrl/action
		public static $action_success;
		public static $action_error;
		public static $action_logout;

		public static function init() {
			PwUser::$pwd_coding = $GLOBALS['conf']->auth_pwd_coding;
			PwUser::$action_success = $GLOBALS['conf']->auth_action_success;
			PwUser::$action_error = $GLOBALS['conf']->auth_action_error;
			PwUser::$action_logout = $GLOBALS['conf']->auth_action_logout;

		}

		public static function auth($login, $password) {

			$db = new PwDb();
			$rs = $db->rawQuery("select id, password from users where login='".$login."'");
			$rs = mysqli_fetch_object($rs);

			$coding = PwUser::$pwd_coding;
			print $coding;

			if (!empty($coding))
				$password = $coding($password);

			if($rs->password == $password)
				return $rs->id;
			return false;

		}

		public static function login($login, $password) {

			$uid = $this->auth($login, $password);

			if ($uid) {
				$this->user = new usersModel();
				$rs = $this->user->get($uid);

				print $this->user->id;

				$_SESSION['USER_ID'] = $rs->id;
				$_SESSION['USER_LOGIN'] = $rs->login;
				$_SESSION['USER_REGDATE'] = $rs->regdate;
				$_SESSION['USER_GROUPS'] = $rs->groups;

				PwController::redirect($this->action_success);

			} else {
				PwController::redirect($this->action_error);
			}

		}

		public static function logout() {
			session_destroy();
			PwController::redirect($this->action_logout);
		}



		public static function hasCredential($credential, $subject = null) {

			if (!empty($_SESSION['USER_GROUPS'])) {

				$groups = $_SESSION['USER_GROUPS'];

				foreach($groups as $group) {

					if (in_array($credential, $group->credentials)) {
						 return true;
						 print "pas bien";
					}

				}
			}
			return false;
		}

		public static function add($login, $password) {

			$coding = PwUser::pwd_coding;

			if (!empty($coding))
				$password = $coding($password);

			$um = new usersModel();
			$um->login = $login;
			$um->password = $password;
			$um->regdate = date('Y-m-d');

			return $um->insert();

		}


		public static function remove($uid) {
			$um = new usersModel();
			$um->delete($uid);
		}

	}

?>
