<?php
require('connect.php');
include "menuRp.php";
if (isset($_GET['id'])) 
{
   $idregle = htmlspecialchars($_GET['id']);
}
else 
{
  $idregle= "";
}
	$selSql = "SELECT * FROM `regle` WHERE idRegle= '$idregle'";
	$res = $bd->query($selSql);
	$r = $res->fetch(PDO::FETCH_ASSOC);
    $selSql1 = "SELECT * FROM `condition_regle` WHERE idRegle= '$idregle'";
	$res1 = $bd->query($selSql1);
	$conditions = $res1->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT DISTINCT nomRubrique FROM rubrique";
$resultat = $bd->query($sql);
$rubriques = $resultat->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (!isset($_POST['formule'])) 
    {
        $_POST['formule'] = '';
    }
    $conditionCount = 0;
    if(isset($_POST['modifier']))
    {
        if(isset($_POST['formule']))
        {
            $f = $_POST['formule'];
            $sql1 = "UPDATE regle SET regle = '$f' WHERE idRegle = '$idregle'";
            $res1 = $bd->query($sql1);
            if($res1)
            {
                    $SQL =  "SELECT count(*) AS conditionCount FROM condition_regle WHERE idRegle = '$idregle'";
                    $resS = $bd->query($SQL);
                    $rr = $resS->fetch(PDO::FETCH_ASSOC);
                    if($rr['conditionCount'] >= 1)
                    {
                        for ($i = 0; $i < $rr['conditionCount']; $i++) 
                        {
                            $j = $i + 1;
                            if (isset($_POST['condition'.$j]) && isset($_POST['then'.$j])) 
                            {
                                $con = $_POST['condition'.$j];
                                $aff = $_POST['then'.$j];
                                $sql2 = "UPDATE condition_regle SET condition_R = '$con',affectation = '$aff' WHERE idRegle = '$idregle'";
                                $res2 = $bd->query($sql2);
                                if($res2) $message = "modification avec succes";
                                else $erreur = "Une erreur est survenue lors de l'ajout des conditions";
                            }
                            else $erreur = "Vous devez ajouter tous les champs";
                        }
                    } 
                    echo '<script>window.location.href = "gestionRegle.php";</script>';
            }
            else $erreur = "Une erreur est survenue lors de l'ajout de la regle";
        }
    }
}
?>

    <title>Gestion des règles</title>
    <style>
        .calculator-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .calculator-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 10px;
        }

        .calculator-buttons button {
            width: 80px;
            height: 60px;
            margin: 5px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #e0e0e0;
            border: none;
            cursor: pointer;
        }

        .calculator-buttons button:hover {
            background-color: #d0d0d0;
        }

        .formule-input {
            width: 100%;
            height: 40px;
            padding: 5px;
            font-size: 18px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .submit-button {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #4caf50;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #45a049;
        }
        
        .condition-input {
            width: 80px;
            height: 30px;
            margin: 5px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        
        .condition-label {
            font-size: 14px;
            margin-right: 5px;
        }
        
        .if-then-section {
            display: none;
        }
        
        .show-if-then .if-then-section {
            display: block;
        }
        .icon {
            font-size: 24px;
        }
        .container {
  display: flex;
  flex-direction: row;
}

.button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #0a5275;
  /* background-color: #5e72e4; */
  color: white;
  text-align: center;
  text-decoration: none;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  font-size: 16px;
}
.select-container 
{
  /* Styles du conteneur du select */
            max-width:250px;
            height:20px;
            margin: 0 auto;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            border-radius: 5px;
}
    </style>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
<body>
    <br><br><br><br>
    <div class="container">
    <div class="calculator-container">
        <form action="" method="POST">
            <input type="text" id="formule" class="formule-input" name="formule" value="<?php if(isset($r['regle'])) echo $r['regle']; ?>">
            <div class="calculator-buttons">
                <!-- Boutons pour les rubriques de paie -->
                <?php
                // Récupérer les rubriques de paie depuis la base de données
                foreach ($rubriques as $rubrique) 
                {
                    echo '<button onclick="addRubrique(\'' . $rubrique['nomRubrique'] . '\')">' . $rubrique['nomRubrique'] . '</button>';
                }
                ?>
            </div>

            <div class="calculator-buttons">
                <!-- Boutons pour les opérateurs -->
                <button onclick="addOperator('+')">+</button>
                <button onclick="addOperator('-')">-</button>
                <button onclick="addOperator('*')">*</button>
                <button onclick="addOperator('/')">/</button>
                <button onclick="addOperator('.')">.</button>
                <button onclick="addOperator('=')">=</button>
                <button onclick="addOperator('==')">==</button>
                <button onclick="addOperator('>')">></button>
                <button onclick="addOperator('<')"><</button>
                <button onclick="addOperator('>=')">>=</button>
                <button onclick="addOperator('<=')"><=</button>
                <button onclick="addOperator('%')">%</button>
            </div>

            <div class="calculator-buttons">
                <!-- Boutons pour les nombres -->
                <button onclick="addNumber(1)">1</button>
                <button onclick="addNumber(2)">2</button>
                <button onclick="addNumber(3)">3</button>
                <button onclick="addNumber(4)">4</button>
                <button onclick="addNumber(5)">5</button>
                <button onclick="addNumber(6)">6</button>
                <button onclick="addNumber(7)">7</button>
                <button onclick="addNumber(8)">8</button>
                <button onclick="addNumber(9)">9</button>
                <button onclick="addNumber(0)">0</button>
            </div>

            <div class="calculator-buttons">
                <!-- Boutons pour les taux, etc. -->
                <button onclick="addValue('Taux')">Taux</button>
                <button onclick="addValue('Valeur')">Valeur</button>
            </div>
            <!-- <button class="button" type="button" onclick="addCondition()"><i class="fa-solid fa-square-plus"></i></button>
            <button class="button" type="button" onclick="removeCondition()"><i class="fas fa-square-minus"></i></button> -->
            
            <div id="condition-elements">
                <!-- Zone pour afficher les éléments de condition ajoutés -->
                <?php 
                    foreach ($conditions as $condition) 
                    {
                        $i = 1;
                        echo '<input type="text" placeholder="condition" class="formule-input" name="condition'.$i.'" value="' . $condition['condition_R'] . '" >';
                        echo '<input type="text" placeholder="affectation" class="formule-input" name="then'.$i.'" value="' . $condition['affectation'] . '" >';
                        $i++;
                        ?> 
                        <script> document.cookie = 'conditionCount=' + conditionCount; </script>
                        <br>
                        <?php
                    }
                ?>
            </div>
            <br>
            <button class="button" type="submit" name="modifier">Submit</button>
            <button class="button" type="reset" >Annuler</button>
        </form>
    </div>
    
    </div>

    <script>
        var conditionCount = 0;

        function addRubrique(rubrique) 
        {
            event.preventDefault();
            document.getElementById('formule').value += rubrique + ' ';
        }

        function addOperator(operator) {
            event.preventDefault();
            document.getElementById('formule').value += operator + ' ';
        }

        function addValue(value) {
            event.preventDefault();
            document.getElementById('formule').value += value + ' ';
        }

        function addNumber(number) {
            event.preventDefault();
            document.getElementById('formule').value += number;
        }
    </script>
</body>
</html>
