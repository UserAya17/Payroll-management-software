<?php
ob_start();
require('connect.php');
include "menuRp.php";
if (isset($_GET['idfil'])) 
{
   $idfil = htmlspecialchars($_GET['idfil']);
}
else 
{
  $idfil = "";
}
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
    if(isset($_POST['ajouter']))
    {
        if(isset($_POST['formule']) && isset($_POST['rubrique']))
        {
            $f = $_POST['formule'];
            $sql1 = "INSERT INTO regle(regle) VALUES ('$f')";
            $res1 = $bd->query($sql1);
            if($res1)
            {
                $idregle = $bd->lastInsertId();
                $r = $_POST['rubrique'];
                $search = "SELECT idRubrique FROM rubrique WHERE nomRubrique= '$r'";
                $req = $bd->query($search);
                $idrubr = $req->fetch(PDO::FETCH_ASSOC);
                $idrub = $idrubr['idRubrique'];
                if ($idrubr)
                {
                    if (isset($_GET['idfil'])) 
                    {
                        $sql3 = "INSERT INTO affectation(idRub,idFiliale,idRegle) VALUES ('$idrub','$idfil','$idregle')";
                    }
                    else 
                    {
                        $sql3 = "INSERT INTO affectation(idRub,idRegle) VALUES ('$idrub','$idregle')";
                    }
                    //$sql3 = "INSERT INTO affectation(idRub,idFiliale,idRegle) VALUES ('$idrubr','NULL','$idregle')";
                    $res3 = $bd->query($sql3);
                    $conditionCount = isset($_COOKIE['conditionCount']) ? intval($_COOKIE['conditionCount']) : 0;
                    setcookie('conditionCount', $conditionCount, time() + (86400 * 30)); // Met à jour le cookie avec la nouvelle valeur de conditionCount
                    if($conditionCount >= 1)
                    {
                        for ($i = 0; $i < $conditionCount; $i++) 
                        {
                            $j = $i + 1;
                            if (isset($_POST['condition'.$j]) && isset($_POST['then'.$j])) 
                            {
                                $con = $_POST['condition'.$j];
                                $aff = $_POST['then'.$j];
                                $sql2 = "INSERT INTO condition_regle (condition_R, affectation, idRegle) VALUES ('$con', '$aff', '$idregle')";
                                $res2 = $bd->query($sql2);
                                if($res2)
                                {
                                    $message = "Insertion avec succes";
                                    //header("location:rp_home.php");
                                }
                                else $erreur = "Une erreur est survenue lors de l'ajout des conditions";
                            }
                            else $erreur = "Vous devez inserer tous les champs";
                        }
                        $conditionCount = 0;
                    }
                } 
                //header("location:viewRubr.php");
                echo '<script>window.location.href = "gestionRegle.php";</script>';
            }
            else $erreur = "Une erreur est survenue lors de l'ajout de la regle";
        }
    }
}
ob_end_flush();
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
        <select name="rubrique" class="formule-input">
            <option value="">--Selectionnez--</option>
      <?php
      foreach ($rubriques as $rubrique) {
        ?>
        <option value="<?php echo $rubrique['nomRubrique'] ?>"><?php echo $rubrique['nomRubrique'] ?></option>
        <?php
      }
      ?>
    </select>
<br>  <br> 
            <input type="text" id="formule" class="formule-input" name="formule" value="<?php if(isset($r['regle'])) echo $r['regle']; ?>" readonly>
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
            <button class="button" type="button" onclick="addCondition()"><i class="fa-solid fa-square-plus"></i></button>
            <button class="button" type="button" onclick="removeCondition()"><i class="fas fa-square-minus"></i></button>
            <div id="condition-elements">
                <!-- Zone pour afficher les éléments de condition ajoutés -->
            </div>
<br>
            <button class="button" type="submit" name="ajouter">Submit</button>
            <button class="button" type="reset">Annuler</button>
        </form>
    </div>
    
    </div>

    <script>
        var conditionCount = 0;

        function addRubrique(rubrique) {
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


        function addCondition() 
        {
            event.preventDefault();
            conditionCount++;
            var conditionContainer = document.getElementById('condition-elements');

            var conditionLabel = document.createElement('label');
            conditionLabel.className = 'condition-label';
            conditionLabel.innerHTML = 'si';

            var conditionInput = document.createElement('input');
            conditionInput.type = 'text';
            conditionInput.className = 'condition-input';
            conditionInput.placeholder = '[condition]';
            conditionInput.name = 'condition' + conditionCount;

            var thenLabel = document.createElement('label');
            thenLabel.className = 'condition-label';
            thenLabel.innerHTML = 'alors';

            var thenInput = document.createElement('input');
            thenInput.type = 'text';
            thenInput.className = 'condition-input';
            thenInput.placeholder = '[affectation]';
            thenInput.name = 'then' + conditionCount;


            // var countInput = document.createElement('input');
            // countInput.type = 'hidden';
            // countInput.name = 'conditionCount';
            // countInput.value = conditionCount;
            

            // // Envoie la valeur de conditionCount au script PHP via AJAX
            // var xhr = new XMLHttpRequest();
            // xhr.open('POST', 'definirRegle.php', true);
            // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            // xhr.onreadystatechange = function () {
            //     if (xhr.readyState === 4 && xhr.status === 200) {
            //     // Réponse reçue, faire quelque chose si nécessaire
            //     }
            // };
            // xhr.send('conditionCount=' + conditionCount);
            // Stocke la valeur de conditionCount dans un cookie
            
            var lineBreak = document.createElement('br');
            document.cookie = 'conditionCount=' + conditionCount;
            conditionContainer.appendChild(conditionLabel);
            conditionContainer.appendChild(conditionInput);
            conditionContainer.appendChild(thenLabel);
            conditionContainer.appendChild(thenInput);
            conditionContainer.appendChild(lineBreak);
            //conditionContainer.appendChild(countInput);
        }
        function removeCondition() 
        {
            event.preventDefault();
    var conditionContainer = document.getElementById('condition-elements');
    var lastCondition = conditionContainer.lastElementChild;
    if (lastCondition) {
        conditionContainer.removeChild(lastCondition);
    }
    var conditionContainer = document.getElementById('condition-elements');
    var lastCondition = conditionContainer.lastElementChild;
    if (lastCondition) {
        conditionContainer.removeChild(lastCondition);
    }
    var conditionContainer = document.getElementById('condition-elements');
    var lastCondition = conditionContainer.lastElementChild;
    if (lastCondition) {
        conditionContainer.removeChild(lastCondition);
    }
    var conditionContainer = document.getElementById('condition-elements');
    var lastCondition = conditionContainer.lastElementChild;
    if (lastCondition) {
        conditionContainer.removeChild(lastCondition);
    }
    var conditionContainer = document.getElementById('condition-elements');
    var lastCondition = conditionContainer.lastElementChild;
    if (lastCondition) {
        conditionContainer.removeChild(lastCondition);
    }
}

        function submitRule() 
        {
           
            var formule = document.getElementById('formule').value;
            var rule = formule;
            // Envoyer la règle à la base de données pour l'ajouter
           // console.log('Règle à ajouter : ' + rule);
            
            
            document.forms[0].submit(); // Soumettre le formulaire pour effectuer l'insertion dans la base de données
        }
        
    </script>
</body>
</html>
