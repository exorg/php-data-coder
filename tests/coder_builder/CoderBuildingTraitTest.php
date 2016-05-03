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
 * CoderBuildingTraitTest.
 * PHPUnit test class for CoderBuildingTrait trait.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class CoderBuildingTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test Exorg\DatafilesParser\CoderBuildingTrait trait
     * has been implemented.
     */
    public function testCoderBuildingTraitExists()
    {
        $this->assertTrue(
            trait_exists('Exorg\DataCoder\CoderBuildingTrait')
        );
    }

    /**
     * Test if buildCoder() function
     * has been defined.
     */
    public function testBuildCoderFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\CoderBuildingTrait',
                'buildCoder'
            )
        );
    }

    /**
     * Test if buildCoder() function throws an exception
     * when tested trait using class has improper postfix
     * with no assumed coder type.
     * It checks classes either with or without dataFormat.
     *
     * @dataProvider traitUsingClassObjectsWithImproperPostfixProvider
     * @expectedException \Exorg\DataCoder\CoderClassNotFoundException
     * @param mixed $traitUsingClassObject
     */
    public function testBuildCoderWhenTraitUsingClassHasImproperPostfix($traitUsingClassObject)
    {
        $traitUsingClassObject->runBuildCoder();
    }

    /**
     * Test if buildCoder() function throws an exception
     * when tested trait using class has improper prefix
     * with no assumed coder type.
     * It checks classes either with or without dataFormat.
     *
     * @dataProvider traitUsingClassObjectsWithImproperPrefixProvider
     * @expectedException \Exorg\DataCoder\CoderClassNotFoundException
     * @param mixed $traitUsingClassObject
     */
    public function testBuildCoderWhenTraitUsingClassHasImproperPrefix($traitUsingClassObject)
    {
        $traitUsingClassObject->runBuildCoder();
    }

    /**
     * Test if buildCoder() function throws an exception
     * when tested trait using class has improper dataFormat value
     * with no assumed coder type.
     * It checks classes either with or without dataFormat.
     *
     * @dataProvider traitUsingClassObjectsWithImproperDataFormat
     * @expectedException \Exorg\DataCoder\CoderClassNotFoundException
     * @param mixed $traitUsingClassObject
     */
    public function testBuildCoderWhenTraitUsingClassHasImproperDataFormat($traitUsingClassObject)
    {
        $traitUsingClassObject->runBuildCoder();
    }

    /**
     * Test if buildCoder() function does not throw an exception
     * and build Coder instance of the proper class
     * when tested trait using class has proper postfix
     * with assumed coder type.
     * It checks classes either with or without dataFormat.
     *
     * @dataProvider traitUsingClassObjectsAndBuiltCoderClasses
     * @param mixed $traitUsingClassObject
     * @param mixed $expectedCoderObject
     */
    public function testBuildCoderWhenTraitUsingClassHasProperPostfix($traitUsingClassObject, $expectedCoderClass)
    {
        $actualCoderObject = $traitUsingClassObject->runBuildCoder();

        $this->assertInstanceOf($expectedCoderClass, $actualCoderObject);
    }

    /**
     * Tested trait using class objects with improper postfix.
     *
     * @return array
     */
    public function traitUsingClassObjectsWithImproperPostfixProvider()
    {
        return array(
            array(new DummyClassFormat1Nocoder()),
            array(new DummyClassFormat2Nocoder()),
            array(new Format1DummyClassNocoder()),
            array(new Format2DummyClassNocoder()),
        );
    }

    /**
     * Tested trait using class objects with improper prefix.
     *
     * @return array
     */
    public function traitUsingClassObjectsWithImproperPrefixProvider()
    {
        return array(
            array(new FormatnotrecognizedDummyClassEncoder()),
            array(new FormatnotrecognizedDummyClassDecoder()),
        );
    }

    /**
     * Tested trait using class objects with improper dataFormat values.
     *
     * @return array
     */
    public function traitUsingClassObjectsWithImproperDataFormat()
    {
        return array(
            array(new DummyClassFormatNullEncoder()),
            array(new DummyClassFormatNullDecoder()),
            array(new DummyClassFormatNotRecognizedEncoder()),
            array(new DummyClassFormatNotRecognizedDecoder()),
        );
    }

    /**
     * Tested trait using class objects
     * with proper postfixes, prefixes, dataFormat values
     * and classes of the Coder objects
     * should be returned by buildCoder() function.
     *
     * @return array
     */
    public function traitUsingClassObjectsAndBuiltCoderClasses()
    {
        return array(
            array(new DummyClassFormat1Encoder(), __NAMESPACE__ . '\Format1DataEncoder'),
            array(new DummyClassFormat1Decoder(), __NAMESPACE__ . '\Format1DataDecoder'),
            array(new DummyClassFormat2Encoder(), __NAMESPACE__ . '\Format2DataEncoder'),
            array(new DummyClassFormat2Decoder(), __NAMESPACE__ . '\Format2DataDecoder'),
            array(new Format1DummyClassEncoder(), __NAMESPACE__ . '\Format1DataEncoder'),
            array(new Format1DummyClassDecoder(), __NAMESPACE__ . '\Format1DataDecoder'),
            array(new Format2DummyClassEncoder(), __NAMESPACE__ . '\Format2DataEncoder'),
            array(new Format2DummyClassDecoder(), __NAMESPACE__ . '\Format2DataDecoder'),
        );
    }
}
