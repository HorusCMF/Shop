<?php

namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Util\Debug as Debug;
use Wks\SiteBundle\Util\Box;


class VillesRepository extends EntityRepository
{

    /*
     * @return idVille or TabVille or NULL
     */
    public function findIdByVilleAndZipcode($ville = null, $zipcode = null)
    {

        $zip_pattern = "/\d{5}/";
        preg_match($zip_pattern, $ville, $regs);
        if (isset($regs[0])) {
            $zipcode = $regs[0];
            $ville = null;
        }
//        $ville = Box::slugize($ville);
//        exit($ville);

        if ($ville != null) {

            $sql = $this->createQueryBuilder('v')
                ->where('v.nomVille = :ville')
                ->orWhere('v.nomVille = :ville')
                ->setParameter('ville', ucfirst(strtolower(trim($ville))));
            $query = $sql->getQuery();
            $query->setMaxResults(1);
            if ($id = $query->getResult())
                return $id;
        } elseif ($zipcode != null) {
            $sql = $this->createQueryBuilder('c')
                ->where('c.codePostal = :cp')
                ->setParameter('cp', (int)$zipcode);
            $query = $sql->getQuery();
            $query->setMaxResults(1);
            return $query->getResult();
        }

//        $ville = $this->_removeAccents($ville);

//        exit(Debug::dump($ville));


        return null;
    }

    /*
     * @return idVille or TabVille or NULL
     */
    public function GetObjectCityById($city = null)
    {

//        exit(Debug::dump(gettype($city)));
        $zipcode = null;
        $zip_pattern = "/\d{5}/";

        if(is_object($city))
           $city = $city->getNomVille();

        preg_match($zip_pattern, $city, $regs);
        if (isset($regs[0])){
            $zipcode = $regs[0];
            $city = null;
        }

        if (!empty($zipcode)) {
            $sql = $this->createQueryBuilder('c')
                ->where('c.codePostal = :cp')
                ->setParameter('cp', $zipcode)
                ->setMaxResults(1);

            if ($obj = $sql->getQuery()->getOneOrNullResult())
                return $obj;
        }

        if (!empty($city)) {
            $city = Box::slugize($city);

            $sql = $this->createQueryBuilder('v')
                ->where('v.nomVilleMaj = :ville')
                ->orWhere('v.nomVille = :ville')
                ->setParameter('ville', ucfirst(strtolower(trim($city))))
                ->setMaxResults(1);

            if ($obj = $sql->getQuery()->getOneOrNullResult())
                return $obj;
        }

        // Localisation par IP
        return null;
    }

    /*
     * @return idVille or TabVille or NULL
     */
    public function getProximity($ville = null, $perimetre = 100, $limit = 200, $zipcode = null)
    {

        $ville = $this->GetObjectCityById($ville);
//        exit(Debug::dump($ville));
        if(!empty($ville)){

        $sql = $this->createQueryBuilder('c')
            ->select('GEO(c.latitude = :latitude, c.longitude = :longitude) as distance, c.codePostal')
            ->setParameter('latitude', $ville->getLatitude())
            ->setParameter('longitude', $ville->getLongitude())
            ->where('c.id != :idv')
            ->andWhere('GEO(c.latitude = :latitude, c.longitude = :longitude) <= :perimetre')
            ->setParameter('idv', $ville->getId())
            ->setParameter('perimetre', $perimetre)
            ->groupBy('c.codePostal')
            ->orderBy('distance')
            ->setMaxResults($limit);

           return $sql->getQuery()->getResult();

        }
        return null;
    }


    /*
     * @return idVille or TabVille or NULL
     */
    public function getCityProximity($ville = null, $perimetre = 10)
    {

        $ville = $this->GetObjectCityById($ville);
        if(!empty($ville)){

            $sql = $this->createQueryBuilder('c')
                ->select('c.id, GEO(c.latitude = :latitude, c.longitude = :longitude) as distance, c.codePostal, c.nomVilleMaj')
                ->setParameter('latitude', $ville->getLatitude())
                ->setParameter('longitude', $ville->getLongitude())
                ->where('c.id != :idv')
                ->andWhere('GEO(c.latitude = :latitude, c.longitude = :longitude) <= :perimetre')
                ->setParameter('idv', $ville->getId())
                ->setParameter('perimetre', $perimetre)
                ->groupBy('c.codePostal')
                ->orderBy('distance');
            $query = $sql->getQuery()->setMaxResults(1);

            return $query->getOneOrNullResult();
        }
        return null;
    }

    /*
     * @return distance betwenne 2 cities
     */
    public function getDistance($ville = null, $villeother = null)
    {
        $ville = $this->GetObjectCityById($ville);
        $villeother = $this->GetObjectCityById($villeother);
        if(!empty($ville) && !empty($villeother)) {

        $sql = $this->createQueryBuilder('c')
            ->select('GEO(c.latitude = :latitude, c.longitude = :longitude) as distance')
            ->setParameter('latitude', $villeother->getLatitude())
            ->setParameter('longitude', $villeother->getLongitude())
            ->where('c.id = :idv')
            ->setParameter('idv', $ville->getId())
            ->groupBy('c.codePostal')
            ->orderBy('distance');
          $query = $sql->getQuery()->setMaxResults(1);

            return $query->getOneOrNullResult();
        }
        return null;
    }

//    
//    /*
//     * @return idVille or TabVille or NULL
//     */
//    public function getProximity($ville = null) {
//        if ($ville == null)
//            $ville = 'paris';
//        
//        $ville = $this->_removeAccents($ville);
//        
//        $sql = $this->createQueryBuilder('v')
//                ->select('v.id')
//                ->where('v.nomMaj = :ville')
//                ->setParameter('ville', strtoupper($ville));
//        
//        $ville = $this->_removeAccents($ville);
//        $sql = $this->createQueryBuilder('v')
//                ->select('v.id')
//                ->where('v.nomMaj = :ville')
//                ->setParameter('ville', strtoupper($ville));
//
//        if($id = $sql->getQuery()->getOneOrNullResult())
//            return $id;
//
//        if($zipcode == null)
//            $zipcode = '75001';
//         $sql = $this->createQueryBuilder('c')
//                    ->select('c.id')
//                    ->where('c.codepostal = :cp')
//                    ->setParameter('cp', (int)$zipcode);
//        
//        if($id = $sql->getQuery()->getOneOrNullResult())
//           return $id;
//        
//        // Localisation par IP
//        return null;
//    }

    /*
     * @return string without accent
     */
    private function _removeAccents($text)
    {
        $alphabet = array(
            'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
            'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
            'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
            'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
            'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
            'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
            'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f');

        $text = strtr($text, $alphabet);
        $text = preg_replace('/\W+/', '-', $text); //slugify
        return $text;
    }

}