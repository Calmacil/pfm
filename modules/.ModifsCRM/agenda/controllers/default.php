<?php

class defaultCtrl extends PwController {
	
	public function common() {
		$vue = $this->getView();
		$vue->setTitle("Accueil Agenda");
		
		$vue->addCSSLink("Style");
		
		$vue->addMetaDescription('Projet CRM pour l\'IUT');
		$vue->addMetaAuthor("Thomas LENOEL, Mathieu THEMELIN");
		$vue->addMetaKeywords("CRM, opportunites, Prospects, agenda, calendrier");
		$vue->addMetaRating("general");
		$vue->addMetaCType("text/html; charset=utf-8");
		
		$vue->addCSSLink("Style");
		
		$vue->addUrl('Accueil', 'authentification/default/accueil');
		$vue->addUrl('Disco', 'authentification/default/disconnect', 'Se déconnecter', 'Déconnexion');
		$vue->addUrl('RDVs &agrave; venir', 'agenda/default/index', 'Accueil Agenda');
		$vue->addUrl('Nouveau RDV', 'agenda/default/nouveau', 'Nouveau RDV');
		$vue->addUrl('Vue semaine', 'agenda/default/semaine', 'Vue semaine');
		
		return $vue;
	}
	
	public function index() {
		$vue = $this->common();
		$vue->setTemplate('accueil');
		$vue->addArea("CORPS", "liste");
		
		// Recuperation Id Utilisateur
		$user = new UtilisateurModel();
		$user->login = $this->session("login");
		$select = $user->get(array('login'));
		$var = mysqli_fetch_object($select);
	
		// Recuperation Id Agenda correspondant
		$agendauser = new AgendaUtilisateurModel();
		$agendauser->utilisateur = $var->id;
		$agenda = $agendauser->get(array('utilisateur'));
	
		$contenu = mysqli_fetch_object($agenda);
	
		// Recuperation Agenda lui-meme
		$agenda = new AgendaModel();
		$agenda->id = $contenu->agenda;
		$contenu = $agenda->get(array('id'));
	
		$vue->assignVar("agenda",$contenu);
		$vue->render();
	}	
	
	public function nouveau() {
		$vue = $this->common();
		$vue->setTemplate('accueil');
		$vue->addArea('CORPS', 'newrdvform');
		
		$form = new PwForm('newrdvform', 'post', 'agenda/default/insertRDV', false);
		$form->addFieldSet('Nouveau');
		
		$form->addTextInput('new_datedebut', 'Date début :', 'AAAA-MM-DD', 'datedebut', 'tif', 'Nouveau');
		$form->addTextInput('new_datefin', 'Date fin :', 'AAAA-MM-DD', 'datefin', 'tif', 'Nouveau');
		$form->addTextInput('new_heuredebut','Heure debut :','MM:SS','heuredebut','tif','Nouveau');
		$form->addtextInput('new_heurefin','Heure fin :','MM:SS','heurefin','tif','Nouveau');
		$form->addTextInput('new_repetition', 'Repetition :', null, 'repetition', 'tif', 'Nouveau');
		$form->addTextInput('new_lieu', 'Lieu :', null, 'lieu', 'tif', 'Nouveau');
		$form->addTextInput('new_sujet', 'Sujet :', null, 'sujet', 'tif', 'Nouveau');
		$form->addTextInput('new_com', 'Commentaire :', null, 'commentaires', 'tif', 'Nouveau');
		
		$form->addSubmitInput('ok', 'ok', 'Enregistrer', 'ok', 'tif');
		
		$vue->addForm('newrdvform', $form);
		$vue->render();
	}
	
	public function insertRDV() {
		$BDagenda = new AgendaModel();
		
		// Insertion nouveau RDV
		$BDagenda->datedebut = $this->params('new_datedebut');
		$BDagenda->datefin = $this->params('new_datefin');
		$BDAgenda->heuredebut =  $this->params('new_heuredebut');
		$BDAgenda->heurefin = $this->params('new_heurefin');
		$BDagenda->repetition = $this->params('new_repetition');
		$BDagenda->lieu = $this->params('new_lieu');
		$BDagenda->sujet = $this->params('new_sujet');
		$BDagenda->commentaire = $this->params('new_com');
		$BDagenda->insert();
		
		// Recuperation de l'id insere
		$BDagenda->datedebut = $this->params('new_datedebut');
		$BDagenda->datefin = $this->params('new_datefin');
		$BDAgenda->heuredebut = $this->params('new_heuredebut');
		$BDAgenda->heurefin = $this->params('new_heurefin');
		$BDagenda->repetition = $this->params('new_repetition');
		$BDagenda->lieu = $this->params('new_lieu');
		$BDagenda->sujet = $this->params('new_sujet');
		$BDagenda->commentaires = $this->params('new_com');
		$BDagenda->get(array('datedebut','datefin','repetition','lieu','sujet'));
		$id = $BDagenda->id;
		
		// Completer la table de correspondance
		$BDagendautilisateur = new AgendaUtilisateurModel();
		$BDagendautilisateur->agenda = $id;
		
		$BDUtil = new UtilisateurModel();
		$BDUtil->login = $this->session('login');
		$BDUtil->get(array('login'));
		
		$BDagendautilisateur->utilisateur = $BDUtil->id;
		
		$this->redirect('agenda/default/index');
	}
}

?>
