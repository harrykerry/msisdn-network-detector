<?php

namespace HaroldKerry\MsisdnNetworkDetector;

class NetworkDetector
{

    public const SAFARICOM_NETWORK = 'Safaricom';
    public const AIRTEL_NETWORK = 'Airtel';
    public const TELKOM_NETWORK = 'Telkom';
    public const EQUITEL_NETWORK = 'Equitel';
    public const INTERNATIONAL_NETWORK = 'International';



    /**
     * Clean any MSISDN and normalize
  
     * @param string $msisdn
     * @return string cleaned MSISDN
     */
    public function cleanMsisdn(string $msisdn): string
    {
        // Remove non numeric characters
        $msisdn = preg_replace('/[^\d\+]/', '', $msisdn);

        // Kenyan numbers starting with 254
        if (str_starts_with($msisdn, '254')) {
            if (strlen($msisdn) !== 12) {
                return 'Invalid Kenyan MSISDN: Wrong length for 254 format';
            }
            return '0' . substr($msisdn, 3);
        }

        // Kenyan numbers starting with +254
        if (str_starts_with($msisdn, '+254')) {
            if (strlen($msisdn) !== 13) {
                return 'Invalid Kenyan MSISDN: Wrong length for +254 format';
            }
            return '0' . substr($msisdn, 4);
        }

        // Handle numbers starting with 0 (local format)
        if (str_starts_with($msisdn, '0')) {
            if (strlen($msisdn) !== 10) {
                return 'Invalid Kenyan MSISDN: Wrong length for local format';
            }
            return $msisdn;
        }

        // For international numbers, remove any leading + and keep digits
        if (str_starts_with($msisdn, '+')) {
            $msisdn = substr($msisdn, 1);
        }

        // Only digits remain
        $msisdn = preg_replace('/\D/', '', $msisdn);

        return $msisdn;
    }

    /**
    /**
     * Detects the network of a number
     * @param string $msisdn
     * @return string Network name or International if not Kenyan
     */
    public function detectNetwork(string $msisdn): string
    {
        $cleaned = $this->cleanMsisdn($msisdn);

        if (str_starts_with($cleaned, '0')) {
            $prefix = substr($cleaned, 0, 4);
            $networkPrefixes = NetworkRegistry::getKenyanPrefixes();
            foreach ($networkPrefixes as $network => $prefixes) {
                if (in_array($prefix, $prefixes)) {
                    return $network;
                }
            }
            return 'Unknown Kenyan Network';
        }

        // Otherwise, international
        return self::INTERNATIONAL_NETWORK;
    }


    /**
     * Detects networks for multiple MSISDNs
     * @param array $msisdns
     * @return array
     */
    public function detectMultipleNetworks(array $msisdns): array
    {
        $results = [];
        foreach ($msisdns as $msisdn) {
            $results[$msisdn] = $this->detectNetwork($msisdn);
        }
        return $results;
    }
}
