# msisdn-network-detector
A PHP library for cleaning MSISDNs and detecting mobile network providers based on number prefixes.

## Supported Kenyan Networks
- Safaricom
- Airtel
- Telkom
- Equitel

Non-Kenyan numbers are automatically classified a International

## Installation

You can install via Composer:

```bash
composer require haroldkerry/msisdn-network-detector
```

## Usage Example

```php
use HaroldKerry\MsisdnNetworkDetector\NetworkDetector;

$detector = new NetworkDetector();

/**
 * Detect Network (Recommended)
 */



$network = $detector->detectNetwork('+254700000000');
echo "Network: " . $network; 
// Safaricom, Airtel, Telkom, Equitel, // Unknown Kenyan Network, or International

/**
 * Clean an MSISDN
 */

$cleaned = $detector->cleanMsisdn('+254 700 000 000');
echo $cleaned; // 0700000000 (for Kenyan numbers) // 255700000000 (for international numbers)

/**
 * Detect Multiple MSISDNs
 */
$msisdns = [ '+254700000000', '0735110000', '+255700000000' ];
$results = $detector->detectMultipleNetworks($msisdns);

print_r($results); // [ '+254700000000' => 'Safaricom', '0735110000' => 'Airtel', '+255700000000' => 'International' ]

```

## Kenyan Number Rules

A number is treated as Kenyan if it starts with:

+254 254 or 0

Valid Kenyan numbers are normalized to:

07XXXXXXXX

If the prefix does not match any known network, the result will be:

Unknown Kenyan Network

## International Numbers

Any number that does not match Kenyan formats will:

Be cleaned (digits only)

Be returned as International during detection

## Contributing

Contributions are welcome via Pull Requests.
Please fork the repository and submit a PR to the **main** branch.
