<?php

class usersModel extends PwDb {

    public $fields = array("id"=>"int", "login"=>"string", "password"=>"string", "regdate"=>"date");
    public $primary_key = array("id");
    public $table = "pfm_users";

    public $groups = array();

    public function get($userid = null) {

		if(empty($userid)) $userid = $this->id;

		$grm = new groupsModel();

		$sql = 'SELECT groupid FROM pfmuser_group WHERE userid='.$userid;

		if ($GLOBALS['conf']->db_debug) print $sql . '<br />';
		$ds = $grm->rawQuery($sql);

		$resp = array();

		while($row = mysqli_fetch_object($ds)) $resp[] = $this->groups[] = $grm->get($row->groupid);

		$user = parent::get($userid);
		$user->groups = $this->groups;

		return $user;

	}

}

?>
