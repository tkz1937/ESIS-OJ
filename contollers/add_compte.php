
<?php
	require_once('../models/structure/etudiant.class.php');
	require_once('../models/dao/connexiondb.class.php');
	require_once('../models/dao/etudiant.dao.php');
	
	if(isset($_POST['matricule'], $_POST['pwd'], $_POST['pwdconf'])) {
		$matricule = $_POST['matricule'];
		$pwd = $_POST['pwd'];
		$pwdconf = $_POST['pwdconf'];
		
		if($pwd == $pwdconf) {
			$etudiant = new Etudiant(0, $matricule, $pwd);
			$etudao = new EtudiantDAO();

			$res = $etudao->creerCompte($etudiant);
			
			if($res) {
				//Créer une session
				
				session_start();
				$_SESSION['matricule'] = $matricule;
				
				header('Location: ../views/today.php');
			} else {
				header('Location: ../views/index.php?error=2');
			}
			
		} else {
			header('Location: ../views/index.php?error=1');
		}
		
	} else {
		echo 'Erreur dans les données envoyées!';
	}
?>