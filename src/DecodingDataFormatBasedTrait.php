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
 * DecodingDataFormatBasedTrait.
 * Allows to build decoder class names
 * for defined data format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
trait DecodingDataFormatBasedTrait
{
    /**
     * Core of the Data Decoder class name.
     * @var unknown
     */
    private static $classNameCore = 'DataDecoder';

    /**
     * Build Data Decoder instance
     * based on given data format.
     *
     * @param string $dataFormat
     * @return mixed
     */
    private function buildDecoderForDataFormat($dataFormat)
    {
        $decoderClassName = $this->buildDecoderClassNameForDataFormat($dataFormat);

        $classExists = class_exists($decoderClassName);

        if (!$classExists) {
            throw new DecoderClassNotFoundException(
                'Data Decoder class for format '
                . $dataFormat
                . ' not found.'
            );
        }

        $dataDecoder = new $decoderClassName();

        return $dataDecoder;
    }

    /**
     * Build Data Decoder class name.
     *
     * @param string $dataFormat
     * @return string
     */
    private function buildDecoderClassNameForDataFormat($dataFormat)
    {
        $classNamePrefix = ucfirst(strtolower($dataFormat));
        $className = __NAMESPACE__
            . '\\'
            . $classNamePrefix
            . self::$classNameCore;

        return $className;
    }
}
