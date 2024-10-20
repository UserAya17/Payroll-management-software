<?php
require('../connect.php');
function dateEnToDateFr($dateEn)
{
    //$dateEn='2019-02-26';
    return substr($dateEn, 8, 2) . "/" . substr($dateEn, 5, 2) . "/" . substr($dateEn, 0, 4);
    // Result: '26/02/2019'
}

function dateFrToDateEn($dateFr)
{
    //$dateFR='26/02/2019';
    return substr($dateFr, 6, 4) . "-" . substr($dateFr, 3, 2) . "-" . substr($dateFr, 0, 2);
    // Result: '2019-02-26'
}

require('fpdf.php');

session_start();

echo $_SESSION['m']."ana moiiiiiiiiis";
echo $_SESSION['a']."ana annnee";

//$pdo = new PDO("mysql:host=localhost;dbname=ecoledb", "root", "");
//
//$mois=$_SESSION['m'];
//$annee=$_SESSION['a'];
$mois=$_SESSION['m'];
$annee=$_SESSION['a'];
if (isset($_GET['ids']))
    $ids = $_GET['ids'];
else
    $ids = "Q0979";


	$selSql = "SELECT * FROM `utilisateur` WHERE matricule= '$ids'";
	$res = $bd->query($selSql);
	$stagiaire = $res->fetch(PDO::FETCH_ASSOC);

	$selSql1 = "SELECT * FROM `contrat` WHERE idUser= '$ids' ";
	$res1 = $bd->query($selSql1);
	$contrat= $res1->fetch(PDO::FETCH_ASSOC);

$nom_prenom = strtoupper($stagiaire['nom'] . "  " . $stagiaire['prenom']);

$date_naiss = dateEnToDateFr($stagiaire['dateNaissance']);

$lieu_naiss = strtoupper($stagiaire['adresse']);

$cin = strtoupper($stagiaire['cin']);


$num_insc = strtoupper($stagiaire['numeroTel']);


$conn2 = mysqli_connect("localhost","root","","paysmart");

	//$matricule = $_GET['matricule'];
	//$filiale = $_GET['filiale'];
 
  $matricule =$ids;

  $selSql = "SELECT * FROM `contrat` WHERE idUser= '$matricule'";
  $res = $bd->query($selSql);
  $contrat = $res->fetch(PDO::FETCH_ASSOC);
  $salaireDeBase=$contrat['salaireDeBase'];
	$idfiliale = $contrat['idFiliale'];

	$selSql = "SELECT * FROM `utilisateur` WHERE matricule= '$matricule'";
	$res = $bd->query($selSql);
	$user = $res->fetch(PDO::FETCH_ASSOC);

  $idfiliale=$contrat['idFiliale'];
	$sql1= "SELECT * from filiale WHERE idFiliale = '$idfiliale'";
	$i = $bd->query($sql1);
	$filiale = $i->fetch(PDO::FETCH_ASSOC);
  $heureTravail=$filiale['heureTravail'];
  
$nomFiliale=$filiale['nomFliale'];



$selSql3 = "SELECT * FROM `bulltin` WHERE matricule= '$matricule' && MONTH(date)=$mois && YEAR(date)=$annee ";
	$res3 = $bd->query($selSql3);
	$bulltins= $res3->fetch(PDO::FETCH_ASSOC);

	echo $bulltins['date'];
  
    

   


//Création d'un nouveau doc pdf (Portrait, en mm , taille A5)
$pdf = new FPDF('P', 'mm', 'A5');

//Ajouter une nouvelle page
$pdf->AddPage();

// entete
$pdf->Image('en-tete.jpg', 10, 5, 130, 20);

// Saut de ligne
$pdf->Ln(18);


// Police Arial gras 16
$pdf->SetFont('Arial', 'B', 16);

// Titre
$pdf->Cell(0, 10, 'BULLETIN DE SALAIRE', 'TB', 1, 'C');
$pdf->Cell(0, 10, 'N°222:', 0, 1, 'C');

// Saut de ligne
$pdf->Ln(5);

// Début en police Arial normale taille 10

$pdf->SetFont('Arial', '', 10);
$h = 7;
$retrait = "      ";
$pdf->Write($h, $retrait . "Entreprise  : ". $nomFiliale. " \n");

$pdf->Write($h, $retrait . "Matricule : ". $ids . " \n");

$pdf->Write($h, $retrait . "L'employe : ");

//Ecriture en Gras-Italique-Souligné(U)
$pdf->SetFont('', 'BIU');
$pdf->Write($h, $nom_prenom . "\n");


//Ecriture normal
$pdf->SetFont('', '');
$pdf->Write($h, $retrait . "Situation familiale : " . $user['situationFamiliale'] . " \n");
$pdf->Write($h, $retrait . "Nombre enfant : " . $user['nombreEnfants'] . " \n");

$pdf->Write($h, $retrait . "À : " . $lieu_naiss . "\n");

$pdf->Write($h, $retrait . "CIN N° : " . $cin . " \n");

$pdf->Write($h, $retrait . "CNSS : " . $bulltins['CNSS'] . " \n");

$pdf->Write($h, $retrait . "CIMR:  " . $bulltins['CIMR']. " \n");


$pdf->Write($h, $retrait . "ALLOCATION FAMILIALE : " . $bulltins['ALLOCATION']. " \n");

$pdf->Write($h, $retrait . "Conge : " . $bulltins['CONGE'] . " \n");
$pdf->Write($h, $retrait . "Absence : " . $bulltins['ABSENCE']. " \n");

$pdf->Write($h, $retrait . "SALAIRE DE BASE:  " . $salaireDeBase. " \n");


$pdf->Write($h, $retrait . "SALIRE NET : " . $bulltins['SALAIRENET'] . " \n");


$pdf->Cell(0, 5, 'Fait à entreprise :' .$filiale['nomFliale']. '  Le :' . date('d/m/Y'), 0, 1, 'C');

// Décalage de 20 mm à droite
$pdf->Cell(20);
$pdf->Cell(80, 8, "Le directeur pédagogique de l'entreprise", 1, 1, 'C');

// Décalage de 20 mm à droite
$pdf->Cell(20);
$pdf->Cell(80, 5, "Mr Directeur", 'LR', 1, 'C');
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LR', 1, 'C'); // LR Left-Right
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LR', 1, 'C');
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LR', 1, 'C');
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LRB', 1, 'C'); // LRB : Left-Right-Bottom (Bas)

//Afficher le pdf
$pdf->Output('', '', true);
?>

