<!DOCTYPE html>
<html>
<head>
    <title>Elenco Assicurati per Tipo di Polizza</title>
</head>
<body>
    <h2>Elenco Assicurati per Tipo di Polizza</h2>
    <?php
    // Connessione al database
    $conn = new mysqli("localhost", "root", "", "verifica");

    // Verifica della connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Recupero del parametro codice dalla query string
    $codice = $_GET['codice'];

    // Query per ottenere l'elenco degli assicurati per il tipo di polizza specificato
    $query = "SELECT assicurati.nome, assicuratori.nominativo
              FROM contratti_di_assicurazione
              INNER JOIN assicuratori ON contratti_di_assicurazione.codice_assicuratore = assicuratori.codice
              INNER JOIN assicurati ON contratti_di_assicurazione.codice_anagrafica = assicurati.codice_anagrafica
              WHERE contratti_di_assicurazione.codice_tipo_polizza = $codice
              ORDER BY assicurati.nome";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Output dei risultati
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["nome"] . " - Assicuratore: " . $row["nominativo"] . "</li>";
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
