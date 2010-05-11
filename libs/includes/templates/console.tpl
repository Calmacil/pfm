<?php

	$url = 'http://'.$_SERVER['SERVER_NAME'].'/'.$GLOBALS['conf']->app_name.'/index.php/webcli/default/listener';

?>
<style type="text/css">

body { margin: 0px; }
#terminal_container { height: 100%; width: 100%; }

</style>

<div id="terminal_container"></div>

<script language="javascript">
	$('#terminal_container').height($(document).height());
	$('#terminal_container').terminal(<?php echo "'".$url."'"; ?>, {custom_prompt : "PFM&gt; ", hello_message : 'PFM WebCli Administration Tool'});
</script>

