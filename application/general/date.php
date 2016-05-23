<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 29/02/2016
 * Time: 23:20
 */

namespace App\general;


use DateTime;

class date
{
    /**
     * @param $date // Prend en Parametre la date au format d-m-Y
     * @return int // retourne le resultat en format entier time()
     */
    public function format_strt($date)
    {
        date_default_timezone_set('Europe/Paris');
        return strtotime($date);
    }

    /**
     * @param $format // Prend en paramêtre la date au format choisie |ex: d-m-Y H:i ou d/m/Y
     * @param $strtotime // Prend en paramêtre la date au format strtotime entier time()
     * @return bool|string // Retourne la date au format choisie en paramêtre
     */
    public function formatage($format, $strtotime)
    {
        return date($format, $strtotime);
    }

    /**
     * @param $jour // Prend le jour au format time()
     * @param $mois // Prend le mois au format time()
     * @param $annee // Prend l'année au format time()
     * @return string // Retourne la date au format j d m y | ex: Lundi 04 Janvier 2016
     */
    public function formatage_long($strtotime)
    {
        $j = date("N", $strtotime);
        $m = date("n", $strtotime);
        $y = date("Y", $strtotime);

        $dj = date("d", $strtotime);

        switch($j)
        {
            case 1: $data_jour = "Lundi"; break;
            case 2: $data_jour = "Mardi"; break;
            case 3: $data_jour = "Mercredi"; break;
            case 4: $data_jour = "Jeudi"; break;
            case 5: $data_jour = "Vendredi"; break;
            case 6: $data_jour = "Samedi"; break;
            case 7: $data_jour = "Dimanche"; break;
        }

        switch($m)
        {
            case 1: $data_mois = "Janvier"; break;
            case 2: $data_mois = "Février"; break;
            case 3: $data_mois = "Mars"; break;
            case 4: $data_mois = "Avril"; break;
            case 5: $data_mois = "Mai"; break;
            case 6: $data_mois = "Juin"; break;
            case 7: $data_mois = "Juillet"; break;
            case 8: $data_mois = "Aout"; break;
            case 9: $data_mois = "Septembre"; break;
            case 10: $data_mois = "Octobre"; break;
            case 11: $data_mois = "Novembre"; break;
            case 12: $data_mois = "Décembre"; break;
        }

        return $data_jour." ".$dj." ".$data_mois." ".$y;
    }

    /**
     * @param $format // Formatage de la date au format soouhaiter| d ou m
     * @param $strtotime // Date au format strtotime
     * @return bool|string // Retourne la date au formatage général
     */
    public function formatage_sequenciel($format, $strtotime)
    {
        if($format == "d"){
            $d = date("N", $strtotime);
            switch($d)
            {
                case 1: $data_jour = "Lundi"; break;
                case 2: $data_jour = "Mardi"; break;
                case 3: $data_jour = "Mercredi"; break;
                case 4: $data_jour = "Jeudi"; break;
                case 5: $data_jour = "Vendredi"; break;
                case 6: $data_jour = "Samedi"; break;
                case 7: $data_jour = "Dimanche"; break;
            }
            return $data_jour;
        }elseif($format == "m"){
            $m = date("n", $strtotime);
            switch($m)
            {
                case 1: $data_mois = "Janvier"; break;
                case 2: $data_mois = "Février"; break;
                case 3: $data_mois = "Mars"; break;
                case 4: $data_mois = "Avril"; break;
                case 5: $data_mois = "Mai"; break;
                case 6: $data_mois = "Juin"; break;
                case 7: $data_mois = "Juillet"; break;
                case 8: $data_mois = "Aout"; break;
                case 9: $data_mois = "Septembre"; break;
                case 10: $data_mois = "Octobre"; break;
                case 11: $data_mois = "Novembre"; break;
                case 12: $data_mois = "Décembre"; break;
            }
            return $data_mois;
        }else{
            return false;
        }
    }
    public function formatage_sequenciel_no_str($format)
    {
        if($format == "d"){
            $d = date("N");
            switch($d)
            {
                case 1: $data_jour = "Lundi"; break;
                case 2: $data_jour = "Mardi"; break;
                case 3: $data_jour = "Mercredi"; break;
                case 4: $data_jour = "Jeudi"; break;
                case 5: $data_jour = "Vendredi"; break;
                case 6: $data_jour = "Samedi"; break;
                case 7: $data_jour = "Dimanche"; break;
            }
            return $data_jour;
        }elseif($format == "m"){
            $m = date("n");
            switch($m)
            {
                case 1: $data_mois = "Janvier"; break;
                case 2: $data_mois = "Février"; break;
                case 3: $data_mois = "Mars"; break;
                case 4: $data_mois = "Avril"; break;
                case 5: $data_mois = "Mai"; break;
                case 6: $data_mois = "Juin"; break;
                case 7: $data_mois = "Juillet"; break;
                case 8: $data_mois = "Aout"; break;
                case 9: $data_mois = "Septembre"; break;
                case 10: $data_mois = "Octobre"; break;
                case 11: $data_mois = "Novembre"; break;
                case 12: $data_mois = "Décembre"; break;
            }
            return $data_mois;
        }else{
            return false;
        }
    }
    /**
     * @param $date // Date au format standard de date (d-m-Y) ou autre
     * @return string // Il retourne le moment décompter par différence (il y a...)
     */
    public function format($date)
    {
        $date_a_comparer = new DateTime($date);
        $date_actuelle = new DateTime("now");

        $intervalle = $date_a_comparer->diff($date_actuelle);

        if ($date_a_comparer > $date_actuelle)
        {
            $prefixe = 'dans ';
        }
        else
        {
            $prefixe = 'il y a ';
        }

        $ans = $intervalle->format('%y');
        $mois = $intervalle->format('%m');
        $jours = $intervalle->format('%d');
        $heures = $intervalle->format('%h');
        $minutes = $intervalle->format('%i');
        $secondes = $intervalle->format('%s');

        if ($ans != 0)
        {
            $relative_date = $prefixe . $ans . ' an' . (($ans > 1) ? 's' : '');
            if ($mois >= 6) $relative_date .= ' et demi';
        }
        elseif ($mois != 0)
        {
            $relative_date = $prefixe . $mois . ' mois';
            if ($jours >= 15) $relative_date .= ' et demi';
        }
        elseif ($jours != 0)
        {
            $relative_date = $prefixe . $jours . ' jour' . (($jours > 1) ? 's' : '');
        }
        elseif ($heures != 0)
        {
            $relative_date = $prefixe . $heures . ' heure' . (($heures > 1) ? 's' : '');
        }
        elseif ($minutes != 0)
        {
            $relative_date = $prefixe . $minutes . ' minute' . (($minutes > 1) ? 's' : '');
        }
        else
        {
            $relative_date = $prefixe . ' quelques secondes';
        }

        return $relative_date;
    }

    /**
     * @return int //Cette fonction retourne la date au format strtotime (jour d'appel)
     */
    public function date_jour_strt()
    {
        return strtotime(date("d-m-Y"));
    }

    public function date_jourheure_strt(){
        return strtotime(date("d-m-Y H:i:s"));
    }

    public function semaine($annee, $semaine)
    {
        $date_format = new date();

        $lundi = new DateTime();
        $lundi->setISODate($annee, $semaine);

        $dimanche = new DateTime();
        $dimanche->setISODate($annee, $semaine);
        date_modify($dimanche, '+4 days');

        $format_lundi = $lundi->format("d-m-y");
        $format_dimanche = $dimanche->format("d-m-y");

        $strt_lundi = $date_format->format_strt($format_lundi);
        $strt_dimanche = $date_format->format_strt($format_dimanche);

        $day_lundi = $lundi->format("d");
        $day_dimanche = $dimanche->format("d");
        $mois_lundi = $date_format->formatage_sequenciel("m", $strt_lundi);
        $mois_dimanche = $date_format->formatage_sequenciel("m", $strt_dimanche);

        $format = "Du ".$day_lundi." ".$mois_lundi." au ".$day_dimanche." ".$mois_dimanche." ".date("Y");
        return $format;


    }

    public function semaine_strt($annee, $semaine)
    {
        $date_format = new date();
        $lundi = new DateTime();
        $lundi->setISODate($annee, $semaine);

        $vendredi = new DateTime();
        $vendredi->setISODate($annee, $semaine);
        date_modify($vendredi, '+4 days');

        $format_lundi = $lundi->format("d-m-Y");
        $format_vendredi = $vendredi->format("d-m-Y");

        $strt_lundi = $date_format->format_strt($format_lundi);
        $strt_vendredi = $date_format->format_strt($format_vendredi);

        return array(
            "strt_lundi" => $strt_lundi,
            "strt_vendredi" => $strt_vendredi
        );
    }

    public function month_strt()
    {
        $date_format = new date();
        $debut_mois = $date_format->format_strt(date("01-m-Y"));
        $fin_mois = $date_format->format_strt(date("31-m-Y"));

        return array("debut_mois" => $debut_mois, "fin_mois" => $fin_mois);

    }

    /**
     * @param $strtotime //Date au format strtotime
     * @return float // Retourne la valeur différentielle de jour restant en format strtotime
     */
    public function reste($strtotime)
    {
        $diff = $strtotime - time();
        return round($diff / 86400, 0);
    }

    public function ech_1($date_actu)
    {
        $seven = 86400;
        $sm = $date_actu + $seven;
        return $sm;
    }
    public function ech_7($date_actu){
        $seven = 518400;
        $sm = $date_actu + $seven;
        return $sm;
    }
    public function ech_15($date_actu){
        $seven = 1209600;
        $sm = $date_actu + $seven;
        return $sm;
    }
    public function ech_30($date_actu){
        $seven = 2505600;
        $sm = $date_actu + $seven;
        return $sm;
    }
    public function ech_60($date_actu){
        $seven = 5011200;
        $sm = $date_actu + $seven;
        return $sm;
    }
    public function ech_90($date_actu)
    {
        $seven = 7689600;
        $sm = $date_actu + $seven;
        return $sm;
    }
    public function ech_150($date_actu)
    {
        $seven = 15552000;
        $sm = $date_actu + $seven;
        return $sm;
    }
    public function ech_365($date_actu)
    {
        $seven = 31449600;
        $sm = $date_actu + $seven;
        return $sm;
    }


}