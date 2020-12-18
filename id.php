<!--
@author L. S. D. Kidd
-->
<?php
session_start();
// $L1 = 'IDFRABERTHIER<<<<<<<<<<<<<<<<<752085';
// $L2 = '94099231028454CORRINE<<<<<<6512068F4';

$L1 = 'IDFRAGUILLERON<<<<<<<<<<<<<<<<056018';
$L2 = '1907563563650CHARLOTTE<<MAR9704080F8';

// $L1 = 'IDFRALIGNE<<<<<<<<<<<<<<<<<<<<291096';
// $L2 = '1609291010218MARIA<<MICHELL9307115F1';


$D1 = "2020-12-12";
$D2 = "2022-10-13";

date_default_timezone_set('GMT');
$mrz = str_split($L1 . $L2);


// toutes les fonctions suivantes retournent les valeurs du MRZ selon leur utilité
function id($t) {
    $ID = str_split($t);
    return $ID[0] . $ID[1];
}

function origin($t) {
    $origin = str_split($t);
    return $origin[2] . $origin[3] . $origin[4];
}

function nom($t) {
    $nom = str_split($t);
    $i = 5;
    $result = '';
    while ($nom[$i] != '<' && $i < 29) {
        $result .= $nom[$i];
        $i++;
    }
    return $result;
}

function emetteur($t) {
    $emet = str_split($t);
    return $emet[30] . $emet[31] . $emet[32] . $emet[33] . $emet[34] . $emet[35];
}

function noTitre($t) {
    $no = str_split($t);
    return $no[0] . $no[1] . $no[2] . $no[3] . $no[4] . $no[5] . $no[6] . $no[7] . $no[8] . $no[9] . $no[10] . $no[11];
}

function key1($t) {
    $key = str_split($t);
    return $key[13];
}

function prenom($t) {
    $prenom = str_split($t);
    $i = 14;
    $result = '';
    while ($prenom[$i] != '<' && $i < 26) {
        $result .= $prenom[$i];
        $i++;
    }
    return $result;
}

function naisssance($t) {
    $date = str_split($t);
    return $date[27] . $date[28] . $date[29] . $date[30] . $date[31] . $date[32];
}

function key2($t) {
    $key = str_split($t);
    return $key[33];
}

function sex($t) {
    $sex = str_split($t);
    return $sex[34];
}

function key3($t) {
    $key = str_split($t);
    return $key[35];
}

// retourne le premier caractere d'une string 
function getFirstChar($t) {

    $char = substr($t, -strlen($t), 1);
    return $char;
}

// retourne le dernier caractere d'une string
function getLastChar($t) {
    $char = substr($t, -1);
    return $char;
}

//permet d'obtenir le jour et de valider par rapport a la date de validité de la carte au jour et dans 3 mois 


//version test à garder pour plus tard, elle ne fait rien pour le moment
function dateCheck() {

    $today = date_create_from_format("Y-m-d","2020-12-12");
    $testdate = date_create_from_format("Y-m-d","2022-10-13");

    $interval = date_diff($today, $testdate);

    return $interval;
}


function dateCheck2($t){
$now = time();
$date2 = strtotime($t);
$diff = abs($now - $date2);
if ($diff < 7890000)
echo 'erreur, carte périmée';
else return $diff;
}
echo dateCheck2($D2);

// valide si la cle de securité est correcte :true
function vKey($a, $b) {
    $key = getLastChar(checkKeySum($a));
    $code = getLastChar($b);

    if ($key == $code) {
        return true;
    } else {
        return false;
    }
}

//Verifie key3, permet de faire une verification de la clé de sécurité 3
function checkKeySum($t) {
    $code = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $c = 0;
    $v1;
    $v2;
    $v3;

    for ($i = 0; $i < count($t); $i = $i + 3) {



        if ($i < 69) {
            if ($t[$i] == "<") {
                $v1 = 0;
            }
            if ($t[$i + 1] == "<") {
                $v2 = 0;
            }
            if ($t[$i + 2] == "<") {
                $v3 = 0;
            }
            for ($j = 0; $j < count($code); $j++) {
                if ($code[$j] == $t[$i]) {
                    $v1 = $j;
                }
                if ($code[$j] == $t[$i + 1]) {
                    $v2 = $j;
                }
                if ($code[$j] == $t[$i + 2]) {
                    $v3 = $j;
                }
            }
            $c += $v1 * 7 + $v2 * 3 + $v3;
        } else {
            if ($t[$i] == "<") {
                $v1 = 0;
            }
            if ($t[$i + 1] == "<") {
                $v2 = 0;
            }

            for ($j = 0; $j < count($code); $j++) {
                if ($code[$j] == $t[$i]) {
                    $v1 = $j;
                }
                if ($code[$j] == $t[$i + 1]) {
                    $v2 = $j;
                }
            }
            $c += $v1 * 7 + $v2 * 3;
        }
    }

    return $c;
}
