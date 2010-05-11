<?php


class credentialModel extends PwDb {

    public $fields = array('id'=>'int', 'name'=>'string');
    public $primary_key = array('id');
    public $table = 'pfm_credential';

}

?>
