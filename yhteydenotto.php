<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ota yhteyttä – Joonas Eskelinen</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google-fontit -->
    <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header -->
<header class="hero-header text-white">
  <!-- Navigaatiopalkki -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <!-- Etusivu painike -->
      <a class="navbar-brand fw-bold" href="index.html">Etusivu</a>

      <!-- Hampurilaisvalikko mobiililaitteille -->
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navigaatiolinkit -->
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

  <!-- Hero-sisältö -->
  <div class="hero-content text-center d-flex flex-column justify-content-center align-items-center">
    <div class="container">
      <h1 class="hero-title">Ota yhteyttä</h1>
    </div>
  </div>
</header>

<!-- lomake -->
<main class="container my-5 pt-hero-gap">
  <div class="neu-box mx-auto" style="max-width: 600px;">
    <h2 class="text-center mb-4">Yhteydenottolomake</h2>

    <form action="" method="post">
      <div class="mb-3">
        <label class="form-label">Nimi:</label>
        <input type="text" name="nimi" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Sähköposti:</label>
        <input type="email" name="sahkoposti" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Puhelin:</label>
        <input type="text" name="puhelin" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Viesti:</label>
        <textarea name="viesti" rows="5" class="form-control" placeholder="Jätä viestisi tähän..."></textarea>
      </div>

      <div class="text-center">
        <input type="submit" value="Lähetä viesti" class="btn">
      </div>
    </form>

    <!-- lomakkeen tallennus -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nimi = $_POST["nimi"];
        $sahkoposti = $_POST["sahkoposti"];
        $puhelin = $_POST["puhelin"];
        $viesti = $_POST["viesti"];

        if (!filter_var($sahkoposti, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='alert alert-danger mt-4'>Virheellinen sähköpostiosoite.</div>";
        } else {
            $rivi = "$nimi, $sahkoposti, $puhelin, $viesti" . PHP_EOL;
            file_put_contents("yhteydenotot.txt", $rivi, FILE_APPEND);
            echo "<div class='alert alert-success mt-4'>Kiitos viestistäsi! 😊</div>";
        }
    }
    ?>
  </div>
</main>

<!-- footer -->
<footer class="bg-black text-white text-center py-4">
    <p class="mb-0">© 2025 Joonas Eskelinen</p><br>
    <a href="mailto:joonas_eskelinen@hotmail.com" class="btn">Sähköposti</a>
    <a href="https://github.com/JoonasEskelinen" class="btn">GitHub</a>
</footer>

<!-- Bootstrap JS-->
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
  crossorigin="anonymous">
</script>

<!-- Mobiilin sivunavigaatio -->
<div class="mobile-nav-bottom">
    <a href="tyonaytteet.html" class="mobile-nav-btn">⬅️</a>
</div>

</body>
</html>