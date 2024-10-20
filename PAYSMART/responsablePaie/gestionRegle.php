<?php
    require_once ('../connect.php');
    include 'menuRp.php';
    //include '../responsableRH/menu.php';
    $url = "$_SERVER[REQUEST_URI]";
    $_SESSION['url'] = $url;
    $conn2 = mysqli_connect("localhost","root","","paysmart");
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Regles</title>
    <link rel="stylesheet" href="../css/style_table.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <br><br><br>

    <style>
        .table {
            color: black;
        }

        .table th {
            background-color: #0a5275;
            color: #ffffff;
        }
    </style>

    <style>
        /* Styles pour le champ select */
        select.form-control {
            border-radius: 10px;
            background-color: #f5f5f5;
            border: none;
            padding: 8px;
            width: 200px;
            margin-right: 10px;
        }

        /* Styles pour le champ input */
        input.form-control {
            border-radius: 10px;
            background-color: #f5f5f5;
            border: none;
            padding: 8px;
            width: 200px;
            margin-right: 10px;
        }

        /* Styles pour le bouton */
        button.button {
            border-radius: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        button.button:hover {
            background-color: #0056b3;
        }
    </style>

    <style>
        .confirmation-alert {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }

        .confirmation-alert p {
            margin: 0;
            font-size: 16px;
            text-align: center;
        }

        .confirmation-alert .btn-wrapper {
            margin-top: 20px;
            text-align: center;
        }

        .confirmation-alert .btn-wrapper button {
            margin-right: 10px;
        }
    </style>

    <script>
        function showConfirmationModal(id) {
            const modalId = `#confirmationModal${id}`;
            const modal = document.querySelector(modalId);
            modal.style.display = 'block';
        }

        function hideConfirmationModal(id) {
            const modalId = `#confirmationModal${id}`;
            const modal = document.querySelector(modalId);
            modal.style.display = 'none';
        }
    </script>
</head>
<body>
    <h2>Regles</h2><br>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    <select name="opt" class="form-control custom-select" id="CategorySelected">
                        <option selected value="regle">nom</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="search" value="<?php if(isset($_POST['search'])){echo $_POST['search']; } ?>" class="form-control" placeholder="chercher par">
                </td>
                <td>
                    <button type="submit" class="button">Chercher</button>
                </td>
                <td>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <a href="definirRegle.php" class="button">Ajouter regle</a>
                </td>
            </tr>
        </table>
    </form>

    <br><br><br><br>

    <table class="table" style="color:black;">
        <thead>
            <tr>
                <th>idRegle</th>
                <th>Nom Regle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['search'])) {
                $filtervalues = $_POST['search'];
                $selectedOption = $_POST["opt"];
                echo $filtervalues . " " . $selectedOption;
                if (!$conn2) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $filtervalues = mysqli_real_escape_string($conn2, $filtervalues);
                $selectedOption = mysqli_real_escape_string($conn2, $selectedOption);
                $query = "SELECT * FROM regle WHERE `$selectedOption` LIKE '%$filtervalues%'";
                $query_run = mysqli_query($conn2, $query);
            } else {
                $query = "SELECT * FROM regle";
                $query_run = mysqli_query($conn2, $query);
            }

            if ($query_run) {
                $num_rows = mysqli_num_rows($query_run);
                if ($num_rows > 0) {
                    while ($regle = mysqli_fetch_assoc($query_run)) {
                        ?>
            <tr>
                <td scope="row"><?php echo $regle['idRegle']; ?></td>
                <td><?php echo $regle['regle']; ?></td>
                    <td>
                    <a href="updateRegle.php?id=<?php echo $regle['idRegle']; ?>" class="m-2">
                        <i class="fa fa-edit fa-2x" style="color:blue"></i>
                    </a>

                    <i class="fa fa-trash fa-2x red-icon"
                        onclick="showConfirmationModal(<?php echo $regle['idRegle']; ?>)"></i>

                    <div class="confirmation-alert" id="confirmationModal<?php echo $regle['idRegle']; ?>"
                        style="color:white;background: #0a5275">
                        <p>Etes vous sûr de vouloir supprimer la regle <?php echo $regle['regle']; ?> ?</p>
                        <div class="btn-wrapper">
                            <button class="button"
                                onclick="hideConfirmationModal(<?php echo $regle['idRegle']; ?>)">Annuler</button>
                            <a href="deleteRegle.php?id=<?php echo $regle['idRegle']; ?>">
                                <button class="button">Confirmer</button>
                            </a>
                        </div>
                    </div>
                    </td>
            </tr>
            <?php

                    }
                } else {
                    ?>
            <tr>
                <td colspan="4">Aucun résultat</td>
            </tr>
            <?php
                }
            } else {
                echo "Error: " . mysqli_error($conn2);
            }
            ?>

        </tbody>
    </table>

</body>

</html>
