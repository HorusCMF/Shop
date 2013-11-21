<?php

namespace Horus\SiteBundle\Extension\Twig;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Locale\Locale;

/**
 * Override Twig Engine
 * Class MyTwigExtension
 * @package MyFuckinJob\SiteBundle\Extension\Twig
 */
class MyTwigExtension extends \Twig_Extension
{

    /**
     * Get All Filters
     * @return type
     */
    public function getFilters()
    {
        return array(
            'sexe' => new \Twig_Filter_Method($this, 'sexe'),
            'formule' => new \Twig_Filter_Method($this, 'formule'),
            'disponibilite' => new \Twig_Filter_Method($this, 'disponibilite'),
            'actif' => new \Twig_Filter_Method($this, 'actif'),
            'extras' => new \Twig_Filter_Method($this, 'extras'),
            'filexist' => new \Twig_Filter_Method($this, 'file_exist'),
            'commat' => new \Twig_Filter_Method($this, 'split_commat'),
            'nbavis' => new \Twig_Filter_Method($this, 'nbavis'),
            'cuisine' => new \Twig_Filter_Method($this, 'cuisine'),
            'sizes' => new \Twig_Filter_Method($this, 'sizes'),
            'sizes2' => new \Twig_Filter_Method($this, 'sizes2'),
            'sizes3' => new \Twig_Filter_Method($this, 'sizes3'),
            'validate' => new \Twig_Filter_Method($this, 'validate'),
            'validateshort' => new \Twig_Filter_Method($this, 'validateshort'),
            'unserialize' => new \Twig_Filter_Method($this, 'unserialize'),
            'temperature' => new \Twig_Filter_Method($this, 'temperature'),
            'weather' => new \Twig_Filter_Method($this, 'weather'),
            'period' => new \Twig_Filter_Method($this, 'period'),
            'barcode' => new \Twig_Filter_Method($this, 'barcode'),
            'leftzero' => new \Twig_Filter_Method($this, 'leftzero'),
            'timestamp' => new \Twig_Filter_Method($this, 'timestamp'),
            'gendre' => new \Twig_Filter_Method($this, 'gendre'),
            'created_ago' => new \Twig_Filter_Method($this, 'createdAgo'),
            'begin_in' => new \Twig_Filter_Method($this, 'beginIn'),
            'readmore' => new \Twig_Filter_Method($this, 'ReadMore', array('is_safe' => array('html'))),
            'textNoteComment' => new \Twig_Filter_Method($this, 'textNoteComment'),
            'displayHour' => new \Twig_Filter_Method($this, 'displayHour'),
            'price' => new \Twig_Filter_Method($this, 'priceFilter'),
            'typeFormule' => new \Twig_Filter_Method($this, 'typeFormule'),
            'remise' => new \Twig_Filter_Method($this, 'remise'),
            'promotion' => new \Twig_Filter_Method($this, 'promotion'),
            'floor' => new \Twig_Filter_Method($this, 'displayFloor'),
            'readmore' => new \Twig_Filter_Method($this, 'ReadMore', array('is_safe' => array('html'))),
            'textNoteComment' => new \Twig_Filter_Method($this, 'textNoteComment'),
            'displayHour' => new \Twig_Filter_Method($this, 'displayHour'),
            'price' => new \Twig_Filter_Method($this, 'priceFilter'),
            'typeFormule' => new \Twig_Filter_Method($this, 'typeFormule'),
            'conditionstypes' => new \Twig_Filter_Method($this, 'conditionstypes'),
            'floor' => new \Twig_Filter_Method($this, 'displayFloor'),
            'date_period' => new \Twig_Filter_Method($this, 'date_period'),
            'isLundi' => new \Twig_Filter_Method($this, 'isLundi'),
            'isAfter' => new \Twig_Filter_Method($this, 'isAfter'),
            'tronqueMois' => new \Twig_Filter_Method($this, 'tronqueMois'),
            'removeAccents' => new \Twig_Filter_Method($this, 'removeAccents'),
            'json_decode' => new \Twig_Filter_Method($this, 'jsondecode'),
            'array_pop' => new \Twig_Filter_Method($this, 'arraypop'),
            'majusci' => new \Twig_Filter_Method($this, 'majusci'),
            'disponibilites' => new \Twig_Filter_Method($this, 'disponibilites'),
            'eval' => new \Twig_Filter_Method($this, 'evaluation'),
            'typemessage' => new \Twig_Filter_Method($this, 'typemessage'),
            'urldec' => new \Twig_Filter_Method($this, 'urldec'),
            'utf8encode' => new \Twig_Filter_Method($this, 'utf8encode'),
            'naturedoc' => new \Twig_Filter_Method($this, 'naturedoc'),
            'typesujets' => new \Twig_Filter_Method($this, 'typesujets'),
            'status' => new \Twig_Filter_Method($this, 'status'),
            'etudes' => new \Twig_Filter_Method($this, 'etudes'),
            'characters' => new \Twig_Filter_Method($this, 'characters')
        );
    }

    /*     * *************************************** All Filters Functions ************************************ */


    /**
     * @param null $expr
     * @return bool
     */
    public function evaluation($expr = null)
    {
        echo $expr;
        return true;
    }

    /**
     * @param null $expr
     * @return string
     */
    public function utf8encode($expr = null)
    {
        return utf8_encode($expr);
    }

    /**
     * @param null $expr
     * @return string
     */
    public function urldec($expr = null)
    {
        return urldecode($expr);
    }

    /**
     * @param $text
     * @return mixed
     */
    public function removeAccents($text)
    {
        $alphabet = array(
            'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
            'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
            'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
            'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
            'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
            'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
            'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f',
        );
        $text = strtr($text, $alphabet);
        $text = preg_replace('/\W+/', '-', $text); //slugify
        return $text;
    }

    /**
     * @param int $expr
     * @return string
     */
    public function naturedoc($expr = 1)
    {
        if ($expr == 0) {
            return 'Grille tarifaire';
        } elseif ($expr == 1) {
            return "Plaquette commerciale";
        } elseif ($expr == 2) {
            return 'Evenements';
        } elseif ($expr == 3) {
            return 'Conditions Générales';
        } elseif ($expr == 4) {
            return 'Avertissement';
        } elseif ($expr == 5) {
            return 'Conseils';
        } elseif ($expr == 6) {
            return 'Autre';
        } else {
            return "Autre";
        }
    }

    /**
     * @param array $expr
     * @return string
     */
    public function characters($expr = array())
    {
        if ($expr == 0) {
            return 'Flexible';
        } elseif ($expr == 1) {
            return "Ouvert d'esprit";
        } elseif ($expr == 2) {
            return 'Entrepreneur';
        } elseif ($expr == 3) {
            return 'Impatience';
        } elseif ($expr == 4) {
            return 'Lent';
        } elseif ($expr == 5) {
            return 'Emotif';
        } elseif ($expr == 6) {
            return 'Autre';
        } else {
            return "Autre";
        }
    }

    /**
     * @param int $expr
     * @return string
     */
    public function status($expr = 1)
    {

         if ($expr == 1) {
            return "Etudiant";
        } elseif ($expr == 2) {
            return 'Jeune Diplômé';
        } elseif ($expr == 3) {
            return 'Junior';
        } elseif ($expr == 4) {
            return 'Confirmé / Senior';
        } elseif ($expr == 5) {
            return "Responsable d'équipe";
        } elseif ($expr == 6) {
            return 'Responsable de Département';
        } else {
            return "Dirigeant/Entrepreneur";
        }
    }

    /**
     * @param int $expr
     * @return string
     */
    public function etudes($expr = 1)
    {

         if ($expr == 1) {
            return "Bac non validé";
        } elseif ($expr == 2) {
            return 'Lycée, Niveau Bac';
        } elseif ($expr == 3) {
            return 'Bac Professionnel, BEP, CAP';
        } elseif ($expr == 4) {
            return 'DUT, BTS, Bac + 2';
        } elseif ($expr == 5) {
            return "Diplôme non validé";
        } elseif ($expr == 6) {
            return 'Licence, Bac + 3';
        }elseif ($expr == 7) {
            return 'Maîtrise, IEP, IUP, Bac + 4';
        }elseif ($expr == 8) {
             return 'DESS, DEA, Grandes Ecoles, Bac + 5';
         }elseif ($expr == 9) {
             return 'Doctorat, 3ème cycle';
         }elseif ($expr == 10) {
             return 'Expert, Recherche';
         }
    }

    /**
     * @param int $expr
     * @return string
     */
    public function conditionstypes($expr = 1)
    {
        if ($expr == 0) {
            return 'Pour une partie acheté';
        } elseif ($expr == 1) {
            return 'Pour un mimimum de participants';
        } elseif ($expr == 2) {
            return "Pour un certain montant";
        }
        elseif ($expr == 3) {
            return "Pour une durée d'inscription";
        }
        elseif ($expr == 5) {
            return "Aucune condition requise";
        }
        elseif ($expr == 6) {
            return "Autre";
        }
        else {
            return "Autre";
        }
    }

    /**
     * @param int $expr
     * @return string
     */
    public function remise($expr = 1)
    {
        if ($expr == 0) {
            return 'Une partie offerte';
        } elseif ($expr == 1) {
            return 'Un bon de réduction';
        } elseif ($expr == 2) {
            return "Un bon d'achat";
        } elseif ($expr == 3) {
            return "Offre d'essai";
        } elseif ($expr == 4) {
            return "Réduction sur un abonnement";
        } else {
            return "Autre";
        }
    }

    /**
     * @param int $expr
     * @return string
     */
    public function promotion($expr = 1)
    {
        if ($expr == 0) {
            return 'Offre découverte à 25 €';
        } elseif ($expr == 1) {
            return 'Offre premium à 35 €';
        } elseif ($expr == 2) {
            return 'Offre gold à 60 €';
        } elseif ($expr == 3) {
            return 'Offre platine à 100 €';
        } else {
            return 'Offre découverte à 25 €';
        }
    }

    /**
     * @param int $expr
     * @return string
     */
    public function typesujets($expr = 1)
    {
        if ($expr == 0) {
            return 'Une question / Un renseignement ?';
        } elseif ($expr == 1) {
            return 'Mise à jour de mes coordonnées';
        } elseif ($expr == 2) {
            return "Demande de partenariat";
        }
        elseif ($expr == 4) {
            return "Devenir Partenaire";
        }
        elseif ($expr == 6) {
            return "Création d'une publicité";
        }
        elseif ($expr == 8) {
            return "Un problème technique";
        }
        else {
            return "Autre";
        }
    }

    /**
     * @param int $expr
     * @return string
     */
    public function typesujet($expr = 1)
    {
        if ($expr == 0) {
            return 'Un message quelquonque';
        } elseif ($expr == 1) {
            return 'Une demande de participation';
        } elseif ($expr == 2) {
            return "Une alerte d'évènement";
        } elseif ($expr == 3) {
            return "Un conseil d'ami";
        } else {
            return "Un nouveau message";
        }
    }

    /**
     * @param int $expr
     * @return string
     */
    public function typemessage($expr = 1)
    {
        if ($expr == 0) {
            return 'Un message quelquonque';
        } elseif ($expr == 1) {
            return 'Une demande de participation';
        } elseif ($expr == 2) {
            return "Une alerte d'évènement";
        } elseif ($expr == 3) {
            return "Un conseil d'ami";
        } else {
            return "Un nouveau message";
        }
    }

    /**
     * @param int $expr
     * @return string
     */
    public function actif($expr = 1)
    {
        if ($expr == 1) {
            return 'Activé';
        } else {
            return 'Désactivé';
        }
    }

    /**
     * @param int $expr
     * @return string
     */
    public function gendre($expr = 1)
    {
        if ($expr == 1) {
            return 'Mec';
        } else {
            return 'Nana';
        }
    }

    /**
     * @param bool $bool
     * @param null $entity
     * @param $id
     * @return string
     */
    public function validate($bool = false, $entity = null, $id)
    {
        $request = Request::createFromGlobals();
        $img = ($bool == true) ? "<a href='" . $request->getBaseUrl() . "/" . $entity . "/activation/" . $id . "/0'><i class='icon-ok'></i></a>" : "<a href='" . $request->getBaseUrl() . "/" . $entity . "/activation/" . $id . "/1'><i class='icon-remove'></i></a>";
        return $img;
    }

    /**
     * @param null $ch
     * @return string
     */
    public function majusci($ch = null)
    {
        return strtoupper($ch);
    }

    /**
     * @param bool $ch
     * @return string
     */
    public function leftzero($ch = false)
    {
        return str_pad($ch, 3, '0');
    }

    /**
     * @param bool $barcode
     * @return string
     */
    public function barcode($barcode = false)
    {
        $img = '<iframe src="http://chart.apis.google.com/chart?cht=qr&chs=150x150&chl=' . $barcode . '&chld=H|0"></iframe>';
        return $img;
    }

    /**
     * @param bool $bool
     * @return string
     */
    public function validateshort($bool = false)
    {
        $img = ($bool == true) ? "<i class='icon-ok'></i>" : "<i class='icon-remove'></i>";
        return $img;
    }

    /**
     * @param bool $date
     * @return string
     */
    public function timestamp($date = false)
    {
        $datin = new \Datetime($date);
        return $datin->format('d-m-Y');
    }

    /**
     * @param null $tab
     * @return mixed
     */
    public function unserialize($tab = null)
    {
        return unserialize($tab);
    }

    /**
     * @param array $tab
     * @return string
     */
    public function temperature($tab = array())
    {
        if (empty($tab))
            return '17';

        $weatherarray = unserialize($tab);

        if (!isset($weatherarray[0]) || !isset($weatherarray[0]['temp_C']))
            return '17';

        if (!empty($weatherarray))
            if (array_key_exists('temp_C', $weatherarray[0]))
                return $weatherarray[0]['temp_C'];

        return '17';
    }

    /**
     * @param array $tab
     * @return string
     */
    public function weather($tab = array())
    {
        if (empty($tab))
            return 'nuages';

        $weatherarray = unserialize($tab);
        if (!isset($weatherarray[0]) || !isset($weatherarray[0]['weatherDesc']) || !isset($weatherarray[0]['weatherDesc'][0]))
            return 'nuages';


        $weather = explode(" ", $weatherarray[0]['weatherDesc'][0]['value']);
        if (!empty($weather))
            foreach ($weather as $word) {

                if (trim($word) == 'thunder' || trim($word) == 'Thundery')
                    return 'thunder';

                if (trim($word) == 'rain')
                    return 'rain';

                if (trim($word) == 'pellets')
                    return 'giboule';

                if (trim($word) == 'sleet')
                    return 'nuages';

                if (trim($word) == 'Cloudy' || trim($word) == 'Overcast')
                    return 'nuageux';

                if (trim($word) == 'Clear/Sunny' || trim($word) == 'Sunny')
                    return 'ensoleille';

                if (trim($word) == 'freezing')
                    return 'neige';

                if (trim($word) == 'drizzle')
                    return 'giboule';

                if (trim($word) == 'Fog' || trim($word) == 'Blizzard')
                    return 'brumeux';


                return 'na';
            }
    }


    /**
     * @param null $jour
     * @return string
     */
    public function disponibilites($jour = null)
    {
        if ($jour == null)
            return '';

        $hrs1 = explode(',', $jour);

        $ch = "";
        if (isset($hrs1[1]) && !empty($hrs1[1]) && isset($hrs1[2]) && !empty($hrs1[2])){
            $ch = "De ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[0]."h"), 0, 5))." à ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[1]."h"), 0 ,5))." et de ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[2]."h"), 0, 5))." à  ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[3]."h"), 0,5));
        }
        elseif(isset($hrs1[2]) && empty($hrs1[2]) && isset($hrs1[3]) && empty($hrs1[3])){
            $ch = "De ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[0]."h"), 0, 5))." à ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[1]."h"), 0 ,5));
        }
        elseif(isset($hrs1[0]) && !empty($hrs1[0]) && isset($hrs1[1]) && !empty($hrs1[1])){
            $ch = "De ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[0]."h"), 0, 5))." à ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[1]."h"), 0 ,5));
        }
        elseif(isset($hrs1[2]) && !empty($hrs1[2]) && isset($hrs1[3]) && !empty($hrs1[3])){
            $ch = "De ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[2]."h"), 0, 5))." à ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[3]."h"), 0 ,5));
        }
        elseif( !empty($hrs1[0])  && !empty($hrs1[3])){
            $ch = "De ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[0]."h"), 0, 5))." à ".str_replace("h30h", "h30",substr(str_replace("-3","h30",$hrs1[3]."h"), 0 ,5));
        }
        if(empty($ch))
            $ch = "Fermé";
        
        return $ch;

//            if (count($hrs) > 1) {
//                foreach ($heures as $heure) {
//                    if (!empty($heure)){
//                        $real_heures[] = $heure;
//                    }
//                }
//                if (!empty($real_heures))
//                    $tabi = array_chunk($real_heures, 2);
//                $phrase = null;
//                if (!empty($tabi))
//                    foreach ($tabi as $tab) {
//                        $heuretab = null;
//                        if(!empty($tab) && is_string($tab))
//                        $heuretab = explode('-', $tab);
//                        if(!empty($heuretab))
//                            $tab[0] = $tab[0].'h30';
//
//                        $phrase .= 'De: ' . $tab[0] . 'h. à ' . $tab[1] . 'h. ';
//                    }
//                return $phrase;
//            } else {
//                return 'A partir de ' . $heures[0] . 'h.';
//            }

//        if (count($heures) > 1 and !empty($heures[1])){
//            if(count($heures) == 4)
//                return 'De: ' . $heures[0] . 'h. à ' . $heures[1] . 'h. et de '.$heures[2]. 'h. à '. $heures[3] . 'h.';
//
//            return 'De: ' . $heures[0] . 'h. à ' . $heures[1] . 'h.';
//        }
//        else{
//            return 'A partir de ' . $heures[0] . 'h.';
//        }
    }

    /**
     * @param null $picture
     * @param string $size
     * @return string
     */
    public function sizes($picture = null, $size = 'medium')
    {
        if ($picture == null)
            return '';
        $parts = explode('.', $picture);
        $name = $parts[count($parts) - 2];
        $ext = $parts[count($parts) - 1];
        return $name . '-' . $size . '.' . $ext;
    }

    /**
     * @param null $picture
     * @param string $size
     * @return string
     */
    public function sizes3($picture = null, $size = 'medium')
    {
        if ($picture == null)
            return '';
        $parts = explode('.', $picture);
        $name = $parts[count($parts) - 2];
        $ext = $parts[count($parts) - 1];
        return $name . '_' . $size . '.' . $ext;
    }

    /**
     * @param int $type
     * @return string
     */
    public function cuisine($type = 10)
    {
        $typeCuisine = array('Autre', 'Africain', 'Américain', 'Brésilien', 'Chinois', 'Coréen', 'Corse', 'Créole', 'Crêperie', 'Espagnol', 'Français', 'Grec', 'Indien', 'Italien', 'Japonais', 'Libanais', 'Mexicaine', 'Portugais', 'Thaïlandais', 'Turc', 'Vietnamien');
        if ($type <= 20) {
            return $typeCuisine[$type];
        } else {
            return 'Français';
        }
    }

    /**
     * @param null $file
     * @return bool
     */
    public function file_exist($file = null)
    {
//        var_dump($file);
        return file_exists($file);
    }

    /**
     * @param null $ch
     * @return array
     */
    public function split_commat($ch = null)
    {
        return explode(',', $ch);
    }

    /**
     * @param $sentence
     * @return mixed
     */
    public function formule($sentence)
    {
        if ($sentence != null) {
            return unserialize($sentence);
        }
    }

    /**
     * @param $string
     * @param $url
     * @return string
     */
    public function ReadMore($string, $url)
    {
        $count = strpos($string, '<!-- more -->');

        if ($count === false) {
            return $string;
        } else {
            $text = substr($string, 0, $count);
            $string = $text . '<div class="readmore"><a href="' . $url . '">Read More</a></div>';
            return $string;
        }
    }

    /**
     * @param $sentence
     * @return array|null
     */
    public function disponibilite($sentence)
    {
        $dispos_array = explode(',', $sentence);
        $dispo_reel = array();
        if (count($dispos_array) > 0) {
            foreach ($dispos_array as $dispo) {
                $dispo = $dispo + 1;
                $dispo_reel[] = date("d/m/Y", strtotime("+" . $dispo . " day"));
            }
            return $dispo_reel;
        } else {
            return null;
        }
    }

    /**
     * @param $date
     * @param string $dateType
     * @param string $timeType
     * @return bool|string
     */
    public static function localeDateFilter(
        $date, $dateType = 'medium', $timeType = 'none')
    {
        $values = array(
            'none' => \IntlDateFormatter::NONE,
            'short' => \IntlDateFormatter::SHORT,
            'medium' => \IntlDateFormatter::MEDIUM,
            'long' => \IntlDateFormatter::LONG,
            'full' => \IntlDateFormatter::FULL,
        );
        $dateFormater = \IntlDateFormatter::create(
            \Locale::getDefault(), $values[$dateType], $values[$timeType]
        );

        return $dateFormater->format($date);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'my_twig_extension';
    }

    /**
     * @param $price
     * @return string
     */
    public function priceFilter($price)
    {
        $price = (float)$price;
        $price = number_format($price, ($price == floor($price) ? 0 : 2), ',', ' ');
        return $price . ' €';
    }

    /**
     * @param $str
     * @return string
     */
    public function typeFormule($str)
    {
        $objet = unserialize($str);
        $result = array();
        foreach ($objet as $key => $value) {
            if ($key === "entree")
                array_push($result, "Entrée");
            if ($key === "plat")
                array_push($result, "Plat");
            if ($key === "dessert")
                array_push($result, "Dessert");
        }
        return join($result, " + ");
    }

    /**
     * @param null $date
     * @return string
     */
    public function customdate($date = null)
    {
        if ($date == null)
            $date = new \Datetime('now');
        $newdate = explode(' ', $date);
        return $newdate[0] . ' ' . $newdate[1];
    }

    /**
     * @param null $picture
     * @param string $size
     * @return string
     */
    public function sizes2($picture = null, $size = 'medium')
    {
        $filename = strtolower($picture);
        $exts = explode(".", $filename);
        $n = count($exts) - 1;
        $exts = $exts[$n];
        return $filename . '-' . $size . '.' . $ext;
    }


    /**
     * URL Decode a string
     *
     * @param string $url
     *
     * @return string The decoded URL
     */
    public function urlDecode($url)
    {
        return urldecode($url);
    }

    /**
     * @param int $nbavis
     * @return int
     */
    public function nbavis($nbavis = 0)
    {
        return 0;
    }

    /**
     * @param null $expr
     * @return string
     */
    public function sexe($expr = null)
    {
        if ($expr == '1') {
            return 'Mec';
        } else {
            return 'Nana';
        }
    }

    /**
     * @param null $expr
     * @return string
     */
    public function period($expr = null)
    {
        if ($expr == '1') {
            return 'Midi';
        } else {
            return 'Soir';
        }
    }

    /**
     * @param \DateTime $dateTime
     * @return null|string
     */
    public function beginIn(\DateTime $dateTime)
    {
        if (!$dateTime)
            return null;

        $delta = time() - $dateTime->getTimestamp();

        $duration = "";
        if ($delta > 60) {
// Seconds
            if ($delta > 60) {
                // Secondes
                $time = $delta;
                $duration = abs($time) . " seconde" . ((abs($time) === 0 || abs($time) > 1) ? "s" : "") . "";
            }
        } else if ($delta >= 3600) {
// Mins
            $time = floor($delta / 60);
            $duration = abs($time) . " minute" . ((abs($time) > 1) ? "s" : "") . "";
        } else if ($delta >= 86400) {
// Hours
            $time = floor($delta / 3600);
            $duration = abs($time) . " heure" . ((abs($time) > 1) ? "s" : "") . "";
        } else {
// Days
            $time = floor($delta / 86400);
            $duration = abs($time) . " jour" . ((abs($time) > 1) ? "s" : "") . "";
        }
        return $duration;
    }


    /**
     * @param $dateTime
     * @return null|string
     * @throws \Exception
     */
    public function createdAgo($dateTime)
    {

        if (!$dateTime)
            return null;

        $delta = time() - $dateTime->getTimestamp();
        if ($delta < 0)
            throw new \Exception("createdAgo is unable to handle dates in the future");
        $duration = "";
        if ($delta < 60) {
// Seconds
            if ($delta < 60) {
                // Secondes
                $time = $delta;
                $duration = $time . " seconde" . (($time === 0 || $time > 1) ? "s" : "") . "";
            }
        } else if ($delta <= 3600) {
// Mins
            $time = floor($delta / 60);
            $duration = $time . " minute" . (($time > 1) ? "s" : "") . "";
        } else if ($delta <= 86400) {
// Hours
            $time = floor($delta / 3600);
            $duration = $time . " heure" . (($time > 1) ? "s" : "") . "";
        } else {
// Days
            $time = floor($delta / 86400);
            $duration = $time . " jour" . (($time > 1) ? "s" : "") . "";
        }
        return $duration;
    }


    /**
     * @param $sentence
     * @return mixed
     */
    public function extras($sentence)
    {
        if ($sentence != null) {
            $extras_array = unserialize($sentence);


            return $extras_array;
        }
    }

    /**
     * @param $rate
     * @return mixed
     */
    public function textNoteComment($rate)
    {
        if ($rate <= 5) {
            $arrayNot = array(
                1 => 'Déçu',
                2 => 'M\'ouais',
                3 => 'Pas mal',
                4 => 'Réussi',
                5 => 'Comblé');

            return $arrayNot[$rate];
        } else {
            return $arrayNot[4];
        }
    }

    /**
     * @param $hour
     * @return string
     */
    public function displayHour($hour)
    {
        return $hour . 'h00';
    }

    /**
     * @param $number
     * @return float
     */
    public function displayFloor($number)
    {
        return floor($number);
    }

    /**
     * @param $begin
     * @param $end
     * @param int $daysInterval
     * @return \DatePeriod
     */
    public function date_period($begin, $end, $daysInterval = 1)
    {

        # Dates : String pour DateTime::modify ou DateTime direct
        if (is_string($begin))
            $begin = new \Datetime($begin);
        else
            $dateBegin = $begin;

        $dateEnd = clone $dateBegin;
        if (is_string($end))
            $dateEnd->modify($end);
        else
            $dateEnd = $end;

        # Interval
        $interval = new \DateInterval("P" . $daysInterval . "D");

        # Periode
        $period = new \DatePeriod($dateBegin, $interval, $dateEnd);

        return $period;
    }

    /**
     * @param $date
     * @return bool
     */
    public function isLundi($date)
    {

        # Dates : String pour DateTime::modify ou DateTime direct
        if (is_string($date))
            $date = new \Datetime($date);

        return $date->format("N") == "1";
    }

    /**
     * @param $date1
     * @param $date2
     * @return bool
     */
    public function isAfter($date1, $date2)
    {
        return $date1->diff($date2)->invert === 1;
    }

    /**
     * @param $date
     * @return string
     */
    public function tronqueMois($date)
    {
        if (mb_strlen($date, 'utf8') > 4)
            $date = mb_substr($date, 0, 3 + ($date == "juillet" ? 1 : 0), 'utf8') . ".";
        return $date;
    }

    /**
     * @param $val
     * @return mixed
     */
    public function jsondecode($val)
    {
        return json_decode($val);
    }

    /**
     * @param $arr
     * @return array
     */
    public function arraypop($arr)
    {
        $end = array_pop($arr);
        return array($arr, $end);
    }

}

?>
