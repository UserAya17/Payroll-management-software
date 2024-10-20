<?php
    $conn = mysqli_connect("localhost", "root", "", "paysmart");
    if (!$conn) {
        die("Erreur de connexion à la base de données: " . mysqli_connect_error());
    }
    
    if (!empty($_POST["id_pays"])) {
        $query = "SELECT * FROM utilisateur WHERE matricule = '" . $_POST["id_pays"] . "'";
        $results = mysqli_query($conn, $query);
?>
        <option value="">Sélectionnez la ville</option>
<?php
        while ($ville = mysqli_fetch_assoc($results)) {
?>
            <option value="<?php echo $ville["id"]; ?>"><?php echo $ville["name"]; ?></option>
<?php
        }
    }
    mysqli_close($conn);
?>
