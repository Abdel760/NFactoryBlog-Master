<?php
if(isset($_POST["article"])) {
    $tabErreur = array();
    $title = $_POST['title'];
    $chapo = $_POST['chapo'];
    $article = $_POST['article'];

    if($_POST["title"] == "")
        array_push($tabErreur, "Veuillez saisir un titre");

    if($_POST["chapo"] == "")
        array_push($tabErreur, "Veuillez saisir un sous-titre");

    if($_POST["article"] == "")
        array_push($tabErreur, "Veuillez saisir un article");

    $title = addslashes(htmlentities($title));
    $chapo = addslashes(htmlentities($chapo));
    $article = addslashes(htmlentities($_POST['article']));

    if(count($tabErreur) != 0) {
        $message = "<ul>";
        for($i = 0 ; $i < count($tabErreur) ; $i++) {
            $message .= "<li>" . $tabErreur[$i] . "</li>";
        }
        $message .= "</ul>";
        echo($message);
        include("./include/formArticle.php");
    }
    else {
        $connexion = mysqli_connect("localhost", "NFactoryBlog", "NFactoryBlog", "nfactoryblog");
        if (!$connexion) {
            die("Erreur MySQL " . mysqli_connect_errno() . " : " . mysqli_connect_error());
        }
        else {
            $requete = "INSERT INTO t_articles (ID_ARTICLE, ARTTITRE, ARTCHAPO,
                        ARTCONTENU, ARTDATE)
                        VALUES (NULL, '$title', '$chapo', '$article', NOW());";
            if(mysqli_query($connexion, $requete))
                echo "<p>Votre article a bien été ajouté.</p>";
            else
                echo "<p>Erreur base de données.</p>";

            mysqli_close($connexion);
        }
    }
}

else
    include ("./include/formArticle.php");
