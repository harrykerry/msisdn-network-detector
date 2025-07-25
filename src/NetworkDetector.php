<?php

namespace HaroldKerry\MsisdnNetworkDetector;

class NetworkDetector
{

    public const SAFARICOM_NETWORK = 'Safaricom';
    public const AIRTEL_NETWORK = 'Airtel';
    public const TELKOM_NETWORK = 'Telkom';
    public const EQUITEL_NETWORK = 'Equitel';


    /**
     * Clean the Kenyan Msisdn and ensure correct format before checker (starts with 0, no unwanted characters etc)
     * @param string $msisdn  Kenyan mobile number being cleaned
     * @return string cleaned Kenyan mobile number
     */
    public function cleanKenyanMsisdn(string $msisdn): string
    {
        // Remove non numeric characters
        $msisdn = preg_replace('/\D/', '', $msisdn);

        // Handle numbers starting with 254 (international format)
        if (str_starts_with($msisdn, '254')) {

            if (strlen($msisdn) !== 12) {
                return 'Invalid Kenyan MSISDN: Wrong length for 254 format';
            }

            $msisdn = '0' . substr($msisdn, 3);
        }

        // Handle numbers starting with 0 (local format)
        if (str_starts_with($msisdn, '0')) {
            if (strlen($msisdn) !== 10) {
                return 'Invalid Kenyan MSISDN: Wrong length for local format';
            }
            return $msisdn;
        }

         return 'Invalid MSISDN: Not a recognized Kenyan number';
    }

    /**
     * Returns network name of the passed msisdn
     * @param string $msisdn Kenyan Mobile number
     * @return string Network name for the passed mobile number or Unknown for Invalid Kenyan number
     * 
     */

    public function detectKenyanNetwork(string $msisdn): string
    {
        $msisdn = $this->cleanKenyanMsisdn($msisdn);

        $numberPrefix = substr($msisdn, 0, 4);

        $networkPrefixes = NetworkRegistry::getKenyanPrefixes();

        foreach ($networkPrefixes as $network => $networkPrefixes) {
            if (in_array($numberPrefix, $networkPrefixes)) {

                return  $network;
            }
        }

        return 'Unknown Network';
    }


    /**
     * Returns network names of the passed msisdns
     * @param array $msisdns Kenyan Mobile numbers
     * @return array Network names for the passed mobile number or Unknown for Invalid Kenyan numbers
     */

    public function detectMultipleKenyanNetworks(array $msisdns): array
    {
        $results = [];
        foreach ($msisdns as $msisdn) {
            $results[$msisdn] = $this->detectKenyanNetwork($this->cleanKenyanMsisdn($msisdn));
        }
        return $results;
    }
}
