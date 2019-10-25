<?php
namespace Distvan;

/**
 * Class CheckVatResponse
 *
 * @package Distvan
 * @link https://www.dobrenteiistvan.hu
 * @license MIT
 */
class CheckVatResponse
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
    public $name;
    /**
     * @access public
     * @var string
     */
    public $address;
}