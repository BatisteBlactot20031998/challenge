<?php
// ouverture de la connexion
$dsn = 'mysql:host=localhost;dbname=wild';
$username = 'root';
$password = 'root';
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$db = new PDO($dsn, $username, $password, $options);
?>
<?php
// traitement
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // récupération des données du formulaire
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // création de la requête
    $sql = "INSERT INTO users
              (argonaute)
            VALUES
              ('{$_POST['argonaute']}')";
    // envoi de la requête      
    $db->exec($sql);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header section -->
    <header>
        <h1>
            <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
            Les Argonautes
        </h1>
    </header>

    <!-- Main section -->
    <main>

        <!-- New member form -->
        <h2>Ajouter un(e) Argonaute</h2>
        <form class="new-member-form" action="" method="POST">
            <label for="argonaute">Nom de l&apos;Argonaute</label>
            <input id="argonaute" name="argonaute" type="text" placeholder="Charalampos" />
            <button type="submit">Envoyer</button>
        </form>

        <!-- Member list -->
        <h2 class="mb-4">Membres de l'équipage</h2>
        <?php
        // Creation de la requête
        $requete = "SELECT * FROM users";
        // Envoi de la requête et recuperation du resultat
        $listeUsers = $db->query($requete)->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="row">
            <section class="member-list col-12">
                <?php foreach ($listeUsers as $user) { ?>
                    <div class="member-item col-4"><?php echo "{$user['argonaute']}"; ?></div>
                <?php } ?>
            </section>
        </div>
    </main>

    <footer>
        <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>