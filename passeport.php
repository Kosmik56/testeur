<!--
@author L. S. D. Kidd
-->
<?php
session_start();
// le header sert pour les tests, a retirer plus tard 
//header("refresh: 3;");
date_default_timezone_set('GMT');

$L1 = $_GET[line1];
$L2 = $_GET[line2];



$mrz = $L1 . $L2;

function checkDateKey($t) {
    $date = str_split($t);
    $code = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $c = 0;
    $v1;
    $v2;
    $v3;
    for ($i = 21; $i < 27; $i = $i + 3) {

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
    }
    return $c % 10;
}

function checkNumberKey($t) {
    $code = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $c = 0;
    $v1;
    $v2;
    $v3;

    for ($i = 0; $i < 9; $i = $i + 3) {

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
    }
    return $c % 10;
}

function checkBirthKey($t) {
    $date = str_split($t);
    $code = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $c = 0;
    $v1;
    $v2;
    $v3;
    for ($i = 13; $i < 19; $i = $i + 3) {

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
    }
    return $c % 10;
}

function checkKeySum($t) {
    $mrz = str_split($t);
    $code = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $c = 0;
    $v1;
    $v2;
    $v3;

    for ($i = 0; $i < 38; $i = $i + 3) {
        if ($mrz[$i] == "<") {
            $v1 = 0;
        }
        if ($i + 1 < 43 && $mrz[$i + 1] == "<") {
            $v2 = 0;
        }
        if ($i + 2 < 43 && $mrz[$i + 2] == "<") {
            $v3 = 0;
        }
        for ($j = 0; $j < count($code); $j++) {
            if ($code[$j] == $mrz[$i]) {
                $v1 = $j;
            }
            if ($i + 1 < 43 && $code[$j] == $mrz[$i + 1]) {
                $v2 = $j;
            }
            if ($i + 2 < 43 && $code[$j] == $mrz[$i + 2]) {
                $v3 = $j;
            }
        }

        $c += $v1 * 7 + $v2 * 3 + $v3;
    }
    return $c % 10;
}

// retourne le dernier caractere d'une string
function getLastChar($t) {
    $char = substr($t, -1);
    return $char;
}

function id($t) {
    $ID = str_split($t);
    return $ID[0] . $ID[1];
}

function country($t) {
    $country = str_split($t);
    return $country[2] . $country[3] . $country[4];
}

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

function prenoms($t) {
    $nom = str_split($t);
    $result = '';
    $test = '';
    for ($i = 5; $i < 43; $i++) {
        $test = $nom[$i] . $nom[$i + 1];
        if ($test == '<<') {

            $j = $i + 2;
            $duo = $nom[$j] . $nom[$j + 1];
            while ($j < 43 && $duo != '<<') {
                $duo = $nom[$j] . $nom[$j + 1];
                $result .= $nom[$j];
                $j++;
            }
            $nom = str_split($result);
            $result = '';
            for ($u = 0; $u < count($nom); $u++) {
                if ($nom[$u] != '<') {
                    $result .= $nom[$u];
                } else
                    $result .= ' ';
            }
            return $result;
        }
    }
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

function date1($t) {
    $validity = str_split($t);
    return $validity[21] . $validity[22] . $validity[23] . $validity[24] . $validity[25] . $validity[26];
}

function key3($t) {
    $key = str_split($t);
    return $key[27];
}

//TODO ce truc est à revoir, il faut réussir a sortir que si le premier element est un < parce que sinon il y a des options 
function optional($t) {
    $no = str_split($t);
    return $no[28] . $no[29] . $no[30] . $no[31] . $no[32] . $no[33] . $no[34] . $no[35] . $no[36] . $no[37] . $no[38] . $no[39] . $no[40] . $no[41];
}

function key4($t) {
    $key = str_split($t);
    return $key[42];
}

function finalKey($t) {
    $key = str_split($t);
    return $key[43];
}

// Ne prend en compte que les elements necessaire pour la cle de verification sur la $L2. checkKeySum(passportCheck($L2));
function passportCheck($t) {

    $p = titleNumber($t) . key1($t) . birthDate($t) . key2($t) . date1($t) . key3($t) . optional($t) . key4($t);

    return $p;
}

function vPassportKey($a, $b) {
    $key = checkNumberKey($a);
    $code = $b;
    if ($key == $code) {
        return "yes";
    } else {
        return "no";
    }
}

function vBirthKey($a, $b) {
    $key = checkBirthKey($a);
    $code = $b;
    if ($key == $code) {
        return "yes";
    } else {
        return "no";
    }
}

function vDateKey($a, $b) {
    $key = checkDateKey($a);
    $code = $b;

    if ($key == $code) {
        return "yes";
    } else {
        return "no";
    }
}

// permet de transformer le temps en seconde en années, mois et jours. 
function secondsToTime($t) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$t");
    return $dtF->diff($dtT)->format('%y an(s), %m mois, %d jour(s)');
}

// verifie les 3 mois 
function dateCheck3M($t) {
    $now = time();
    $date2 = strtotime($t);
    $diff = abs($date2 - $now);
    if ($diff < 7862400) {
        echo 'périmée <br>';
        return $diff;
    } else {
        echo 'valide <br>';
        return $diff;
    }
}

// verifie les 6 mois 
function dateCheck6M($t) {
    $now = time();
    $date2 = strtotime($t);
    $diff = abs($date2 - $now);
    if ($diff < 15638400) {
        echo 'périmée <br>';
        return $diff;
    } else {
        echo 'valide <br>';
        return $diff;
    }
}

//verifie si la carte est valide aujourd'hui
function dateCheckToday($t) {
    $now = time();
    $date2 = strtotime($t);
    $diff = $date2 - $now;
    if ($diff < 0) {
        echo 'périmée <br>';
        return $diff;
    } else {
        echo 'valide <br>';
        return $diff;
    }
}

// calcul si le voyage est possible au bout de 3 mois 
function dateCheckVoyage($y, $t) {
    $date2 = strtotime($t);
    $voyage = strtotime($y);
    $diff = $date2 - $voyage;
    if ($diff < 7948800) {
        echo 'périmée <br>';
        return $diff;
    } else {
        echo 'valide <br>';
        return $diff;
    }
}