<!DOCTYPE html>
<html>
<head>
    <title>Will Clean - Devis</title>
    
    <style>
        /* Ajout de styles pour améliorer l'apparence du formulaire */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        form {
            width: 50%; /* Largeur du formulaire */
            margin: 40px auto; /* Centrage du formulaire */
            padding: 20px; /* Espacement intérieur du formulaire */
            border: 1px solid #ccc; /* Bordure du formulaire */
            border-radius: 10px; /* Arrondi des coins du formulaire */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre portée du formulaire */
        }
        
        input[type="text"], input[type="email"] {
            width: 95%; /* Largeur des champs de saisie */
            height: 30px; /* Hauteur des champs de saisie */
            margin-bottom: 20px; /* Espacement entre les champs de saisie */
            padding: 10px; /* Espacement intérieur des champs de saisie */
            border-radius: 10px; /* Arrondi des coins du formulaire */
            border: 1px solid #ccc; /* Bordure des champs de saisie */
        }
        input[type="checkbox"] {
            transform: scale(1.2); /* Aggrandir la taille des cases à cocher */
            margin-right: 10px; /* Espacement entre les cases à cocher */
            border-radius: 30px; /* Arrondi des coins des cases */
        }
       
        h1, h2,h6 {
            color: #333; /* Couleur des titres */
            margin-bottom: 20px; /* Espacement entre les titres */
            text-align: center;
        }
    </style>
	
	<script>
        function validateForm() {
            var checkboxes = document.getElementsByName('services[]');
            var isValid = false;
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    isValid = true;
                    break;
                }
            }
            if (!isValid) {
                alert('Veuillez sélectionner au moins un service.');
                return false;
            }
            return true;
        }
    </script>
    
</head>
<body>
    <h1>Génération de devis</h1>
	<h6>En générant ce devis, vous acceptez que vos informations soient réutilisées à des fins commerciales.</h6>
    <form action="devis.php" method="post" onsubmit="return validateForm()">

        <label for="nom">Nom :<pre></pre></label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom : <pre></pre></label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="email">Adresse e-mail : <pre></pre></label>
        <input type="email" id="email" name="email" required><br><br>

        <h2>Sélectionnez vos services:</h2>
        <?php
        // Définir les services disponibles
        $services = [
            'nettoyage_interieur_complet' => 'Nettoyage intérieur complet (150€)',
            'nettoyage_exterieur_complet' => 'Nettoyage extérieur complet (250€)',
            'nettoyage_interieur_exterieur_complet' => 'Nettoyage intérieur & extérieur complet (325€)',
            'nettoyage_tapis' => 'Nettoyage tapis (45€)',
            'traitement_cuire_plastique' => 'Traitement cuir & plastique (100€)',
            'nettoyage_siege' => 'Nettoyage sièges (45€)',
            'nettoyage_carrosserie' => 'Nettoyage carrosserie (80€)',
            'lustrage_polissage' => 'Lustrage & polissage (150€)',
            'nettoyage_jantes' => 'Nettoyage jantes (60€)'
        ];
      $i = 0;
        foreach ($services as $key => $value) {
            echo '<input type="checkbox" name="services[]" value="' . $key . '">';
            echo '<label for="' . $key . '">' . $value . '</label><br>';
            $i = $i+ 1;

            if($i == 3)
            {
                echo '<label for="1s">  </label><br>';
                $i = 0;
            }
           
        }
        ?>
        <br><br>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>