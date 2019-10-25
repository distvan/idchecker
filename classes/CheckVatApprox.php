<?php
namespace Distvan;

/**
 * Class CheckVatApprox
 *
 * @package Distvan
 * @link https://www.dobrenteiistvan.hu
 * @license MIT
 */
class CheckVatApprox
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
     * @var string
     */
    public $requesterCountryCode;
    /**
     * @access public
     * @var string
     */
    public $requesterVatNumber;
}