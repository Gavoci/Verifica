<!DOCTYPE html>
<html>
<head>
    <title>Elenco Assicuratori e Totale Premi Pagati per Tipo di Polizza e Anno</title>
</head>
<body>
    <h2>Elenco Assicuratori e Totale Premi Pagati per Tipo di Polizza e Anno</h2>
    <?php
    // Connessione al database
    $conn = new mysqli("localhost", "root", "", "verifica");

    // Verifica della connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Recupero dei parametri codice e anno dalla query string
    $codice = $_GET['codice'];
    $anno = $_GET['anno'];

    // Query per ottenere l'elenco degli assicuratori e il totale dei premi pagati per il tipo di polizza e l'anno specificati
    $query = "SELECT assicuratori.nominativo, SUM(premi_annuali_pagati.importo) AS totale_premi
              FROM contratti_di_assicurazione
              INNER JOIN premi_annuali_pagati ON contratti_di_assicurazione.codice_contratto = premi_annuali_pagati.codice_contratto
              INNER JOIN assicuratori ON contratti_di_assicurazione.codice_assicuratore = assicuratori.codice
              WHERE contratti_di_assicurazione.codice_tipo_polizza = $codice AND premi_annuali_pagati.anno = $anno
              GROUP BY assicuratori.nominativo";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Output dei risultati
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["nominativo"] . " - Totale premi pagati: " . $row["totale_premi"] . " Euro</li>";
        }
        echo "</ul>";
    } else {
        echo "Nessun risultato trovato";
    }

    // Chiusura della connessione
    $conn->close();
    ?>
</body>
</html>
