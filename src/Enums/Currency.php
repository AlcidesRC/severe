<?php

declare(strict_types=1);

namespace Severe\Enums;

enum Currency: string
{
    case AED = 'AED';
    case AFN = 'AFN';
    case ALL = 'ALL';
    case AMD = 'AMD';
    case ANG = 'ANG';
    case AOA = 'AOA';
    case ARS = 'ARS';
    case AUD = 'AUD';
    case AWG = 'AWG';
    case AZN = 'AZN';
    case BAM = 'BAM';
    case BBD = 'BBD';
    case BDT = 'BDT';
    case BGN = 'BGN';
    case BHD = 'BHD';
    case BIF = 'BIF';
    case BMD = 'BMD';
    case BND = 'BND';
    case BOB = 'BOB';
    case BOV = 'BOV';
    case BRL = 'BRL';
    case BSD = 'BSD';
    case BTN = 'BTN';
    case BWP = 'BWP';
    case BYN = 'BYN';
    case BZD = 'BZD';
    case CAD = 'CAD';
    case CDF = 'CDF';
    case CHE = 'CHE';
    case CHF = 'CHF';
    case CHW = 'CHW';
    case CLF = 'CLF';
    case CLP = 'CLP';
    case CNY = 'CNY';
    case COP = 'COP';
    case COU = 'COU';
    case CRC = 'CRC';
    case CUC = 'CUC';
    case CUP = 'CUP';
    case CVE = 'CVE';
    case CZK = 'CZK';
    case DJF = 'DJF';
    case DKK = 'DKK';
    case DOP = 'DOP';
    case DZD = 'DZD';
    case EGP = 'EGP';
    case ERN = 'ERN';
    case ETB = 'ETB';
    case EUR = 'EUR';
    case FJD = 'FJD';
    case FKP = 'FKP';
    case GBP = 'GBP';
    case GEL = 'GEL';
    case GHS = 'GHS';
    case GIP = 'GIP';
    case GMD = 'GMD';
    case GNF = 'GNF';
    case GTQ = 'GTQ';
    case GYD = 'GYD';
    case HKD = 'HKD';
    case HNL = 'HNL';
    case HTG = 'HTG';
    case HUF = 'HUF';
    case IDR = 'IDR';
    case ILS = 'ILS';
    case INR = 'INR';
    case IQD = 'IQD';
    case IRR = 'IRR';
    case ISK = 'ISK';
    case JMD = 'JMD';
    case JOD = 'JOD';
    case JPY = 'JPY';
    case KES = 'KES';
    case KGS = 'KGS';
    case KHR = 'KHR';
    case KMF = 'KMF';
    case KPW = 'KPW';
    case KRW = 'KRW';
    case KWD = 'KWD';
    case KYD = 'KYD';
    case KZT = 'KZT';
    case LAK = 'LAK';
    case LBP = 'LBP';
    case LKR = 'LKR';
    case LRD = 'LRD';
    case LSL = 'LSL';
    case LYD = 'LYD';
    case MAD = 'MAD';
    case MDL = 'MDL';
    case MGA = 'MGA';
    case MKD = 'MKD';
    case MMK = 'MMK';
    case MNT = 'MNT';
    case MOP = 'MOP';
    case MRU = 'MRU';
    case MUR = 'MUR';
    case MVR = 'MVR';
    case MWK = 'MWK';
    case MXN = 'MXN';
    case MXV = 'MXV';
    case MYR = 'MYR';
    case MZN = 'MZN';
    case NAD = 'NAD';
    case NGN = 'NGN';
    case NIO = 'NIO';
    case NOK = 'NOK';
    case NPR = 'NPR';
    case NZD = 'NZD';
    case OMR = 'OMR';
    case PAB = 'PAB';
    case PEN = 'PEN';
    case PGK = 'PGK';
    case PHP = 'PHP';
    case PKR = 'PKR';
    case PLN = 'PLN';
    case PYG = 'PYG';
    case QAR = 'QAR';
    case RON = 'RON';
    case RSD = 'RSD';
    case RUB = 'RUB';
    case RWF = 'RWF';
    case SAR = 'SAR';
    case SBD = 'SBD';
    case SCR = 'SCR';
    case SDG = 'SDG';
    case SEK = 'SEK';
    case SGD = 'SGD';
    case SHP = 'SHP';
    case SLE = 'SLE';
    case SOS = 'SOS';
    case SRD = 'SRD';
    case SSP = 'SSP';
    case STN = 'STN';
    case SVC = 'SVC';
    case SYP = 'SYP';
    case SZL = 'SZL';
    case THB = 'THB';
    case TJS = 'TJS';
    case TMT = 'TMT';
    case TND = 'TND';
    case TOP = 'TOP';
    case TRY = 'TRY';
    case TTD = 'TTD';
    case TWD = 'TWD';
    case TZS = 'TZS';
    case UAH = 'UAH';
    case UGX = 'UGX';
    case USD = 'USD';
    case USN = 'USN';
    case UYI = 'UYI';
    case UYU = 'UYU';
    case UZS = 'UZS';
    case VED = 'VED';
    case VEF = 'VEF';
    case VND = 'VND';
    case VUV = 'VUV';
    case WST = 'WST';
    case XAF = 'XAF';
    case XCD = 'XCD';
    case XDR = 'XDR';
    case XOF = 'XOF';
    case XPF = 'XPF';
    case XSU = 'XSU';
    case XUA = 'XUA';
    case YER = 'YER';
    case ZAR = 'ZAR';
    case ZMW = 'ZMW';
    case ZWL = 'ZWL';

    public function code(): string
    {
        return match ($this) {
            self::AED => '784',
            self::AFN => '971',
            self::ALL => '008',
            self::AMD => '051',
            self::ANG => '532',
            self::AOA => '973',
            self::ARS => '032',
            self::AUD => '036',
            self::AWG => '533',
            self::AZN => '944',
            self::BAM => '977',
            self::BBD => '052',
            self::BDT => '050',
            self::BGN => '975',
            self::BHD => '048',
            self::BIF => '108',
            self::BMD => '060',
            self::BND => '096',
            self::BOB => '068',
            self::BOV => '984',
            self::BRL => '986',
            self::BSD => '044',
            self::BTN => '064',
            self::BWP => '072',
            self::BYN => '933',
            self::BZD => '084',
            self::CAD => '124',
            self::CDF => '976',
            self::CHE => '947',
            self::CHF => '756',
            self::CHW => '948',
            self::CLF => '990',
            self::CLP => '152',
            self::CNY => '156',
            self::COP => '170',
            self::COU => '970',
            self::CRC => '188',
            self::CUC => '931',
            self::CUP => '192',
            self::CVE => '132',
            self::CZK => '203',
            self::DJF => '262',
            self::DKK => '208',
            self::DOP => '214',
            self::DZD => '012',
            self::EGP => '818',
            self::ERN => '232',
            self::ETB => '230',
            self::EUR => '978',
            self::FJD => '242',
            self::FKP => '238',
            self::GBP => '826',
            self::GEL => '981',
            self::GHS => '936',
            self::GIP => '292',
            self::GMD => '270',
            self::GNF => '324',
            self::GTQ => '320',
            self::GYD => '328',
            self::HKD => '344',
            self::HNL => '340',
            self::HTG => '332',
            self::HUF => '348',
            self::IDR => '360',
            self::ILS => '376',
            self::INR => '356',
            self::IQD => '368',
            self::IRR => '364',
            self::ISK => '352',
            self::JMD => '388',
            self::JOD => '400',
            self::JPY => '392',
            self::KES => '404',
            self::KGS => '417',
            self::KHR => '116',
            self::KMF => '174',
            self::KPW => '408',
            self::KRW => '410',
            self::KWD => '414',
            self::KYD => '136',
            self::KZT => '398',
            self::LAK => '418',
            self::LBP => '422',
            self::LKR => '144',
            self::LRD => '430',
            self::LSL => '426',
            self::LYD => '434',
            self::MAD => '504',
            self::MDL => '498',
            self::MGA => '969',
            self::MKD => '807',
            self::MMK => '104',
            self::MNT => '496',
            self::MOP => '446',
            self::MRU => '929',
            self::MUR => '480',
            self::MVR => '462',
            self::MWK => '454',
            self::MXN => '484',
            self::MXV => '979',
            self::MYR => '458',
            self::MZN => '943',
            self::NAD => '516',
            self::NGN => '566',
            self::NIO => '558',
            self::NOK => '578',
            self::NPR => '524',
            self::NZD => '554',
            self::OMR => '512',
            self::PAB => '590',
            self::PEN => '604',
            self::PGK => '598',
            self::PHP => '608',
            self::PKR => '586',
            self::PLN => '985',
            self::PYG => '600',
            self::QAR => '634',
            self::RON => '946',
            self::RSD => '941',
            self::RUB => '643',
            self::RWF => '646',
            self::SAR => '682',
            self::SBD => '090',
            self::SCR => '690',
            self::SDG => '938',
            self::SEK => '752',
            self::SGD => '702',
            self::SHP => '654',
            self::SLE => '925',
            self::SOS => '706',
            self::SRD => '968',
            self::SSP => '728',
            self::STN => '930',
            self::SVC => '222',
            self::SYP => '760',
            self::SZL => '748',
            self::THB => '764',
            self::TJS => '972',
            self::TMT => '934',
            self::TND => '788',
            self::TOP => '776',
            self::TRY => '949',
            self::TTD => '780',
            self::TWD => '901',
            self::TZS => '834',
            self::UAH => '980',
            self::UGX => '800',
            self::USD => '840',
            self::USN => '997',
            self::UYI => '940',
            self::UYU => '858',
            self::UZS => '860',
            self::VED => '926',
            self::VEF => '937',
            self::VND => '704',
            self::VUV => '548',
            self::WST => '882',
            self::XAF => '950',
            self::XCD => '951',
            self::XDR => '960',
            self::XOF => '952',
            self::XPF => '953',
            self::XSU => '994',
            self::XUA => '965',
            self::YER => '886',
            self::ZAR => '710',
            self::ZMW => '967',
            self::ZWL => '932',
        };
    }

    public function name(): string
    {
        return match ($this) {
            self::AED => 'UAE Dirham',
            self::AFN => 'Afghani',
            self::ALL => 'Lek',
            self::AMD => 'Armenian Dram',
            self::ANG => 'Netherlands Antillean Guilder',
            self::AOA => 'Kwanza',
            self::ARS => 'Argentine Peso',
            self::AUD => 'Australian Dollar',
            self::AWG => 'Aruban Florin',
            self::AZN => 'Azerbaijanian Manat',
            self::BAM => 'Convertible Mark',
            self::BBD => 'Barbados Dollar',
            self::BDT => 'Taka',
            self::BGN => 'Bulgarian Lev',
            self::BHD => 'Bahraini Dinar',
            self::BIF => 'Burundi Franc',
            self::BMD => 'Bermudian Dollar',
            self::BND => 'Brunei Dollar',
            self::BOB => 'Boliviano',
            self::BOV => 'Mvdol',
            self::BRL => 'Brazilian Israeli',
            self::BSD => 'Bahamian Dollar',
            self::BTN => 'Ngultrum',
            self::BWP => 'Pula',
            self::BYN => 'Belarussian Ruble',
            self::BZD => 'Belize Dollar',
            self::CAD => 'Canadian Dollar',
            self::CDF => 'Congolese Franc',
            self::CHE => 'WIR Euro',
            self::CHF => 'Swiss Franc',
            self::CHW => 'WIR Franc',
            self::CLF => 'Unidad de Fomento',
            self::CLP => 'Chilean Peso',
            self::CNY => 'Yuan Renminbi',
            self::COP => 'Colombian Peso',
            self::COU => 'Unidad de Valor Real',
            self::CRC => 'Costa Rican Colon',
            self::CUC => 'Peso Convertible',
            self::CUP => 'Cuban Peso',
            self::CVE => 'Cabo Verde Escudo',
            self::CZK => 'Czech Koruna',
            self::DJF => 'Djibouti Franc',
            self::DKK => 'Danish Krone',
            self::DOP => 'Dominican Peso',
            self::DZD => 'Algerian Dinar',
            self::EGP => 'Egyptian Pound',
            self::ERN => 'Nakfa',
            self::ETB => 'Ethiopian Birr',
            self::EUR => 'Euro',
            self::FJD => 'Fiji Dollar',
            self::FKP => 'Falkland Islands Pound',
            self::GBP => 'Pound Sterling',
            self::GEL => 'Lari',
            self::GHS => 'Ghana Cedi',
            self::GIP => 'Gibraltar Pound',
            self::GMD => 'Dalasi',
            self::GNF => 'Guinea Franc',
            self::GTQ => 'Quetzal',
            self::GYD => 'Guyana Dollar',
            self::HKD => 'Hong Kong Dollar',
            self::HNL => 'Lempira',
            self::HTG => 'Gourde',
            self::HUF => 'Forint',
            self::IDR => 'Rupiah',
            self::ILS => 'New Israeli Sheqel',
            self::INR => 'Indian Rupee',
            self::IQD => 'Iraqi Dinar',
            self::IRR => 'Iranian Rial',
            self::ISK => 'Iceland Krona',
            self::JMD => 'Jamaican Dollar',
            self::JOD => 'Jordanian Dinar',
            self::JPY => 'Yen',
            self::KES => 'Kenyan Shilling',
            self::KGS => 'Som',
            self::KHR => 'Riel',
            self::KMF => 'Comoro Franc',
            self::KPW => 'North Korean Won',
            self::KRW => 'Won',
            self::KWD => 'Kuwaiti Dinar',
            self::KYD => 'Cayman Islands Dollar',
            self::KZT => 'Tenge',
            self::LAK => 'Kip',
            self::LBP => 'Lebanese Pound',
            self::LKR => 'Sri Lanka Rupee',
            self::LRD => 'Liberian Dollar',
            self::LSL => 'Loti',
            self::LYD => 'Libyan Dinar',
            self::MAD => 'Moroccan Dirham',
            self::MDL => 'Moldovan Leu',
            self::MGA => 'Malagasy Ariary',
            self::MKD => 'Denar',
            self::MMK => 'Kyat',
            self::MNT => 'Tugrik',
            self::MOP => 'Pataca',
            self::MRU => 'Ouguiya',
            self::MUR => 'Mauritius Rupee',
            self::MVR => 'Rufiyaa',
            self::MWK => 'Kwacha',
            self::MXN => 'Mexican Peso',
            self::MXV => 'Mexican Unidad de Inversion (UDI)',
            self::MYR => 'Malaysian Ringgit',
            self::MZN => 'Mozambique Metical',
            self::NAD => 'Namibia Dollar',
            self::NGN => 'Naira',
            self::NIO => 'Cordoba Oro',
            self::NOK => 'Norwegian Krone',
            self::NPR => 'Nepalese Rupee',
            self::NZD => 'New Zealand Dollar',
            self::OMR => 'Rial Omani',
            self::PAB => 'Balboa',
            self::PEN => 'Nuevo Sol',
            self::PGK => 'Kina',
            self::PHP => 'Philippine Peso',
            self::PKR => 'Pakistan Rupee',
            self::PLN => 'Zloty',
            self::PYG => 'Guarani',
            self::QAR => 'Qatari Rial',
            self::RON => 'Romanian Leu',
            self::RSD => 'Serbian Dinar',
            self::RUB => 'Russian Ruble',
            self::RWF => 'Rwanda Franc',
            self::SAR => 'Saudi Riyal',
            self::SBD => 'Solomon Islands Dollar',
            self::SCR => 'Seychelles Rupee',
            self::SDG => 'Sudanese Pound',
            self::SEK => 'Swedish Krona',
            self::SGD => 'Singapore Dollar',
            self::SHP => 'Saint Helena Pound',
            self::SLE => 'Leone',
            self::SOS => 'Somali Shilling',
            self::SRD => 'Surinam Dollar',
            self::SSP => 'South Sudanese Pound',
            self::STN => 'Dobra',
            self::SVC => 'El Salvador Colon',
            self::SYP => 'Syrian Pound',
            self::SZL => 'Lilangeni',
            self::THB => 'Baht',
            self::TJS => 'Somoni',
            self::TMT => 'Turkmenistan New Manat',
            self::TND => 'Tunisian Dinar',
            self::TOP => 'Pa’anga',
            self::TRY => 'Turkish Lira',
            self::TTD => 'Trinidad and Tobago Dollar',
            self::TWD => 'New Taiwan Dollar',
            self::TZS => 'Tanzanian Shilling',
            self::UAH => 'Hryvnia',
            self::UGX => 'Uganda Shilling',
            self::USD => 'US Dollar',
            self::USN => 'US Dollar (Next day)',
            self::UYI => 'Uruguay Peso en Unidades Indexadas (URUIURUI)',
            self::UYU => 'Peso Uruguayo',
            self::UZS => 'Uzbekistan Sum',
            self::VED => 'Bolivar',
            self::VEF => 'Bolivar',
            self::VND => 'Dong',
            self::VUV => 'Vatu',
            self::WST => 'Tala',
            self::XAF => 'CFA Franc BEAC',
            self::XCD => 'East Caribbean Dollar',
            self::XDR => 'SDR (Special Drawing Right)',
            self::XOF => 'CFA Franc BCEAO',
            self::XPF => 'CFP Franc',
            self::XSU => 'Sucre',
            self::XUA => 'ADB Unit of Account',
            self::YER => 'Yemeni Rial',
            self::ZAR => 'Rand',
            self::ZMW => 'Zambian Kwacha',
            self::ZWL => 'Zimbabwe Dollar',
        };
    }

    public function decimals(): int
    {
        return match ($this) {
            self::AED => 2,
            self::AFN => 2,
            self::ALL => 2,
            self::AMD => 2,
            self::ANG => 2,
            self::AOA => 2,
            self::ARS => 2,
            self::AUD => 2,
            self::AWG => 2,
            self::AZN => 2,
            self::BAM => 2,
            self::BBD => 2,
            self::BDT => 2,
            self::BGN => 2,
            self::BHD => 3,
            self::BIF => 0,
            self::BMD => 2,
            self::BND => 2,
            self::BOB => 2,
            self::BOV => 2,
            self::BRL => 2,
            self::BSD => 2,
            self::BTN => 2,
            self::BWP => 2,
            self::BYN => 2,
            self::BZD => 2,
            self::CAD => 2,
            self::CDF => 2,
            self::CHE => 2,
            self::CHF => 2,
            self::CHW => 2,
            self::CLF => 4,
            self::CLP => 0,
            self::CNY => 2,
            self::COP => 2,
            self::COU => 2,
            self::CRC => 2,
            self::CUC => 2,
            self::CUP => 2,
            self::CVE => 2,
            self::CZK => 2,
            self::DJF => 0,
            self::DKK => 2,
            self::DOP => 2,
            self::DZD => 2,
            self::EGP => 2,
            self::ERN => 2,
            self::ETB => 2,
            self::EUR => 2,
            self::FJD => 2,
            self::FKP => 2,
            self::GBP => 2,
            self::GEL => 2,
            self::GHS => 2,
            self::GIP => 2,
            self::GMD => 2,
            self::GNF => 0,
            self::GTQ => 2,
            self::GYD => 2,
            self::HKD => 2,
            self::HNL => 2,
            self::HTG => 2,
            self::HUF => 2,
            self::IDR => 2,
            self::ILS => 2,
            self::INR => 2,
            self::IQD => 3,
            self::IRR => 2,
            self::ISK => 0,
            self::JMD => 2,
            self::JOD => 3,
            self::JPY => 0,
            self::KES => 2,
            self::KGS => 2,
            self::KHR => 2,
            self::KMF => 0,
            self::KPW => 2,
            self::KRW => 0,
            self::KWD => 3,
            self::KYD => 2,
            self::KZT => 2,
            self::LAK => 2,
            self::LBP => 2,
            self::LKR => 2,
            self::LRD => 2,
            self::LSL => 2,
            self::LYD => 3,
            self::MAD => 2,
            self::MDL => 2,
            self::MGA => 2,
            self::MKD => 2,
            self::MMK => 2,
            self::MNT => 2,
            self::MOP => 2,
            self::MRU => 2,
            self::MUR => 2,
            self::MVR => 2,
            self::MWK => 2,
            self::MXN => 2,
            self::MXV => 2,
            self::MYR => 2,
            self::MZN => 2,
            self::NAD => 2,
            self::NGN => 2,
            self::NIO => 2,
            self::NOK => 2,
            self::NPR => 2,
            self::NZD => 2,
            self::OMR => 3,
            self::PAB => 2,
            self::PEN => 2,
            self::PGK => 2,
            self::PHP => 2,
            self::PKR => 2,
            self::PLN => 2,
            self::PYG => 0,
            self::QAR => 2,
            self::RON => 2,
            self::RSD => 2,
            self::RUB => 2,
            self::RWF => 0,
            self::SAR => 2,
            self::SBD => 2,
            self::SCR => 2,
            self::SDG => 2,
            self::SEK => 2,
            self::SGD => 2,
            self::SHP => 2,
            self::SLE => 2,
            self::SOS => 2,
            self::SRD => 2,
            self::SSP => 2,
            self::STN => 2,
            self::SVC => 2,
            self::SYP => 2,
            self::SZL => 2,
            self::THB => 2,
            self::TJS => 2,
            self::TMT => 2,
            self::TND => 3,
            self::TOP => 2,
            self::TRY => 2,
            self::TTD => 2,
            self::TWD => 2,
            self::TZS => 2,
            self::UAH => 2,
            self::UGX => 2,
            self::USD => 2,
            self::USN => 2,
            self::UYI => 0,
            self::UYU => 2,
            self::UZS => 2,
            self::VED => 2,
            self::VEF => 2,
            self::VND => 0,
            self::VUV => 0,
            self::WST => 2,
            self::XAF => 0,
            self::XCD => 2,
            self::XDR => 2,
            self::XOF => 0,
            self::XPF => 0,
            self::XSU => 2,
            self::XUA => 2,
            self::YER => 2,
            self::ZAR => 2,
            self::ZMW => 2,
            self::ZWL => 2,
        };
    }
}
