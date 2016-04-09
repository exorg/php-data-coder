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
 * DecodingClassNameBasedTrait.
 * Allows to build decoder class instance
 * for class that has to use that proper decoder.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
trait DecodingClassNameBasedTrait
{
    /**
     * Core of the Data Decoder class name.
     * @var unknown
     */
    private static $classNameCore = 'DataDecoder';

    /**
     * Build Data Decoder instance
     * based on name of the class
     * that needs to use the decoder.
     *
     * @param string $dataFormat
     * @return mixed
     */
    private function buildDecoderForClassName($className)
    {
        $decoderClassName = $this->buildDecoderClassNameForClassName($className);

        $classExists = class_exists($decoderClassName);

        if (!$classExists) {
            throw new DecoderClassNotFoundException(
                'Data Decoder class '
                . $decoderClassName
                . ' for context class '
                . $className
                . ' not found.'
            );
        }

        $dataDecoder = new $decoderClassName();

        return $dataDecoder;
    }

    /**
     * Build Data Decoder class name.
     *
     * @param string $className
     * @return string
     */
    private function buildDecoderClassNameForClassName($className)
    {
        $classNamePrefix = preg_split('/(?=[A-Z])/', $className)[1];
        $className = __NAMESPACE__
            . '\\'
            . $classNamePrefix
            . self::$classNameCore;

        return $className;
    }
}
