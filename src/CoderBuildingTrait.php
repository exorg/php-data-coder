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
 * CoderBuildingTrait.
 * Allows to create a proper data coder
 * of the proper type (encoder/decoder)
 * and processing proper data format.
 * This coder building process is based on dataFormat property
 * and the name of using class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
trait CoderBuildingTrait
{
    /**
     * Name of the class that uses trait
     * without namespace.
     *
     * @var string
     */
    private $currentClassName;

    /**
     * Name of the class that uses trait
     * without namespace
     * divided into segments
     * begun with upper case letter.
     *
     * @var string
     */
    private $currentClassNameSegments;

    /**
     * Builds instance of a proper data coder
     * of the proper type (encoder/decoder)
     * and processing proper data format.
     */
    private function buildCoder()
    {
        $coderClassName = $this->buildCoderClassName();

        $coderClassExists = class_exists($coderClassName);

        if (!$coderClassExists) {
            throw new CoderClassNotFoundException(
                'Data Coder class '
                . $coderClassName
                . ' not found.'
            );
        }

        $dataCoder = new $coderClassName();

        return $dataCoder;
    }

    /**
     * Builds name of a proper data coder class
     * of the proper type (encoder/decoder)
     * and processing proper data format.
     *
     * @return string
     */
    private function buildCoderClassName()
    {
        $this->currentClassName = $this->extractCurrentClassName();
        $this->currentClassNameSegments = $this->splitCurrentClassName();
        $coderTypePostfix = $this->extractCurrentClassNamePostfix();

        if ($this->dataFormatIsDefined()) {
            $dataFormatPrefix = ucfirst(strtolower($this->dataFormat));
        } else {
            $dataFormatPrefix = $this->extractCurrentClassNamePrefix();
        }

        $coderClassName = __NAMESPACE__
            . '\\'
            . $dataFormatPrefix
            . 'Data'
            . $coderTypePostfix;

        return $coderClassName;
    }

    /**
     * Extracts class name of current class
     * from the whole namespaced path.
     *
     * @return string
     */
    private function extractCurrentClassName()
    {
        $classNamespacedPathParts = split('\\\\', __CLASS__);
        $className = array_pop($classNamespacedPathParts);

        return $className;
    }

    /**
     * Splits current class name up
     * into segmants
     * begun with upper case letter.
     *
     * @return array:
     */
    private function splitCurrentClassName()
    {
        $classNameParts = preg_split('/(?=[A-Z])/', $this->currentClassName, null, PREG_SPLIT_NO_EMPTY);

        return $classNameParts;
    }

    /**
     * Extracts name prefix of current class.
     * Prefix means first word
     * of the pascal case class name.
     */
    private function extractCurrentClassNamePrefix()
    {
        $classNamePrefix = array_shift($this->currentClassNameSegments);

        return $classNamePrefix;
    }

    /**
     * Extracts name postfix of current class.
     * Postfix means the last word
     * of the pascal case class name.
     */
    private function extractCurrentClassNamePostfix()
    {
        $classNamePostfix = array_pop($this->currentClassNameSegments);

        return $classNamePostfix;
    }

    /**
     * Checks if dataFormat property is defined
     * in the current class.
     *
     * @return boolean
     */
    private function dataFormatIsDefined()
    {
        $dataFormatIsDefined = property_exists(__CLASS__, 'dataFormat')
            && (!is_null($this->dataFormat));

        return $dataFormatIsDefined;
    }
}
