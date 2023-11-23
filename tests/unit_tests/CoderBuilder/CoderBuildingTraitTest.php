<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\CoderBuilder;

use PHPUnit\Framework\TestCase;

/**
 * CoderBuildingTraitTest.
 * PHPUnit test class for CoderBuildingTrait trait.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class CoderBuildingTraitTest extends TestCase
{
    /**
     * Namespace of the dummy coders classes
     * used to test trait.
     */
    const CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE = 'ExOrg\DataCoder\CoderBuildingTraitUsing';
    const CODERS_NAMESPACE = 'ExOrg\DataCoder\Coder';

    const CODE_BUILDING_TRAIT_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\CoderBuilder\CoderBuildingTrait';
    const CODER_CLASS_NOT_FOUND_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\CoderBuilder\CoderClassNotFoundException';

    /**
     * Test ExOrg\DatafilesParser\CoderBuildingTrait trait
     * has been implemented.
     */
    public function testCoderBuildingTraitExists()
    {
        $this->assertTrue(
            trait_exists(self::CODE_BUILDING_TRAIT_FULLY_QUALIFIED_CLASS_NAME)
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
                self::CODE_BUILDING_TRAIT_FULLY_QUALIFIED_CLASS_NAME,
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
        $this->expectException(self::CODER_CLASS_NOT_FOUND_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

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
        $this->expectException(self::CODER_CLASS_NOT_FOUND_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

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
        $this->expectException(self::CODER_CLASS_NOT_FOUND_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

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
    public static function traitUsingClassObjectsWithImproperPostfixProvider()
    {
        return [
            // Classes with explicitly defined dataFormat
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\DummyClassFormat1Nocoder')()],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\DummyClassFormat2Nocoder')()],
            // Classes with no explicitly defined dataFormat (it's established from the class name first part)
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\Format1DummyClassNocoder')()],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\Format2DummyClassNocoder')()],
        ];
    }

    /**
     * Provide objects of the classes that use tested trait
     * and have improper prefix.
     *
     * @return array
     */
    public static function traitUsingClassObjectsWithImproperPrefixProvider()
    {
        return [
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\FormatnotrecognizedDummyClassEncoder')()],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\FormatnotrecognizedDummyClassDecoder')()],
        ];
    }

    /**
     * Provide objects of the classes that use tested trait
     * and have improper dataFormat values.
     *
     * @return array
     */
    public static function traitUsingClassObjectsWithImproperDataFormatProvider()
    {
        return [
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\DummyClassFormatNullEncoder')()],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\DummyClassFormatNullDecoder')()],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\DummyClassFormatNotRecognizedEncoder')()],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\DummyClassFormatNotRecognizedDecoder')()],
        ];
    }

    /**
     * Provide objects of the classes that use tested trait
     * and have improper proper postfixes, prefixes and dataFormat values
     * and classes of the Coder objects
     * should be returned by buildCoder function.
     *
     * @return array
     */
    public static function traitUsingClassObjectsAndBuiltCoderClassesProvider()
    {
        return [
            // Classes with explicitly defined dataFormat
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\DummyClassFormat1Encoder')(), self::CODERS_NAMESPACE . '\Format1\Data\Encoder'],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\DummyClassFormat1Decoder')(), self::CODERS_NAMESPACE . '\Format1\Data\Decoder'],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\DummyClassFormat2Encoder')(), self::CODERS_NAMESPACE . '\Format2\Data\Encoder'],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\DummyClassFormat2Decoder')(), self::CODERS_NAMESPACE . '\Format2\Data\Decoder'],
            // Classes with no explicitly defined dataFormat (it's established from the class name first part)
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\Format1DummyClassEncoder')(), self::CODERS_NAMESPACE . '\Format1\Data\Encoder'],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\Format1DummyClassDecoder')(), self::CODERS_NAMESPACE . '\Format1\Data\Decoder'],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\Format2DummyClassEncoder')(), self::CODERS_NAMESPACE . '\Format2\Data\Encoder'],
            [new (self::CODER_BUILDING_TRAIT_USING_CODERS_NAMESPACE . '\Format2DummyClassDecoder')(), self::CODERS_NAMESPACE . '\Format2\Data\Decoder'],
        ];
    }
}
