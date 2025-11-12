<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joonas Eskelinen</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google-fontit -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

    <!-- Oma CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!--header ja navbar -->
<header class="hero-header text-white">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.html">Etusivu</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="kukaolen.html">Kuka olen</a></li>
          <li class="nav-item"><a class="nav-link" href="historia.html">Koulutus / työhistoria</a></li>
          <li class="nav-item"><a class="nav-link" href="terveyssivusto.php">Terveyssivusto</a></li>
          <li class="nav-item"><a class="nav-link" href="taidot.html">Taidot / kiinnostuksen kohteet</a></li>
          <li class="nav-item"><a class="nav-link" href="tietovisa.php">Tietovisa</a></li>
          <li class="nav-item"><a class="nav-link" href="tyonaytteet.html">Työnäytteet</a></li>
          <li class="nav-item"><a class="nav-link" href="yhteydenotto.php">Ota yhteyttä</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="hero-content d-flex flex-column justify-content-center align-items-center text-center">
    <div class="container">
      <h1 class="hero-title">Liikuntapäiväkirja</h1>
    </div>
  </div>
</header>

<main class="container my-5">
  <div class="neu-box text-left">
    <h3>Syötä oma nimimerkki, niin liikuntapäiväkirjasi aukeaa</h3>

    <?php
    // jos lomake lähetetty
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nimimerkki"])) {

        // Luetaan nimimerkki ja siistitään mahdolliset ylimääräiset merkit
        $nimimerkki = trim($_POST["nimimerkki"]);

        // määritetään tiedoston nimi
        $tiedosto = "liikuntapaivakirja_" . $nimimerkki . ".txt";

        echo "<h4>Päiväkirjasi: $nimimerkki</h4><br>";

        // tarkistetaan löytyykö tiedosto
        if (file_exists($tiedosto)) {
            $rivit = file($tiedosto, FILE_IGNORE_NEW_LINES);

            //jos ei vielä syötettyjä tietoja
            if (empty($rivit)) {
                echo "<p>Ei vielä merkintöjä.</p>";
            } else {
                //tässä tulostetaan tiedot
                echo "<ul>";
                foreach (array_reverse($rivit) as $rivi) {
                    echo "<li>" . htmlspecialchars($rivi) . "</li><hr>";
                }
                echo "</ul>";
            }
        } 
        //jos nimimerkillä ei löydy vielä tietoja
        else {
            echo "<p style='color:red;'>Ei löytynyt päiväkirjaa nimimerkillä $nimimerkki.</p>";
        }
    }
    ?>

    <!-- lomake -->
    <form method="POST" class="mt-3">
      <label for="nimimerkki">Syötä nimimerkki:</label><br>
      <input type="text" name="nimimerkki" id="nimimerkki" >
      <button type="submit" class="btn btn-visa mt-2">Näytä päiväkirja</button>
    </form>

    <div class="text-center mt-4">
      <a href="terveyssivusto.php" class="btn btn-visa">← Palaa takaisin</a>
    </div>
  </div>
</main>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4">
  <p class="mb-0">© 2025 Joonas Eskelinen</p><br>
  <a href="mailto:joonas_eskelinen@hotmail.com" class="btn btn-outline-light btn-sm me-2">Sähköposti</a>
  <a href="https://github.com/omaGithub" class="btn btn-outline-light btn-sm">GitHub</a>
</footer>

</body>
</html>