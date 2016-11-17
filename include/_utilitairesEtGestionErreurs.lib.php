<?php
function dateFr($date){
return strftime('%d/%m/%Y',strtotime($date));
}
function dateEn($date){
    return strftime('%Y-%m-%d',strtotime($date));
}
function divert($date){
    $dbh=connect();
    $mois= substr($date, -2);
    $annee= substr($date,0,4);
    $system= obtenirLibelleMois($mois);
    $mois=$system;
    $resu= $mois." ".$annee;
    return $resu;
    
}

function obtenirLibelleMois($mois){
    switch($mois){
        case(01):
            $resu="Janvier";
            break;
        case(02):
            $resu="Février";
            break;
        case(03):
            $resu="Mars";
            break;
        case(04):
           $resu="Avril";
            break;
        case(05):
            $resu="Mai";
            break;
        case(06):
            $resu="Juin";
            break;
        case(07):
            $resu="Juillet";
            break;
        case(08):
            $resu="Août";
            break;
        case(09):
            $resu="Septembre";
            break;
        case(10):
            $resu="Octobre";
            break;
        case(11):
            $resu="Novembre";
            break;
        case(12):
            $resu="Décembre";
            break;
        default:
            $resu="";
            break;
        
    }
    return $resu;
}
function divert2($date){
    $mois= substr($date, -2);
    $annee= substr($date,0,4);
    $resu= $annee."-".$mois;
    return $resu;
    
}
function divert3($date){
    $mois= substr($date, -2);
    $annee= substr($date,0,4);
    $resu= $annee.$mois;
    return $resu;
    
}
function ajouterMois($date){
    $dbh=connect();
    $ladate=divert2($date);
    $mois=date('Y-m',strtotime('+1 month',strtotime($ladate)));
    $convert=divert3($mois);
    return $convert;

}
function datemois($date){
return strftime('%d %B %Y',strtotime($date));
}
