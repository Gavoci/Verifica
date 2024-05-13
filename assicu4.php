<!DOCTYPE html>
<html>
<head>
    <title>Elenco Importi Pagati per Tipo di Polizza e Assicurato</title>
</head>
<body>
    <h2>Elenco Importi Pagati per Tipo di Polizza e Assicurato</h2>
    <?php
    // Connessione al database
    $conn = new mysqli("localhost", "root", "", "verifica");

    // Verifica della connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Recupero dei parametri codice e assicurato dalla query string
    $codice = $_GET['codice'];
    $assicurato = $_GET['assicurato'];

    // Query per ottenere l'elenco degli importi pagati per il tipo di polizza e l'assicurato specificati
    $query = "SELECT premi_annuali_pagati.anno, premi_annuali_pagati.importo
              FROM contratti_di_assicurazione
              INNER JOIN premi_annuali_pagati ON contratti_di_assicurazione.codice_contratto = premi_annuali_pagati.codice_contratto
              INNER JOIN assicurati ON contratti_di_assicurazione.codice_anagrafica = assicurati.codice_anagrafica
              WHERE contratti_di_assicurazione.codice_tipo_polizza = $codice AND assicurati.nome = '$assicurato'
              ORDER BY premi_annuali_pagati.anno";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Output dei risultati
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>Anno: " . $row["anno"] . " - Importo: " . $row["importo"] . " Euro</li>";
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
