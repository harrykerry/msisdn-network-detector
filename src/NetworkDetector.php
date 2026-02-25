<?php

namespace HaroldKerry\MsisdnNetworkDetector;

class NetworkDetector
{
    public const SAFARICOM_NETWORK = 'Safaricom';
    public const AIRTEL_NETWORK = 'Airtel';
    public const TELKOM_NETWORK = 'Telkom';
    public const EQUITEL_NETWORK = 'Equitel';
    public const INTERNATIONAL_NETWORK = 'International';
    public const INVALID_MSISDN = 'Invalid MSISDN';

    /**
     * Clean any MSISDN and normalize
     *
     * Kenyan numbers:
     * +254XXXXXXXXX -> 0XXXXXXXXX
     * 254XXXXXXXXX  -> 0XXXXXXXXX
     * 0XXXXXXXXX    -> valid local
     *
     * International numbers:
     * Removes symbols and returns digits only
     *
     * @param string $msisdn
     * @return string|null Cleaned MSISDN or null if invalid
     */
    public function cleanMsisdn(string $msisdn): ?string
    {
        if (trim($msisdn) === '') {
            return null;
        }

        // Remove all characters except digits and +
        $msisdn = preg_replace('/[^\d\+]/', '', $msisdn);

        // Kenyan numbers starting with +254
        if (str_starts_with($msisdn, '+254')) {
            if (strlen($msisdn) !== 13) {
                return null;
            }
            return '0' . substr($msisdn, 4);
        }

        // Kenyan numbers starting with 254
        if (str_starts_with($msisdn, '254')) {
            if (strlen($msisdn) !== 12) {
                return null;
            }
            return '0' . substr($msisdn, 3);
        }

        // Kenyan local format
        if (str_starts_with($msisdn, '0')) {
            if (strlen($msisdn) !== 10) {
                return null;
            }
            return $msisdn;
        }

        // International numbers
        if (str_starts_with($msisdn, '+')) {
            $msisdn = substr($msisdn, 1);
        }

        // Keep digits only
        $msisdn = preg_replace('/\D/', '', $msisdn);

        if ($msisdn === '') {
            return null;
        }

        return $msisdn;
    }

    /**
     * Detects the network of a number
     *
     * @param string $msisdn
     * @return string
     */
    public function detectNetwork(string $msisdn): string
    {
        $cleaned = $this->cleanMsisdn($msisdn);

        if ($cleaned === null) {
            return self::INVALID_MSISDN;
        }

        // Kenyan numbers start with 0 after normalization
        if (str_starts_with($cleaned, '0')) {
            $prefix = substr($cleaned, 0, 4);
            $networkPrefixes = NetworkRegistry::getKenyanPrefixes();

            foreach ($networkPrefixes as $network => $prefixes) {
                if (in_array($prefix, $prefixes, true)) {
                    return $network;
                }
            }

            return 'Unknown Kenyan Network';
        }

        return self::INTERNATIONAL_NETWORK;
    }

    /**
     * Detect networks for multiple MSISDNs
     *
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