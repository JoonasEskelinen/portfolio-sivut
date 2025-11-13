<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joonas Eskelinen</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- fontit -->
    <<link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">

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
      <h1 class="hero-title">Terveyssivusto</h1>
    </div>
  </div>
</header>







<section class="container my-5 pt-hero-gap">
  <div class="row g-4">
    
    <!-- 1. neu-box BMI laskenta-->
    <div class="col-md-4">
    <!-- keskitetään teksti myös pystysuunnassa -->
    <div class="neu-box text-center h-100"   style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
     <h3>Painoindeksilaskuri</h3>

    <!-- kysytään käyttäjältä paino ja pituus -->
    <form method="POST" action="">
      <div class="mb-3">
        <label for="paino">Paino (kg):</label><br>
        <input name="paino" id="paino" type="number" required>
      </div>

      <div class="mb-3">
        <label for="pituus">Pituus (cm):</label><br>
        <input name="pituus" id="pituus" type="number" required>
      </div>

      <button type="submit" class="btn">Laske painoindeksi</button>
      <button type="reset" class="btn">Nollaa luvut</button>
    </form>

    <?php
    // lasketaan painoindeksi php avulla ja tarkistetaan että tiedot on syötetty
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["paino"], $_POST["pituus"])) {
        
        // alustetaan paino ja pituus 
        $paino = (float) $_POST["paino"];
        $pituus = (float) $_POST["pituus"];

        $pituusmetrit = ($pituus / 100);
        $painoindeksi = ($paino*1.3) / pow($pituusmetrit,2.5);

            //tulostetaan painoindeksi
            echo "<p><strong>Painoindeksi: {$painoindeksi}</strong></p>";

            // lisätään kommentti painoindeksin mukaan
            if ($painoindeksi < 18.5) {
                echo "<p>Olet alipainoinen.</p>";
            } elseif ($painoindeksi < 25) {
                echo "<p>Paino on ihannealueella.</p>";
            } elseif ($painoindeksi < 30) {
                echo "<p>Paino on lievästi ylipainoinen.</p>";
            } else {
                echo "<p>Paino on merkittävästi ylipainoinen.</p>";
            }
        } 
    ?>
  </div>
</div>

    




<!-- liikuntapäiväkirja -->
<div class="col-md-4">
  <div class="neu-box text-center h-100"   style="display: flex; flex-direction: column; justify-content: center; align-items: center;">

    <h3>Liikuntapäiväkirja</h3>
    <p>Päiväkirja tallentuu nimimerkin mukaan, joten voit tehdä oman henkilökohtaisen päiväkirjan.</p>

    <?php
    // jos lomake lähetetään
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["pvm"], $_POST["laji"], $_POST["kesto"], $_POST["nimimerkki"])) {

        // luetaan tiedot
        $nimimerkki = trim($_POST["nimimerkki"]);
        $pvm = trim($_POST["pvm"]);
        $laji = trim($_POST["laji"]);
        $kesto = trim($_POST["kesto"]);
        $tuntemukset = trim($_POST["tuntemukset"] ?? "");

        // luodaan tekstitiedosto nimimerkin perusteella
        $tiedosto = "liikuntapaivakirja_" . $nimimerkki . ".txt";

        // tarkistetaan onko pakolliset kentät syötetty, tuntemukset kenttä ei pakollinen
        if ($nimimerkki && $pvm && $laji && $kesto) {

            // luodaan tallennetta rivi
            $rivi = "$pvm | $laji | $kesto min";
            if ($tuntemukset !== "") {
                $rivi .= " | $tuntemukset";
            }
            $rivi .= "\n";

            // tallennetaan teksitiedostoon
            file_put_contents($tiedosto, $rivi, FILE_APPEND);

           // jos kaikki ok, näytetään viesti 
            echo "<p style='color:#00ff99;'>✅ Merkintä tallennettu nimimerkillä $nimimerkki</p>";

        } else {
            // jos joku kenttä jäi tyhjäksi
            echo "<p style='color:red;'>Täytä kaikki pakolliset kentät (nimimerkki, päivämäärä, laji ja kesto).</p>";
        }
    }
    ?>

       <!-- lomake -->
    <form method="POST" action="terveyssivusto.php">

      <div class="mb-3">
        <label for="nimimerkki">Nimimerkki:</label><br>
        <input type="text" name="nimimerkki" id="nimimerkki" >
      </div>

      <div class="mb-3">
        <label for="pvm">Päivämäärä:</label><br>
        <input type="date" name="pvm" id="pvm" required>
      </div>

      <div class="mb-3">
        <label for="laji">Laji tai aktiviteetti:</label><br>
        <input type="text" name="laji" id="laji" required>
      </div>

      <div class="mb-3">
        <label for="kesto">Kesto (min):</label><br>
        <input type="number" name="kesto" id="kesto" required>
      </div>

      <div class="mb-3">
        <label for="fiilis">Oliko lisätuntemuksia?<br>(Valinnainen)</label><br>
        <input type="text" name="tuntemukset" id="tuntemukset" placeholder="Esim. voimattomuus">
      </div>

      <button type="submit" class="btn">Tallenna</button>
      <button type="reset" class="btn">Tyhjennä</button>
    </form>

    <br>

    <!-- linkki päiväkirjaan -->
    <a href="liikuntapaivakirja.php" class="btn">Näytä päiväkirja</a>

  </div>
</div>

    







<!-- 3. laatikko, linkkejä -->
    <div class="col-md-4">
      <div class="neu-box text-center h-100"   style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h3>Linkkejä:</h3>
        <p>Verenpaineen seurantaan
        <a href="https://sydan.fi/fakta/verenpaineen-omaseuranta/" target="_blank" style="color: #66ccff; text-decoration: underline;"> https://sydan.fi/fakta/verenpaineen-omaseuranta/</a><br>
        <a href="https://www.mehilainen.fi/sydan-ja-verisuonitaudit/verenpaine" target="_blank" style="color: #66ccff; text-decoration: underline;"> https://www.mehilainen.fi/sydan-ja-verisuonitaudit/verenpaine</a></p>
        
        <p>Liikuntasuosituksia
        <a href="https://thl.fi/aiheet/elintavat-ja-ravitsemus/liikunta/liikuntasuositukset/" target="_blank" style="color: #66ccff; text-decoration: underline;"> https://thl.fi/aiheet/elintavat-ja-ravitsemus/liikunta/liikuntasuositukset</a></p>
        
        <p>Ruokavalio
        <a href="https://thl.fi/aiheet/elintavat-ja-ravitsemus/ravitsemus/terveellinen-ruokavalio" target="_blank" style="color: #66ccff; text-decoration: underline;"> https://thl.fi/aiheet/elintavat-ja-ravitsemus/ravitsemus/terveellinen-ruokavalio</a></p>


    </div>
    </div>

  </div>
</section>




<!-- iso lajeja esittelevä neuboxi -->

<section class="container my-5">
  <div class="row">
    <div class="col-12">
      <div class="neu-box text-center py-5">

    <h2>Liikuntalajeja</h2>
    <p>Alla muutamia itselleni tärkeitä lajeja, joita harrastan tai olen harrastanut<br>
        Kuvia klikkaamalla pääset lajiliittojen sivuille</p>

    <div class="row g-4 mt-4">

      <!-- salibandy -->
      <div class="col-md-4">
        <div class="lajikortti">
          <a href="https://salibandy.fi/fi/etusivu/" target="_blank">
            <img src="https://images.ctfassets.net/0yf82hjfqumz/AVEkjGF7CSAKsGmCakKuA/35616cb43190acee4fd777a630808027/87d7b1d8-196a-46f3-bb7d-aa6be4f78fee.jpg?fit=fill&fm=webp&h=900&q=75&w=1600" alt="salibandy" class="lajikuvat">
          </a>
          <h4>Salibandy</h4>
          <p>Olen pelannut salibandya 15 vuotiaasta lähtien, lisenssin alaisia kausia noin 20. A-junioireiden 1-divisioonasta aikuisten 3-5 divisioona tasoille.</p>
        </div>
      </div>

      <!-- padel -->
      <div class="col-md-4">
        <div class="lajikortti">
          <a href="https://padel.fi/" target="_blank">
            <img src="https://www.superpadel.fi/wp-content/uploads/2021/06/racket-6308994_1920.jpg" alt="padel" class="lajikuvat">
          </a>
          <h4>Padel</h4>
          <p>Padelia olen pelannut noin 2020 vuodesta lähtien 1-2 kertaa viikossa.</p>
        </div>
      </div>

      <!-- Jääkiekko -->
      <div class="col-md-4">
        <div class="lajikortti">
          <a href="https://www.finhockey.fi/" target="_blank">
            <img src="https://t4.ftcdn.net/jpg/00/82/70/97/240_F_82709766_w6GESN7czdExXi83LIgy3Ii3LTbjFHW1.jpg" alt="jaakiekko" class="lajikuvat">
          </a>
          <h4>Jääkiekko</h4>
          <p>Jääkiekkoa pelasin 7 vuotiaasta lähtien 7 vuoden ajan maalivahtina.</p>
        </div>
      </div>
      <p>Lajitaustastani hieman tarkemmin vielä Taidot/kiinnostuksen kohteet sivulla</p>
      <a href="taidot.html" class="btn">Taidot/kiinnostuksen kohteet</a>
    </div>

  </div>
</div>
</section>

 

<!-- footer -->
  <footer class="bg-black text-white text-center py-4">
    <p class="mb-0">© 2025 Joonas Eskelinen</p><br>
    <a href="mailto:joonas_eskelinen@hotmail.com" class="btn">Sähköposti</a>
    <a href="https://github.com/JoonasEskelinen" class="btn">GitHub</a>
  </footer>

  </body>
  </html>