<?php

namespace HaroldKerry\MsisdnNetworkDetector;

class NetworkRegistry
{

    /**
     * Get the list of Kenyan mobile number prefixes mapped to their respective networks.
     *
     * @return array Associative array where the key is the network name
     *               and the value is an array of 4-digit prefixes belonging to that network.
     */


    public static function getKenyanPrefixes(): array
    {

        return
            [
                NetworkDetector::SAFARICOM_NETWORK =>  [
                    '0700',
                    '0701',
                    '0702',
                    '0703',
                    '0704',
                    '0705',
                    '0706',
                    '0707',
                    '0708',
                    '0709',
                    '0710',
                    '0711',
                    '0712',
                    '0713',
                    '0714',
                    '0715',
                    '0716',
                    '0717',
                    '0718',
                    '0719',
                    '0720',
                    '0721',
                    '0722',
                    '0723',
                    '0724',
                    '0725',
                    '0726',
                    '0727',
                    '0728',
                    '0729',
                    '0740',
                    '0741',
                    '0742',
                    '0743',
                    '0745',
                    '0746',
                    '0748',
                    '0790',
                    '0791',
                    '0792',
                    '0793',
                    '0794',
                    '0795',
                    '0796',
                    '0797',
                    '0798',
                    '0799',
                    '0757',
                    '0758',
                    '0759',
                    '0768',
                    '0769',
                    '0110',
                    '0111',
                    '0112',
                    '0113',
                    '0114',
                    '0115'
                ],
                NetworkDetector::AIRTEL_NETWORK =>  [
                    '0730',
                    '0731',
                    '0732',
                    '0733',
                    '0734',
                    '0735',
                    '0736',
                    '0737',
                    '0738',
                    '0739',
                    '0750',
                    '0751',
                    '0752',
                    '0753',
                    '0754',
                    '0755',
                    '0756',
                    '0780',
                    '0781',
                    '0782',
                    '0783',
                    '0784',
                    '0785',
                    '0786',
                    '0787',
                    '0788',
                    '0789',
                    '0762',
                    '0100',
                    '0101',
                    '0102',
                    '0103',
                    '0104',
                    '0105',
                    '0106',
                    '0107',
                    '0108',
                ],
                NetworkDetector::TELKOM_NETWORK =>  [
                    '0770',
                    '0771',
                    '0772',
                    '0773',
                    '0774',
                    '0775',
                    '0776',
                    '0777',
                    '0778',
                    '0779',
                ],
                NetworkDetector::EQUITEL_NETWORK => [
                    '0763',
                    '0764',
                    '0765',
                    '0766',
                ]
            ];
    }
}
