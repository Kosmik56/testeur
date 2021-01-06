<!--
@author L. S. D. Kidd
-->

<?php
session_start();
// le header sert pour les tests, a retirer plus tard 
//header("refresh: 3;");
date_default_timezone_set('GMT');

$L1 = "P<GBRKIDD<<LEWIS<STUART<<<<<<<<<<<<<<<<<<<<<";
$L2 = "5601187549GBR9710131M2910024<<<<<<<<<<<<<<06";

function id($t) {
    $ID = str_split($t);
    return $ID[0] . $ID[1];
}

function country($t) {
    $country = str_split($t);
    return $country[2] . $country[3] . $country[4];
}
//TODO n'imprime que le premier nom, pas le reste. Il faut voir comment separer les noms des prenoms.
function nom($t) {
    $nom = str_split($t);
    $i = 5;
    $result = '';
    while ($nom[$i] != '<' && $i < 44) {
        $result .= $nom[$i];
        $i++;
    }
    return $result;
}

function titleNumber($t) {
    $no = str_split($t);
    return $no[0] . $no[1] . $no[2] . $no[3] . $no[4] . $no[5] . $no[6] . $no[7] . $no[8];
}

function key1($t) {
    $key = str_split($t);
    return $key[9];
}

function nationality($t) {
    $country = str_split($t);
    return $country[10] . $country[11] . $country[12];
}

function birthDate($t) {
    $date = str_split($t);
    return $date[13] . $date[14] . $date[15] . $date[16] . $date[17] . $date[18];
}

function key2($t) {
    $key = str_split($t);
    return $key[19];
}

function sex($t) {
    $sex = str_split($t);
    return $sex[20];
}

//TODO pour l'instant imprime bêtement les valeurs, il faut extraire cette information pour la manipuler 
function validity($t) {
    $validity = str_split($t);
    return $validity[21] . $validity[22] . $validity[23] . $validity[24] . $validity[25] . $validity[26];
}

function key3($t) {
    $key = str_split($t);
    return $key[27];
}
//TODO ce truc est à revoir, il ne fait pas ce que je voudrai car je n'arrive pas a extraine la string vide
function optional($t) {
    $no = str_split($t);
    $i = 28;
    $result = '';
    while ($no[$i] != '<' && $i < 41) {
        $result .= $no[$i];
        $i++;
    }
    return $result;
}

function key4($t) {
    $key = str_split($t);
    return $key[42];
}

function finalKey($t) {
    $key = str_split($t);
    return $key[43];
}
//TODO trouver comment fonctionne les clés des MRZ de passeport, scrognotte
echo key3($L2);
?>