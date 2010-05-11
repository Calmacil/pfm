<script language="javascript">
	<!--
function toggle(id) {

	var menuid = document.getElementById(id);
	if (menuid.style.display == 'none') menuid.style.display = 'block';
	else menuid.style.display = 'none';

}	
	-->
</script>

<div id="banniere">
	Une bannière
</div>
<div id="menu">
	<ul>
		<li>
			<?php $this->form('LOOKUP');?>
		</li>
		<br /><br />
		<li>
			<!--<a href="./index.php/authentification/default/accueil">Accueil</a>-->
			<?php $this->url('Accueil');?>
		</li>
		<li>
			<?php $this->url('Disco');?>
		</li>
		<li>
			<a id="mcli" href="javascript:toggle('smcli')">Prospects</a>
			<div id="smcli" class="smen" style="display: none">
				<?php
					$this->url('proslist');
					$this->url('newpros');
				?>
				<a>Liste des contacts</a>
				<?php $this->url('newcontact'); ?>
			</div>
		</li>
		<li>
			<a id="mop" href="">Opportunités</a>
		</li>
	</ul>
</div>

<div id="corps">
	<?php $this->area('CORPS');?>
</div>
<div id="footer">
	Site cr&eacute;&eacute; par Thomas Leno&euml;l et Mathieu Themelin<br />
	&copy;2009
</div>