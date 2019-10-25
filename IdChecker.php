<?php 
require __DIR__ . '/vendor/autoload.php';

use Distvan\CheckVat;
use Distvan\CheckVatResponse;
use Distvan\CheckVatService;

/**
 * Class Checker
 *
 * @author Istvan Dobrentei
 * @link https://www.dobrenteiistvan.hu
 * @license MIT
 */
class IdChecker
{
    //12345678-1-12
    const HUN_COMPANY_VAT_LENGTH = 11;
    const HUN_COMPANY_VAT_LENGTH_WITH_DASH = 13;

    //HU12345678
    const HUN_EU_VAT_LENGTH = 10;

    /**
     * Megfelelő magyar céges adószám formátum?
     *
     * @param $input
     * @return bool
     */
    public static function isHunCompanyVatFormat($input)
    {
        return (strlen($input) == IdChecker::HUN_COMPANY_VAT_LENGTH_WITH_DASH && substr_count($input, '-') == 2);
    }

    /**
     * Megfelelő nemzetközi céges magyar adószám formátum?
     *
     * @param $input
     * @param $countryCode
     * @return bool
     */
    public static function isHunEuCompanyVatFormat($input, $countryCode='HU')
    {
        switch(strtoupper($countryCode)){
            case 'HU':
                return substr($input, 0, 2) == strtoupper($countryCode) && strlen($input) == IdChecker::HUN_EU_VAT_LENGTH;
                break;
        }

        return false;
    }

    /**
     * Leellenőrzi, hogy a megadott céges adószám helyes formátumú-e
     *
     * @param $input
     * @return bool
     */
    public static function isValidHunCompanyVat($input)
    {
        if(!IdChecker::isHunCompanyVatFormat($input))
        {
            return false;
        }

        //kiszedem a kötőjeleket
        $taxId = str_replace("-", '', $input);

        //ellenörző összeg számítása
        $calculated = ($taxId[0] * 9) + ($taxId[1] * 7) + ($taxId[2] * 3) + ($taxId[3] * 1)
            + ($taxId[4] * 9) + ($taxId[5] * 7) + ($taxId[6] * 3);
        $lastNum = (int)substr($calculated, -1);
        $checkSum = $lastNum == 0 ? $lastNum : 10 - $lastNum;

        //ha az ellenőrzőösszeg megfelelő
        if($checkSum != $taxId[7])
        {
            return false;
        }

        //1 => alanyi adómentes, adómentes
        //2 => általános
        //3 => EVA
        //4, 5 => csoportos adóalanyiság
        if(!in_array($taxId[8], array(1, 2, 3, 4, 5)))
        {
            return false;
        }

        $lastCode = $taxId[9] . $taxId[10];
        if(!in_array($lastCode, array(
                '02', '22', //Baranya
                '03', '23', //Bács-Kiskun
                '04', '24', //Békés
                '05', '25', //Borsod-Abaúj-Zemplén
                '06', '26', //Csongrád
                '07', '27', //Fejér
                '08', '28', //Győr-Moson-Sporon
                '09', '29', //Hajdú-Bihar
                '10', '30', //Heves
                '11', '31', //Komárom-Esztergom
                '12', '32', //Nógrád
                '13', '33', //Pest
                '14', '34', //Somogy
                '15', '35', //Szabolcs-Szatmár-Bereg
                '16', '36', //Jász-Nagykun-Szolnok
                '17', '37', //Tolna
                '18', '38', //Vas
                '19', '39', //Veszprém
                '20', '40', //Zala
                '41', //Észak-Budapest
                '42', //Kelet-Budapest
                '43', //Dél-Budapest
                '44', //Kiemelt Adózók Adóigazgatósága
                '51' //Kiemelt Ügyek Adóigazgatósága
            )
        )
        )
        {
            return false;
        }

        return true;
    }

    /**
     * Leellenőrzi, hogy az adott nemzetközi EU -s adószám érvényes-e
     *
     * @param $input
     */
    public function isValidEuCompanyVat($input)
    {
        $iso_code_2_data = array(
            'AT' => 'AT', //Austria
            'BE' => 'BE', //Belgium
            'BG' => 'BG', //Bulgaria
            'DK' => 'DK', //Denmark
            'FI' => 'FI', //Finland
            'FR' => 'FR', //France
            'FX' => 'FR', //France mÃ©tropolitaine
            'DE' => 'DE', //Germany
            'GR' => 'EL', //Greece
            'IE' => 'IE', //Irland
            'IT' => 'IT', //Italy
            'LU' => 'LU', //Luxembourg
            'NL' => 'NL', //Netherlands
            'PT' => 'PT', //Portugal
            'ES' => 'ES', //Spain
            'SE' => 'SE', //Sweden
            'GB' => 'GB', //United Kingdom
            'CY' => 'CY', //Cyprus
            'EE' => 'EE', //Estonia
            'HU' => 'HU', //Hungary
            'LV' => 'LV', //Latvia
            'LT' => 'LT', //Lithuania
            'MT' => 'MT', //Malta
            'PL' => 'PL', //Poland
            'RO' => 'RO', //Romania
            'SK' => 'SK', //Slovakia
            'CZ' => 'CZ', //Czech Republic
            'SI' => 'SI'  //Slovania
        );

        $prefix = substr($input, 0, 2);
        if (array_search($prefix, $iso_code_2_data))
        {
            $input = str_replace(' ','', substr($input, 2));
        }

        if (array_key_exists($prefix, $iso_code_2_data))
        {
            $checkVatObj = new CheckVat();
            $response = new CheckVatResponse();
            $checkVatObj->countryCode = $iso_code_2_data[$prefix];
            $checkVatObj->vatNumber = $input;
            try
            {
                $service = new CheckVatService();
                $response = $service->checkVat($checkVatObj);
            }
            catch(Exception $e)
            {
                return false;
            }
            return $response->valid;
        }

        return false;
    }
}