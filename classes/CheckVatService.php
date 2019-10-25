<?php

namespace Distvan;

use SoapClient;
use Exception;

/**
 * Class CheckVatService
 *
 * @package Distvan
 * @link https://www.dobrenteiistvan.hu
 * @license MIT
 */
class CheckVatService extends SoapClient
{
    /**
     * Default class map for wsdl=>php
     * @access private
     * @var array
     */
    private static $classmap = array(
        "checkVat" => "Distvan\CheckVat",
        "checkVatResponse" => "Distvan\CheckVatResponse",
        "checkVatApprox" => "Distvan\CheckVatApprox",
        "checkVatApproxResponse" => "Distvan\CheckVatApproxResponse",
        "companyTypeCode" => "Distvan\CompanyTypeCode",
        "matchCode" => "Distvan\MatchCode",
    );

    /**
     * Constructor using wsdl location and options array
     * @param string $wsdl WSDL location for this service
     * @param array $options Options for the SoapClient
     */
    public function __construct($wsdl="http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl", $options=array()) {
        foreach(self::$classmap as $wsdlClassName => $phpClassName) {
            if(!isset($options['classmap'][$wsdlClassName])) {
                $options['classmap'][$wsdlClassName] = $phpClassName;
            }
        }
        parent::__construct($wsdl, $options);
    }

    /**
     * Checks if an argument list matches against a valid argument type list
     * @param array $arguments The argument list to check
     * @param array $validParameters A list of valid argument types
     * @return boolean true if arguments match against validParameters
     * @throws Exception invalid function signature message
     */
    public function _checkArguments($arguments, $validParameters) {
        $variables = "";
        foreach ($arguments as $arg) {
            $type = gettype($arg);
            if ($type == "object") {
                $type = get_class($arg);
            }
            $variables .= "(".$type.")";
        }
        if (!in_array($variables, $validParameters)) {
            throw new Exception("Invalid parameter types: ".str_replace(")(", ", ", $variables));
        }
        return true;
    }

    /**
     * Service Call: checkVat
     * Parameter options:
     * (checkVat) parameters
     * @param mixed,... See function description for parameter options
     * @return checkVatResponse
     * @throws Exception invalid function signature message
     */
    public function checkVat($mixed = null) {
        $validParameters = array(
            "(Distvan\CheckVat)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("checkVat", $args);
    }


    /**
     * Service Call: checkVatApprox
     * Parameter options:
     * (checkVatApprox) parameters
     * @param mixed,... See function description for parameter options
     * @return checkVatApproxResponse
     * @throws Exception invalid function signature message
     */
    public function checkVatApprox($mixed = null) {
        $validParameters = array(
            "(checkVatApprox)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("checkVatApprox", $args);
    }
}