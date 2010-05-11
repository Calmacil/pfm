<?php


class groupsModel extends PwDb {

    public $fields = array('id'=>'int', 'groupname'=>'string');
    public $primary_key = array('id');
    public $table = 'pfm_groups';

    public $credentials;

    public function get($groupid = null) {
		$this->credentials = array();

		if(empty($groupid)) $groupid = $this->id;

		$cred = new credentialModel();
		$ds = $cred->rawQuery('select credential from pfm_group_credential where groupid='.$groupid);
		$rs = array();

		while ($row = mysqli_fetch_object($ds)) {
			$rs[] = $row->credential;
		}

		foreach($rs as $row) {
			$cds = $cred->get($row);
			$this->credentials[] = $cds->name;
		}

		$group = parent::get($groupid);

		$group->credentials = $this->credentials;

		return $group;
	}

}

?>
