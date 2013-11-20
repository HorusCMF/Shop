<?php

namespace Hetic\SiteBundle\Payline;

use Doctrine\ORM\EntityManager;

//use Symfony\Component\DependencyInjection\ContainerAware;
//use Doctrine\Common\Util\Debug;

class PaylineCron {

    protected $user;
    protected $em;
    protected $container;
    protected $payline;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     *  Pay configuration
     */
    public function index($user, $arrayPayl, $priceTTC = 0, $priceHT = 0) {

        $this->payline = new \Payline_Payline($arrayPayl['MERCHANT_ID'], $arrayPayl['ACCESS_KEY'], $arrayPayl['PROXY_HOST'], $arrayPayl['PROXY_PORT'], $arrayPayl['PROXY_LOGIN'], $arrayPayl['PROXY_PASSWORD'], $arrayPayl['PRODUCTION']);

        $uid = $user->getId();
//        die(var_dump($priceTTC, $priceHT));
        $cardCustomer = $this->getMyCards($uid, $arrayPayl);


        // Si le user a une carte
        if ($cardCustomer) {
            $nbCardCustomer = count($cardCustomer) - 1;

            $orderTotalWhitoutTaxes = round($priceHT * 100);
            $orderTotal = round($priceTTC * 100);
            $taxes = $orderTotal - $orderTotalWhitoutTaxes;

            $doImmediateWalletPaymentRequest = array();
            $contractNumber = $this->getPaylineContractsByCard($cardCustomer[$nbCardCustomer]['type']);

            $date = new \DateTime('now');
            $newOrderId = 'My cart['.$user->getId().'-'.$date->format('Ymdhms') . ']';

            // PAYMENT
            $doImmediateWalletPaymentRequest['payment']['amount'] = $orderTotal;
            $doImmediateWalletPaymentRequest['payment']['currency'] = '978';
            $doImmediateWalletPaymentRequest['payment']['contractNumber'] = $contractNumber;
            $doImmediateWalletPaymentRequest['payment']['mode'] = 'CPT';
            $doImmediateWalletPaymentRequest['payment']['action'] = '101';

            // ORDER
            $doImmediateWalletPaymentRequest['order']['ref'] = $newOrderId;
            $doImmediateWalletPaymentRequest['order']['country'] = 'FR';
            $doImmediateWalletPaymentRequest['order']['taxes'] = $taxes;
            $doImmediateWalletPaymentRequest['order']['amount'] = $orderTotalWhitoutTaxes;
            $doImmediateWalletPaymentRequest['order']['date'] = date('d/m/Y H:i');
            $doImmediateWalletPaymentRequest['order']['currency'] = $doImmediateWalletPaymentRequest['payment']['currency'];

            $privateData0 = array();
            $privateData1 = array();
            $privateData2 = array();
            $privateData3 = array();
            $privateData4 = array();
            $privateData5 = array();
            $privateData6 = array();
            $privateData7 = array();
            $privateData8 = array();
            $privateData9 = array();
            $privateData0['key'] = 'idOrder';
            $privateData0['value'] = $newOrderId;
            $this->payline->setPrivate($privateData0);

            $privateData2['key'] = 'Prénom';
            $privateData2['value'] = $user->getFirstname();
            $this->payline->setPrivate($privateData2);
            $privateData3['key'] = 'Nom';
            $privateData3['value'] = $user->getLastname();
            $this->payline->setPrivate($privateData3);
            $privateData4['key'] = 'Ville';
            $privateData4['value'] = $user->getVille();
            $this->payline->setPrivate($privateData4);
            $privateData5['key'] = 'Token';
            $privateData5['value'] = $user->getToken();
            $this->payline->setPrivate($privateData5);
            $privateData6['key'] = 'idCust';
            $privateData6['value'] = $user->getId();
            $this->payline->setPrivate($privateData6);
            $privateData7['key'] = "Nom de l'établissement";
            $privateData7['value'] = $user->getTitle();
            $this->payline->setPrivate($privateData7);
            $privateData8['key'] = "Email de l'établissement";
            $privateData8['value'] = $user->getEmail();
            $this->payline->setPrivate($privateData8);
            $privateData9['key'] = "Tel de l'établissement";
            $privateData9['value'] = $user->getTel();
            $this->payline->setPrivate($privateData9);

            // WALLET ID
            $doImmediateWalletPaymentRequest['walletId'] = $this->getOrGenWalletId($user->getId());

            // CARDIND
            $doImmediateWalletPaymentRequest['cardInd'] = $cardCustomer[$nbCardCustomer]['cardInd'];

            $result = $this->payline->doImmediateWalletPayment($doImmediateWalletPaymentRequest);

            $vars = array();
            if (isset($result) && $result['result']['code'] == '00000') {
                return true;
            } else {
                return false;
            }
        }
        else
            return false;
    }

    /**
     * get Contracts of Payline By Card
     * @param type $contract
     * @return type
     */
    private function getPaylineContractsByCard($contractType) {
        $q = $this->em->getConnection()->prepare('SELECT contract FROM payline_card WHERE type = :typecard');
        $q->bindValue('typecard', $contractType);
        $q->execute();
        $contract = $q->fetchColumn();
        $q->closeCursor();
        return $contract;
    }

    /**
     * Return wallet if exist else generate new wallet id
     * @param type $id_customer
     * @return string
     */
    private function getOrGenWalletId($id_customer) {
        $q = $this->em->getConnection()->prepare('SELECT id_wallet FROM payline_wallet_users WHERE id_customer = :id');
        $q->bindValue('id', $id_customer);
        $q->execute();
        $walletId = $q->fetchColumn();
        $q->closeCursor();
        return $walletId;
    }

    /**
     * get Contracts of Payline
     * @param type $contract
     * @return type
     */
    private function getPaylineContracts($contract) {
        $q = $this->em->getConnection()->prepare('SELECT contract, type, `primary` FROM payline_card WHERE contract = :num');
        $q->bindValue('num', $contract);
        $q->execute();
        $contract = $q->fetchAll();
        $q->closeCursor();
        return $contract;
    }

    /**
     * get My Cards
     * @param type $id_customer
     * @param type $arrayPayl
     * @return boolean
     */
    public function getMyCards($id_customer, $arrayPayl) {


        $getCardsRequest = array();
        $getCardsRequest['contractNumber'] = $arrayPayl['CONTRACT_NUMBER'];
        $getCardsRequest['walletId'] = $this->getOrGenWalletId($id_customer);
        $getCardsRequest['cardInd'] = null;

        //here BUG
        $getCardsResponse = $this->payline->getCards($getCardsRequest);
//                exit(Debug::dump($this->payline));

        $cardData = array();

        if (isset($getCardsResponse) AND is_array($getCardsResponse) AND $getCardsResponse['result']['code'] == '02500') {
            $n = 0;
            if(!empty($getCardsResponse))
            foreach ($getCardsResponse['cardsList']['cards'] as $card) {
                if (!$card->isDisabled) {
                    $cardData[$n] = array();
                    $cardData[$n]['lastName'] = $card->lastName;
                    $cardData[$n]['firstName'] = $card->firstName;
                    $cardData[$n]['number'] = $card->card->number;
                    $cardData[$n]['type'] = $card->card->type;
                    $cardData[$n]['expirationDate'] = $card->card->expirationDate;
                    $cardData[$n]['cardInd'] = $card->cardInd;
                    $n++;
                }
            }

            if (sizeof($cardData) > 0)
                return $cardData;
            else
                return false;
        }
        return false;
    }

}
