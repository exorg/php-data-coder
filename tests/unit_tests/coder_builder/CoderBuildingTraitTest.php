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

use PHPUnit\Framework\TestCase;

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
class CoderBuildingTraitTest extends TestCase
{
    /**
     * Namespace of the dummy coders classes
     * used to test trait.
     */
    const DUMMY_CODERS_NAMESPACE = __NAMESPACE__;

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
     * Test if buildCoder function
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
     * Test if buildCoder function throws an exception
     * when class using tested trait has improper postfix
     * with no assumed coder type.
     * It checks classes either with or without dataFormat.
     *
     * @dataProvider traitUsingClassObjectsWithImproperPostfixProvider
     * @param mixed $traitUsingClassObject
     */
    public function testBuildCoderWhenTraitUsingClassHasImproperPostfix($traitUsingClassObject)
    {
        $this->expectException('\Exorg\DataCoder\CoderClassNotFoundException');

        $traitUsingClassObject->runBuildCoder();
    }

    /**
     * Test if buildCoder function throws an exception
     * when class using tested trait has improper prefix
     * with no assumed data format.
     *
     * @dataProvider traitUsingClassObjectsWithImproperPrefixProvider
     * @param mixed $traitUsingClassObject
     */
    public function testBuildCoderWhenTraitUsingClassHasImproperPrefix($traitUsingClassObject)
    {
        $this->expectException('\Exorg\DataCoder\CoderClassNotFoundException');

        $traitUsingClassObject->runBuildCoder();
    }

    /**
     * Test if buildCoder function throws an exception
     * when tested trait using class has improper dataFormat value.
     *
     * @dataProvider traitUsingClassObjectsWithImproperDataFormatProvider
     * @param mixed $traitUsingClassObject
     */
    public function testBuildCoderWhenTraitUsingClassHasImproperDataFormat($traitUsingClassObject)
    {
        $this->expectException('\Exorg\DataCoder\CoderClassNotFoundException');

        $traitUsingClassObject->runBuildCoder();
    }

    /**
     * Test if buildCoder function does not throw an exception
     * and build Coder instance of the proper class
     * when tested trait using class has proper postfix
     * with assumed coder type.
     * It checks classes either with or without dataFormat.
     *
     * @dataProvider traitUsingClassObjectsAndBuiltCoderClassesProvider
     * @param mixed $traitUsingClassObject
     * @param mixed $expectedCoderObject
     */
    public function testBuildCoder($traitUsingClassObject, $expectedCoderClass)
    {
        $actualCoderObject = $traitUsingClassObject->runBuildCoder();

        $this->assertInstanceOf($expectedCoderClass, $actualCoderObject);
    }

    /**
     * Provide objects of the classes that use tested trait
     * and have improper postfix.
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
     * Provide objects of the classes that use tested trait
     * and have improper prefix.
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
     * Provide objects of the classes that use tested trait
     * and have improper dataFormat values.
     *
     * @return array
     */
    public function traitUsingClassObjectsWithImproperDataFormatProvider()
    {
        return array(
            array(new DummyClassFormatNullEncoder()),
            array(new DummyClassFormatNullDecoder()),
            array(new DummyClassFormatNotRecognizedEncoder()),
            array(new DummyClassFormatNotRecognizedDecoder()),
        );
    }

    /**
     * Provide objects of the classes that use tested trait
     * and have improper proper postfixes, prefixes and dataFormat values
     * and classes of the Coder objects
     * should be returned by buildCoder function.
     *
     * @return array
     */
    public function traitUsingClassObjectsAndBuiltCoderClassesProvider()
    {
        return array(
            array(new DummyClassFormat1Encoder(), self::DUMMY_CODERS_NAMESPACE . '\Format1DataEncoder'),
            array(new DummyClassFormat1Decoder(), self::DUMMY_CODERS_NAMESPACE . '\Format1DataDecoder'),
            array(new DummyClassFormat2Encoder(), self::DUMMY_CODERS_NAMESPACE . '\Format2DataEncoder'),
            array(new DummyClassFormat2Decoder(), self::DUMMY_CODERS_NAMESPACE . '\Format2DataDecoder'),
            array(new Format1DummyClassEncoder(), self::DUMMY_CODERS_NAMESPACE . '\Format1DataEncoder'),
            array(new Format1DummyClassDecoder(), self::DUMMY_CODERS_NAMESPACE . '\Format1DataDecoder'),
            array(new Format2DummyClassEncoder(), self::DUMMY_CODERS_NAMESPACE . '\Format2DataEncoder'),
            array(new Format2DummyClassDecoder(), self::DUMMY_CODERS_NAMESPACE . '\Format2DataDecoder'),
        );
    }
}
