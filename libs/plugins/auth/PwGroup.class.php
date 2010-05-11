<?php

require_once('usersModel.php');
require_once('groupsModel.php');
require_once('credentialModel.php');

class PwGroup {

	public static function createGroup($groupname) {

		$g = new groupsModel();
		$g->groupname = $groupname;
		$g->insert();

	}

	public static function removeGroup($groupid) {
		$g = new groupsModel();
		$g->delete($groupid);
	}

	public static function addUser($groupid, $userid) {

		$db = new PwDb();

		$sql = "insert into pfm_user_group values(null, '" . $userid . "', '" . $groupid . "')";
		return $db->rawQuery($sql);

	}

	public static function delUser($groupid, $userid) {

		$db = new PwDb();

		$sql = "delete from pfm_user_group where userid='" . $userid . "' and groupid='" . $groupid . "'";
		return $db->rawQuery($sql);

	}
	
	public static function addCredential($groupid, $credential) {
		
		$db = new PwDb();
		
		$sql = "insert into pfm_group_credential values(null, '" . $groupid . "', '" . $credential . "')";
		return $db->rawQuery($sql);
		
	}
	
	public static function removeCredential($groupid, $credential) {
		
		$db = new PwDb();
		
		$sql = "delete from pfm_group_credential where groupid='" . $groupid . "' and credential='" . $credential . "'";
		return $db->rawQuery($sql);
		
	}

	public static function hasCredential($groupid, $cred) {

		$g = new groupsModel();
		$rs = $g->get($groupid);

		if(is_string($groupid))
			return in_array($cred, $rs->credentials);

		foreach($rs->credentials as $name) {
			$c = new credentialModel();
			$c->name = $name;
			$rc = $c->get(array('name'));

			if ($rc->id == $cred) return true;
		}
		return false;
	}


}


?>
