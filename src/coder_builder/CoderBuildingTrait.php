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
 * and the name of the class using this trait.
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
     * Name of the class (without namespace)
     * that uses trait.
     *
     * @var string
     */
    private $currentClassName;

    /**
     * Name of the class (without namespace)
     * that uses trait,
     * divided into segments
     * begun with upper case letter.
     *
     * @var string
     */
    private $currentClassNameSegments;

    /**
     * Build instance of a proper data coder
     * of the proper type (encoder/decoder)
     * and processing proper data format.
     */
    private function buildCoder()
    {
        $coderClassName = $this->buildCoderClassName();

        $this->validateCoderClassExistance($coderClassName);

        $dataCoder = new $coderClassName();

        return $dataCoder;
    }

    /**
     * Build name of a proper data coder class
     * of the proper type (encoder/decoder)
     * and processing proper data format.
     *
     * @return string
     */
    private function buildCoderClassName()
    {
        $this->currentClassName = $this->extractCurrentClassName();
        $this->currentClassNameSegments = $this->splitCurrentClassName();

        $dataFormatPrefix = $this->establishDataFormatPrefix();
        $coderTypePostfix = $this->extractCurrentClassNamePostfix();

        $coderClassName = __NAMESPACE__
            . '\\'
            . $dataFormatPrefix
            . 'Data'
            . $coderTypePostfix;

        return $coderClassName;
    }

    /**
     * Validate existance of the Coder class
     * defined by class name.
     *
     * @param string $coderClassName
     */
    private function validateCoderClassExistance($coderClassName)
    {
        if (!class_exists($coderClassName)) {
            throw new CoderClassNotFoundException(
                'Data Coder class '
                . $coderClassName
                . ' not found.'
            );
        }
    }

    /**
     * Extract class name of current class
     * from the whole namespaced path.
     *
     * @return string
     */
    private function extractCurrentClassName()
    {
        $classNamespacedPathParts = explode('\\', __CLASS__);
        $className = array_pop($classNamespacedPathParts);

        return $className;
    }

    /**
     * Split current class name up
     * into segmants
     * begun with upper case letter.
     *
     * @return array:
     */
    private function splitCurrentClassName()
    {
        /**
         * Every uppercase letter
         * is the beginning of new segment.
         */
        $splittingSeparatorPattern = '/(?=[A-Z])/';
        $classNameParts = preg_split(
            $splittingSeparatorPattern,
            $this->currentClassName,
            null,
            PREG_SPLIT_NO_EMPTY
        );

        return $classNameParts;
    }

    /**
     * Extract name prefix of current class.
     * Prefix means first word
     * of the pascal case class name.
     */
    private function extractCurrentClassNamePrefix()
    {
        $classNamePrefix = array_shift($this->currentClassNameSegments);

        return $classNamePrefix;
    }

    /**
     * Extract name postfix of current class.
     * Postfix means the last word
     * of the pascal case class name.
     */
    private function extractCurrentClassNamePostfix()
    {
        $classNamePostfix = array_pop($this->currentClassNameSegments);

        return $classNamePostfix;
    }

    /**
     * Establish source of data format prefix
     * and retrieve prefix from that source.
     *
     * @return string
     */
    private function establishDataFormatPrefix()
    {
        if ($this->dataFormatIsDefined()) {
            $dataFormatPrefix = ucfirst(strtolower($this->dataFormat));
        } else {
            $dataFormatPrefix = $this->extractCurrentClassNamePrefix();
        }

        return $dataFormatPrefix;
    }

    /**
     * Check if dataFormat property is defined
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
