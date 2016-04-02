<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exorg\DataCoder;

use Exorg\Decapsulator\ObjectDecapsulator;

/**
 * DatafileDecoderTest.
 * PHPUnit test class for DatafileDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileDecoderTest extends \PHPUnit_Framework_TestCase //AbstractDataDecoderTest
{
    /**
     * Instance of tested class.
     *
     * @var DatafileDecoder
     */
    private $datafileDecoder;

    /**
     * Wrapped by decapsulator
     * tested class instance,
     * with non-public functions and properties
     * accessible.
     *
     * @var ExOrg\Decapsulator\ObjectDecapsulator
     */
    private $datafileDecoderDecapsulated;

    /**
     * Test Exorg\DataCoder\DatafileDecoder class
     * has been implemented.
     */
    public function testDatafileDecoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DatafileDecoder')
        );
    }

    /**
     * Test if setDataFormat($dataFormat) method
     * has been defined.
     */
    public function testSetDataFormatFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->datafileDecoder,
                'setDataFormat'
            )
        );
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper property.
     */
    public function testSetDataFormatFunction()
    {
        $expectedDataFormat = 'FIRSTNONEXISTENT';

        $this->datafileDecoder->setDataFormat($expectedDataFormat);

        $actualDataFormat = $this->datafileDecoderDecapsulated->dataFormat;

        $this->assertEquals($expectedDataFormat, $actualDataFormat);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->initialiseDatafileDecoder();
        $this->initialiseDatafileDecoderDecapsulated();
    }

    /**
     * Initialise DatafileDecoder fixture.
     */
    private function initialiseDatafileDecoder()
    {
        $this->datafileDecoder = new DatafileDecoder();
    }

    /**
     * Initialise DatafileDecoderDecapsulated fixture.
     */
    private function initialiseDatafileDecoderDecapsulated()
    {
        $this->datafileDecoderDecapsulated = ObjectDecapsulator::buildForObject($this->datafileDecoder);
    }
}
