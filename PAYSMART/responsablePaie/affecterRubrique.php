<?php
require('connect.php');
include "menuRp.php";

// Récupérer les paramètres depuis l'URL
$idFiliale = isset($_GET['idfil']) ? $_GET['idfil'] : '';

// Récupérer les règles affectées depuis la base de données
$sql = "SELECT a.idaffec, r.idRubrique, r.nomRubrique FROM affectation a INNER JOIN rubrique r ON a.idRub = r.idRubrique WHERE a.idFiliale = :idFiliale";
$stmt = $bd->prepare($sql);
$stmt->bindParam(':idFiliale', $idFiliale);
$stmt->execute();
$affectations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer toutes les règles depuis la base de données
$sqlRegles = "SELECT * FROM rubrique";
$resultatRegles = $bd->query($sqlRegles);
$regles = $resultatRegles->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(isset($_POST['affecter']))
    {
        if(isset($_POST['rubriques']))
        {
            $r = $_POST['rubriques'];
            $inser = "INSERT INTO affectation(idRub,idFiliale) VALUES ('$r','$idFiliale')";
            $res1 = $bd->query($inser);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Affectation des rubriques</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select {
            width: 300px;
            height: 30px;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <br><br><br><br><br><br><br><br>
    <h2>Affectation des rubriques</h2>

    <form action="" method="POST">
        <div>
            <label for="regles">Règles :</label>
            <select name="rubriques" id="regles">
                <option value="">Sélectionnez une rubrique</option>
                <?php foreach ($regles as $regle): ?>
                    <?php
                    $idRegle = $regle['idRubrique'];
                    $regleTexte = $regle['nomRubrique'];
                    $selected = '';
                    foreach ($affectations as $affectation) {
                        if ($affectation['idRubrique'] == $idRegle) {
                            $selected = 'selected';
                            break;
                        }
                    }
                    ?>
                    <option value="<?php echo $idRegle; ?>" <?php echo $selected; ?>><?php echo $regleTexte; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="hidden" name="idRub" value="<?php echo $idRub; ?>">
        <input type="hidden" name="idFiliale" value="<?php echo $idFiliale; ?>">
        <br><br>
        <input type="submit" value="Enregistrer" name="affecter" onclick="showMessage()">
    </form>
    <script>
    function showMessage() {
        alert("La règle a été ajoutée avec succès !");
    }
</script>
</body>
</html>
