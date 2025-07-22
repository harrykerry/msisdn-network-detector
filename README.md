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

$cleanedNumber = $detector->cleanKenyanMsisdn('+254xxxxxxxxx');
$network = $detector->detectKenyanNetwork($cleanedNumber);

echo "Network: " . $network;
```

## Contributing

Contributions are welcome via Pull Requests.
Please fork the repository and submit a PR to the **main** branch.
