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

/**
 * DecodingDataFormatBasedTraitTest.
 * PHPUnit test class for DecodingDataFormatBasedTrait trait.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DecodingDataFormatBasedTraitTest extends \PHPUnit_Framework_TestCase
{
    use DecodingDataFormatBasedTrait;

    /**
     * Test Exorg\DatafilesParser\DecodingDataFormatBasedTrait trait
     * has been implemented.
     */
    public function testDecodingDataFormatBasedTraitExists()
    {
        $this->assertTrue(
            trait_exists('Exorg\DataCoder\DecodingDataFormatBasedTrait')
        );
    }

    /**
     * Test if buildDecoderForDataFormat($dataFormat) function
     * has been defined.
     */
    public function testBuildDecoderForDataFormatFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DecodingDataFormatBasedTrait',
                'buildDecoderForDataFormat'
            )
        );
    }

    /**
     * Test if buildDecoderForDataFormat throws exception
     * when cannot find Decoder class for given data format.
     *
     * @expectedException Exorg\DataCoder\DecoderClassNotFoundException
     */
    public function testBuildDecoderForDataFormatFunctionWhenDecoderDoesNotExist()
    {
        $dataFormat = 'nonexistent';

        $this->buildDecoderForDataFormat($dataFormat);
    }

    /**
     * @dataProvider formatDecoderProvider
     */
    public function testBuildDecoderForDataFormatFunctionWhenDecoderExists($dataFormat, $dataDecoderClass)
    {
        $dataDecoder = $this->buildDecoderForDataFormat($dataFormat);

        $this->assertInstanceOf($dataDecoderClass, $dataDecoder);
    }

    /**
     * Data provider
     * for testing dataFromat argument
     * passed to buildDecoderForDataFormat function
     * and it's transformation to the Decoder class.
     *
     * @return array
     */
    public function formatDecoderProvider()
    {
        $namespace = '\Exorg\DataCoder\\';

        return array(
            array('firstnonexistent', $namespace . 'FirstnonexistentDataDecoder'),
            array('SECONDNONEXISTENT', $namespace . 'SecondnonexistentDataDecoder'),
            array('ThirdNonexistent', $namespace . 'ThirdnonexistentDataDecoder'),
        );
    }
}
