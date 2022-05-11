<!--
@author L. S. D. Kidd
-->
<?php
session_start();

// TODO Le header ici sert juste de test, a supprimer 
header("refresh: 5;");

date_default_timezone_set('GMT');

$L1 = $_GET[line1];
$L2 = $_GET[line2];
//$L3 = "MARTIN<<CHRISTELLE<HELENE<<<<<";

$mrz = $L1 . $L2;

//L1
function id($t) {
    $ID = str_split($t);
    return $ID[0] . $ID[1];
}

function country($t) {
    $country = str_split($t);
    return $country[2] . $country[3] . $country[4];
}

function numeroCarte($t) {
    $no = str_split($t);
    return $no[5] . $no[6] . $no[7] . $no[8] . $no[9] . $no[10] . $no[11] . $no[12] . $no[13];
}

function keyNumeroCarte($t) {
    $key = str_split($t);
    return $key[14];
}

function numeroEtranger($t) {
    $no = str_split($t);
    return $no[15] . $no[16] . $no[17] . $no[18] . $no[19] . $no[20] . $no[21] . $no[22] . $no[23] . $no[24] . $no[25] . $no[26] . $no[27] . $no[28] . $no[29];
}

//L2

function birthday($t) {
    $jour = str_split($t);
    return $jour[0] . $jour[1] . $jour[2] . $jour[3] . $jour[4] . $jour[5];
}

function birthdayKey($t) {
    $key = str_split($t);
    return $key[6];
}

function sex($t) {
    $sex = str_split($t);
    return $sex[7];
}

function validity($t) {
    $v = str_split($t);
    return $v[8] . $v[9] . $v[10] . $v[11] . $v[12] . $v[13];
}

function keyValidity($t) {
    $key = str_split($t);
    return $key[14];
}

function nationality($t) {
    $nat = str_split($t);
    return $nat[15] . $nat[16] . $nat[17];
}

function optional($t) {
    $opt = str_split($t);
    return $opt[18] . $opt[19] . $opt[20] . $opt[21] . $opt[22] . $opt[23] . $opt[24] . $opt[25] . $opt[26] . $opt[27] . $opt[28];
}

function keyFinal($t) {
    $key = str_split($t);
    return $key[29];
}

// le nom et prenom se situent sur la ligne 3
function nom($t) {
    $nom = str_split($t);
    $i = 0;
    $result = '';
    while ($nom[$i] != '<' && $i < 30) {
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

function checkNumberKey($t) {
    $code = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $c = 0;
    $v1;
    $v2;
    $v3;

    for ($i = 6; $i < 14; $i = $i + 3) {

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
		echo $c . ' ';
    }
    return $c % 10;
}


function checkDateKey($t) {
    $date = str_split($t);
    $code = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $c = 0;
    $v1;
    $v2;
    $v3;
    for ($i = 0; $i < 5; $i = $i + 3) {

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
    for ($i = 8; $i < 13; $i = $i + 3) {

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

    for ($i = 0; $i < 59; $i = $i + 3) {
        if ($mrz[$i] == "<") {
            $v1 = 0;
        }
        if ($i + 1 < 58 && $mrz[$i + 1] == "<") {
            $v2 = 0;
        }
        if ($i + 2 < 58 && $mrz[$i + 2] == "<") {
            $v3 = 0;
        }
        for ($j = 0; $j < count($code); $j++) {
            if ($code[$j] == $mrz[$i]) {
                $v1 = $j;
            }
            if ($i + 1 < 58 && $code[$j] == $mrz[$i + 1]) {
                $v2 = $j;
            }
            if ($i + 2 < 58 && $code[$j] == $mrz[$i + 2]) {
                $v3 = $j;
            }
        }

        $c += $v1 * 7 + $v2 * 3 + $v3;
		echo $c . ' ';
    }
    return $c % 10;
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