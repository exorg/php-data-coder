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
 * DecodingClassNameBasedTraitTest.
 * PHPUnit test class for DecodingClassNameBasedTrait trait.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DecodingClassNameBasedTraitTest extends \PHPUnit_Framework_TestCase
{
    use DecodingClassNameBasedTrait;

    /**
     * Test Exorg\DatafilesParser\DecodingClassNameBasedTrait trait
     * has been implemented.
     */
    public function testDecodingClassNameBasedTraitExists()
    {
        $this->assertTrue(
            trait_exists('Exorg\DataCoder\DecodingClassNameBasedTrait')
        );
    }

    /**
     * Test if buildDecoderForClassName($className) function
     * has been defined.
     */
    public function testBuildDecoderForDataFormatFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DecodingClassNameBasedTrait',
                'buildDecoderForClassName'
            )
        );
    }

    /**
     * Test if buildDecoderForClassName throws exception
     * when cannot find Decoder class for given className.
     *
     * @expectedException Exorg\DataCoder\DecoderClassNotFoundException
     */
    public function testBuildDecoderForClassNameFunctionWhenDecoderDoesNotExist()
    {
        $className = 'NonexistentFileDecoder';

        $this->buildDecoderForClassName($className);
    }

    /**
     * @dataProvider classNameDecoderProvider
     */
    public function testBuildDecoderForClassNameFunctionWhenDecoderExists($className, $dataDecoderClass)
    {
        $dataDecoder = $this->buildDecoderForClassName($className);

        $this->assertInstanceOf($dataDecoderClass, $dataDecoder);
    }

    /**
     * Data provider
     * for testing className argument
     * passed to buildDecoderForClassName function
     * and it's transformation to the Decoder class.
     *
     * @return array
     */
    public function classNameDecoderProvider()
    {
        $namespace = '\Exorg\DataCoder\\';

        return array(
            array('FirstnonexistentFileDecoder', $namespace . 'FirstnonexistentDataDecoder'),
            array('SecondnonexistentFileDecoder', $namespace . 'SecondnonexistentDataDecoder'),
            array('ThirdnonexistentFileDecoder', $namespace . 'ThirdnonexistentDataDecoder'),
        );
    }
}
