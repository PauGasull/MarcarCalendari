<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rebuda les seleccions</title>
</head>

<body>
    <?php
    // Comprovem si s'ha enviat la selecció de dies
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['seleccionsJSON'])) {
        // Decodifiquem el JSON enviat
        $seleccions = json_decode($_POST['seleccionsJSON'], true);

        // Comprovem si la deserialització ha estat correcta
        if ($seleccions === null) {
            echo "Error en deserialitzar el JSON.";
        } else {
            // Ordenem les dates seleccionades
            ksort($seleccions);

            // Llista de mesos en català
            $mesos = [
                1 => 'Gener', 2 => 'Febrer', 3 => 'Març', 4 => 'Abril', 5 => 'Maig', 6 => 'Juny',
                7 => 'Juliol', 8 => 'Agost', 9 => 'Setembre', 10 => 'Octubre', 11 => 'Novembre', 12 => 'Desembre'
            ];

            // Mostrem la llista de dies seleccionats
            echo "<h3>Díes seleccionats:</h3>";
            echo "<ul>";

            foreach ($seleccions as $data => $seleccionat) {
                if ($seleccionat) {
                    // Convertimr la data en format d, m, Y
                    $timestamp = strtotime($data);
                    $dia = date('d', $timestamp);
                    $mes = date('n', $timestamp);
                    $any = date('Y', $timestamp);

                    // Mostrem la data en el format desitjat
                    echo "<li>$dia de {$mesos[$mes]} del $any</li>";
                }
            }

            echo "</ul>";
        }
    } else {
        echo "No s'han enviat dades.";
    }
    ?>
</body>

</html>
