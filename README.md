# msisdn-network-detector
A PHP library for detecting mobile network providers from MSISDNs based on number prefixes. Currently supports Kenyan networks.

## Supported Networks
- Safaricom
- Airtel
- Telkom
- Equitel

## Installation

You can install via Composer:

```bash
composer require haroldkerry/msisdn-network-detector
````

## Usage Example

```php
use HaroldKerry\MsisdnNetworkDetector\NetworkDetector;

$detector = new NetworkDetector();

/**
 * Recommended: Just use detectKenyanNetwork – it cleans and validates for you
 */

$network = $detector->detectKenyanNetwork('+254700000000');
echo "Network: " . $network; // Outputs: Safaricom, Airtel, etc. or 'Unknown Network'

/**
 * If you only want to clean and validate a number without detecting the network
 */

$result = $detector->detectKenyanNetwork($cleanedNumber);
echo "Clean Result: " . $result; // Outputs: 0700000000 or error string

/**
 * To detect multiple networks from an array of MSISDNs
 */
$msisdns = ['+254xxxxxxxxx','073511xxxxx'];
$networks = $detector->detectMultipleKenyanNetworks($msisdns);

print_r($networks); // ['Safaricom', 'Airtel']

```

## Contributing

Contributions are welcome via Pull Requests.
Please fork the repository and submit a PR to the **main** branch.
