<!DOCTYPE html>
<html>
<head>
<title>Devis</title>
<style>
body {
  font-family: Arial, sans-serif;
}
table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  border: 1px solid black;
  padding: 8px;
  text-align: left;
}
th {
  background-color: #f2f2f2;
}
.logo {
  text-align: center;
  margin-bottom: 20px;
}
.info {
  margin-bottom: 20px;
}
.client-info {
  text-align: right;
}

.client-info span {
  font-weight: bold;
  margin-right: 10px;
}
.footer {
  text-align: right;
  margin-top: 20px;
}
.no-print {
        display: block;
        padding: 10px 0px 0px 0px;
    border: 1px outset buttonborder;
    border-radius: 3px;
    color: buttontext;
    background-color: buttonface;
    text-decoration: none;
    width: 250px;
    height: 30px;
    text-align: center;
    }
    @media print {
        .no-print {
            display: none;
          border-radius: 10px;
        }
    }
  


</style>
</head>
<body>
<div class="logo">
<img alt="image" src="Logo-Will-Clean.png"  height="150" width="150" />
</div>
<div class="info">
<p>SA Will Clean</p>
<p>Gosier, 97190</p>
<p>Route des hôtels</p>
<p>Numéro de devis: WC<?php echo date('Ymd'); ?> </p>
<p>Date: <?php echo date('d/m/Y à H:i'); ?> </p>

 <div class="client-info">
    <p><span>Nom:</span> <?php echo $_POST['nom']; ?></p>
    <p><span>Prénom:</span> <?php echo $_POST['prenom']; ?></p>
    <p><span>Adresse e-mail:</span> <?php echo $_POST['email']; ?></p>
  </div>
</div>
<table>
<tr>
<th>Description</th>
<th>Quantité</th>
<th>Prix unitaire TTC</th>
<th>Prix unitaire HT</th>
<th>TVA</th>
</tr>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lavage_auto";


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['email'];


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO prospect (nom, prenom, mail) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nom, $prenom, $mail);
$stmt->execute();
$stmt->close();
$conn->close();

$services = $_POST['services'];

// Vérifier si des services ont été sélectionnés
if (isset($_POST['services'])) {
  // Définir les prix unitaires des services
  $prix_unitaires = [
    'nettoyage_interieur_complet' => 150.00,
    'nettoyage_exterieur_complet' => 250.00,
    'nettoyage_interieur_exterieur_complet' => 325.00,
    'nettoyage_carrosserie' => 80.00,
    'nettoyage_jantes' => 60.00,
    'lustrage_polissage' => 150.00,
    'nettoyage_tapis' => 45.00,
    'traitement_cuire_plastique' => 100.00,
    'nettoyage_siege' => 45.00,
  ];
  // Définir les taux de TVA des services
  $taux_tva = [
    'nettoyage_interieur_complet' => 8.5,
    'nettoyage_exterieur_complet' => 8.5,
    'nettoyage_interieur_exterieur_complet' => 8.5,
    'nettoyage_carrosserie' => 8.5,
    'nettoyage_jantes' => 8.5,
    'lustrage_polissage' => 8.5,
    'nettoyage_tapis' => 8.5,
    'traitement_cuire_plastique' => 8.5,
    'nettoyage_siege' =>8.5,
  ];
  // Calculer le total HT et la TVA
  $total_ht = 0;
  $total_tva = 0;
  $total_ttc = 0;

  foreach ($_POST['services'] as $service) {
    // Afficher la ligne du service dans le tableau
    echo '<tr>';
    echo '<td>' . $service . '</td>';
    echo '<td>' . 1 . '</td>';

    $prix_unitaire_ttc= $prix_unitaires[$service];
    echo '<td>' . $prix_unitaire_ttc . ' €</td>';

    $total_ttc_service =  round($prix_unitaires[$service] *(1- ($taux_tva[$service] /100)),2);
    echo '<td>' . $total_ttc_service . ' €</td>';
    $tva_service = ($total_ttc_service );
    echo '<td>' . $taux_tva[$service] . '%</td>';
    echo '</tr>';
    // Mettre à jour le total HT et la TVA
    $total_ht += $tva_service;
    $total_ttc += $prix_unitaire_ttc;
  }
  $total_tva = $total_ttc - $total_ht ;
  
}
?>
<table>
<tr>
<td>Total HT</td>
<td><?php echo $total_ht; ?> €</td>
</tr>
<tr>
<td>TVA 8.5%</td>
<td><?php echo $total_tva; ?> €</td>
</tr>
<tr>
<td><strong>Total TTC</strong></td>
<td><strong><?php echo $total_ht + $total_tva; ?> €</strong></td>
</tr>
</table>
<div class="footer">
<p>Durée de validité: 1 mois</p>
<p>Conditions de règlement: 30% à la commande, paiement à réception de facture</p>
<p>Nous restons à votre disposition pour toute information complémentaire.</p>
<p>Si ce devis vous convient, veuillez réserver un créneau horaire sur notre site web</p>


<a href="https://app.lemcal.com/@suity-agency/" class="no-print">Réserver un créneau horaire</a>
</div>
</body>
</html>