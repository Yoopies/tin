<?php

declare(strict_types=1);

// TIN samples per country handler, imported from the upstream loophp/tin test suite.
// Keys: valid, length, pattern, date, syntax (expected failure reason).
return [
    'Austria' => [
        'valid' => [
            '931736581',
        ],
        'length' => [
            '9317365815',
        ],
        'pattern' => [
            '1w1w1w1w1',
        ],
        'syntax' => [
            '931736582',
        ],
    ],
    'Belgium' => [
        'valid' => [
            '00012511119',
            '01062624339',
        ],
        'length' => [
            '0001251112020',
        ],
        'pattern' => [
            'wwwwwwwwwww',
        ],
        'date' => [
            '81023011101',
        ],
        'syntax' => [
            '00022911101',
            '00012511120',
        ],
    ],
    'Bulgaria' => [
        'valid' => [
            '7501010010',
        ],
        'length' => [
            '75010100100',
        ],
        'pattern' => [
            '1w1w1w1w1w',
        ],
        'date' => [
            '7502300010',
            '4545454545',
        ],
        'syntax' => [
            '7501010011',
        ],
    ],
    'Croatia' => [
        'valid' => [
            '71481280786',
        ],
        'length' => [
            '0123456789101',
        ],
        'pattern' => [
            '1w1w1w1w1w1',
        ],
        'syntax' => [
            '00123123711',
        ],
    ],
    'Cyprus' => [
        'valid' => [
            '00123123T',
            '99652156X',
        ],
        'length' => [
            '00123123TZ',
        ],
        'pattern' => [
            'wwwwwwwww',
        ],
        'syntax' => [
            '99652159X',
            '94444444X',
            '97777777X',
            '98888888X',
            '09999999T',
        ],
    ],
    'CzechRepublic' => [
        'valid' => [
            '000101999',
            '103224/0000',
            '108224/0016',
            '901224/0006',
            '906224/0011',
            '401224/001',
            '406224/002',
        ],
        'length' => [
            '1',
        ],
        'pattern' => [
            'wwwwww/www',
        ],
        'date' => [
            '901549/0006',
            '902149/0003',
        ],
        'syntax' => [
            '8109024/001',
        ],
    ],
    'Denmark' => [
        'valid' => [
            '0101111113',
            '0101601111',
        ],
        'length' => [
            '01011111132',
        ],
        'pattern' => [
            '9101111113',
        ],
        'date' => [
            '3119999999',
        ],
        'syntax' => [
            '0101111114',
            '0101477000',
        ],
    ],
    'Estonia' => [
        'valid' => [
            '37102250382',
            '32708101201',
            '46304280206',
        ],
        'length' => [
            '3710225038',
        ],
        'pattern' => [
            '97102250382',
        ],
        'date' => [
            '19913333038',
        ],
        'syntax' => [
            '37102250383',
        ],
    ],
    'Finland' => [
        'valid' => [
            '131052-308T',
        ],
        'length' => [
            '1310552-308T',
        ],
        'pattern' => [
            '1-31052308T',
        ],
        'date' => [
            '191952A308T',
        ],
        'syntax' => [
            '131052-308Z',
        ],
    ],
    'France' => [
        'valid' => [
            '3023217600053',
        ],
        'length' => [
            '30232176000531',
        ],
        'pattern' => [
            '9111111111111',
        ],
        'syntax' => [
            '1111111111111',
        ],
    ],
    'Germany' => [
        'valid' => [
            '26954371827',
            '86095742719',
            '65929970489',
        ],
        'length' => [
            '860957427199',
        ],
        'pattern' => [
            'wwwwwwwwwww',
        ],
        'syntax' => [
            '26954371828',
        ],
    ],
    'Greece' => [
        'valid' => [
            '123456789',
        ],
        'length' => [
            '12345678',
        ],
    ],
    'Hungary' => [
        'valid' => [
            '8071592153',
        ],
        'length' => [
            '80715921531',
        ],
        'pattern' => [
            '1111111111',
        ],
        'syntax' => [
            '8071592154',
        ],
    ],
    'Ireland' => [
        'valid' => [
            '1234567T',
            '1234567TW',
            '1234577W',
            '1234577WW',
            '1234577IA',
            '1234567t',
            '1234567tw',
            '1234577w',
            '1234577ww',
            '1234577ia',
        ],
        'length' => [
            '234567T',
            '234567t',
        ],
        'pattern' => [
            'AAAAAAAA',
        ],
        'syntax' => [
            '1234567S',
            '1234567s',
        ],
    ],
    'Italy' => [
        'valid' => [
            'DMLPRY77D15H501F',
        ],
        'length' => [
            'DMLPRY77D154H501F',
        ],
        'pattern' => [
            '1111111111111111',
        ],
        'syntax' => [
            'DMLPRY77D15H501B',
        ],
    ],
    'Latvia' => [
        'valid' => [
            '01011012345',
            '32579461005',
        ],
        'length' => [
            '325794610055',
        ],
        'date' => [
            '31999999999',
        ],
    ],
    'Lithuania' => [
        'valid' => [
            '10101010005',
        ],
        'length' => [
            '101010100051',
        ],
        'pattern' => [
            'wwwwwwwwwww',
        ],
        'syntax' => [
            '10101010004',
            '10101010051',
        ],
    ],
    'Luxembourg' => [
        'valid' => [
            '1893120105732',
        ],
        'length' => [
            '18931201057321',
        ],
        'pattern' => [
            'wwwwwwwwwwwww',
        ],
        'syntax' => [
            '1893120105733',
        ],
    ],
    'Malta' => [
        'valid' => [
            '1234567A',
        ],
        'length' => [
            '1234567A1',
        ],
        'syntax' => [
            '1234567W',
        ],
    ],
    'Netherlands' => [
        'valid' => [
            '174559434',
        ],
        'length' => [
            '1745',
        ],
        'pattern' => [
            'wwwwwwwww',
        ],
        'syntax' => [
            '174559435',
        ],
    ],
    'Poland' => [
        'valid' => [
            '2234567895',
            '02070803628',
        ],
        'length' => [
            '2234',
        ],
        'pattern' => [
            'wwwwwwwwwww',
        ],
        'syntax' => [
            '2234567894',
        ],
    ],
    'Portugal' => [
        'valid' => [
            '299999998',
        ],
        'length' => [
            '2999999981',
        ],
        'pattern' => [
            'wwwwwwwww',
        ],
        'syntax' => [
            '299999995',
        ],
    ],
    'Romania' => [
        'valid' => [
            '8001011234567',
        ],
        'length' => [
            '80010112345671',
        ],
        'date' => [
            '8001611234567',
        ],
    ],
    'Slovakia' => [
        'valid' => [
            '7711167420',
        ],
        'length' => [
            '77111674201',
        ],
    ],
    'Slovenia' => [
        'valid' => [
            '15012557',
        ],
        'length' => [
            '150125571',
        ],
        'pattern' => [
            'wwwwwwww',
        ],
        'syntax' => [
            '15012558',
        ],
    ],
    'Spain' => [
        'valid' => [
            '54237A',
            'X1234567L',
            'Y1234567X',
            'Z1234567R',
            'M2812345C',
            'B05327986',
            'P2009300A',
            'K0867756I',
        ],
        'length' => [
            '542372254545445A',
        ],
        'pattern' => [
            'wwwwwwwww',
            'K0867756N',
        ],
        'syntax' => [
            'X1234567Z',
            'P2009300B',
            'K0867756J',
        ],
    ],
    'Sweden' => [
        'valid' => [
            '6408233234',
            '6408833231',
            '196408233234',
            '196408833231',
        ],
        'length' => [
            '64082332341',
        ],
        'pattern' => [
            'wwwwwwwwww',
        ],
        'syntax' => [
            '6408233235',
        ],
    ],
    'UnitedKingdom' => [
        'valid' => [
            '1234567890',
            'AA123456A',
        ],
        'length' => [
            '12345678901',
        ],
        'pattern' => [
            'wwwwwwww',
            'GB123456A',
        ],
    ],
];
