<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/IdChecker.php';
use PHPUnit\Framework\TestCase;

final class IdCheckerTest extends TestCase
{
    public function testInvalidHunComapanyVat()
    {
        $invalidValues = array(
            '1234',
            '1234567890000',
            '12345678-11-0',
            '12345678-6-99',
            '1234567-0-00',
            'HU1234567',
        );

        foreach($invalidValues as $value)
        {
            $this->assertFalse(IdChecker::isValidHunCompanyVat($value));
        }
    }

    public function testValidHunCompanyVat()
    {
        $validValues = array(
            '23856455-1-42'
        );

        foreach($validValues as $value)
        {
            $this->assertTrue(IdChecker::isValidHunCompanyVat($value));
        }
    }

    public function testInvalidHunEuCompanyVat()
    {
        $invalidValues = array(
            'ABC12345678',
            'HU123456789',
            'HU12345678910',
            'HU1234',
            'HUHUHU',
            '0',
            'HU',
            '1234567890'
        );

        $checker = new IdChecker();
        foreach($invalidValues as $value)
        {
            $this->assertFalse($checker->isValidEuCompanyVat($value));
        }
    }

    public function testValidHunEuCompanyVat()
    {
        $validValues = array(
            'HU23856455'
        );

        $checker = new IdChecker();
        foreach($validValues as $value)
        {
            $this->assertTrue($checker->isValidEuCompanyVat($value));
        }
    }
}