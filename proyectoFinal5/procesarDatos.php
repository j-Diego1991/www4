<?php

function crear_frecuencias($path_archivo)
{
    $handle = fopen($path_archivo, 'r');

    $clases = array(
        'ninguna' => 0,
        'una' => 1,
        'dos' => 2,
        'tres' => 3,
        'cuatro' => 4,
        'cinco' => 5
    );

    while(!feof($handle)) {
        $temp = trim(fgets($handle));

        if ($temp == '0'){
            $clases['ninguna'] += 1;
        } elseif ($temp == '1'){
            $clases['una'] += 1;
        } elseif ($temp == '2'){
            $clases['dos'] += 1;
        } elseif ($temp == '3'){
            $clases['tres'] += 1;
        } elseif ($temp == '4'){
            $clases['cuatro'] +=1;
        } elseif ($temp == '5'){
            $clases['cinco'] += 1;
        }
        
    }
    fclose($handle);
    return $clases;
}

function crear_json($path_archivoJSON, $arreglo_clases)
{
    $handle = fopen($path_archivoJSON, 'w');

    $clases_json = json_encode($arreglo_clases);

    fwrite($handle, $clases_json);

    fclose($handle);
    return $clases_json;
}