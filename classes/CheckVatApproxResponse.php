<?php

namespace Distvan;

/**
 * Class CheckVatApproxResponse
 * 
 * @package Distvan
 * @link https://www.dobrenteiistvan.hu
 * @license MIT
 */
class CheckVatApproxResponse
{
    /**
     * @access public
     * @var string
     */
    public $countryCode;
    /**
     * @access public
     * @var string
     */
    public $vatNumber;
    /**
     * @access public
     * @var date
     */
    public $requestDate;
    /**
     * @access public
     * @var boolean
     */
    public $valid;
    /**
     * @access public
     * @var string
     */
    public $traderName;
    /**
     * @access public
     * @var tns1companyTypeCode
     */
    public $traderCompanyType;
    /**
     * @access public
     * @var string
     */
    public $traderAddress;
    /**
     * @access public
     * @var string
     */
    public $traderStreet;
    /**
     * @access public
     * @var string
     */
    public $traderPostcode;
    /**
     * @access public
     * @var string
     */
    public $traderCity;
    /**
     * @access public
     * @var tns1matchCode
     */
    public $traderNameMatch;
    /**
     * @access public
     * @var tns1matchCode
     */
    public $traderCompanyTypeMatch;
    /**
     * @access public
     * @var tns1matchCode
     */
    public $traderStreetMatch;
    /**
     * @access public
     * @var tns1matchCode
     */
    public $traderPostcodeMatch;
    /**
     * @access public
     * @var tns1matchCode
     */
    public $traderCityMatch;
    /**
     * @access public
     * @var string
     */
    public $requestIdentifier;
}