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
 * DataDecodersTestHelper.
 * Helper for test classes for
 * Decoder classes.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataDecodersTestHelper extends DataCodersTestHelper
{
    /**
     * Directory with the files containing encoded data
     * in various formats.
     */
    const ENCODED_DATA_SUBDIRECTORY = 'encoded';

    /**
     * Directory with the files containing decoded data
     * from various formats.
     */
    const DECODED_DATA_SUBDIRECTORY = 'decoded';

    /**
     * Base of the name (with no extension)
     * of the file with encoded data.
     */
    const ENCODED_DATA_BASE_FILENAME = 'data';

    /**
     * Loads input data to pass
     * to the Decoder class.
     *
     * @return string
     */
    public function loadDataToDecode()
    {
        $partialDataFilePath = self::ENCODED_DATA_SUBDIRECTORY
            . DIRECTORY_SEPARATOR
            . self::ENCODED_DATA_BASE_FILENAME
            . '.'
            . $this->getDataFormat();

        $data = $this->loadFileContent($partialDataFilePath);

        return $data;
    }

    /**
     * Returns expected result
     * of the decoding operation.
     *
     * @return array
     */
    public function getExpectedDecodingResult()
    {
        $partialResultCodeFilePath = self::DECODED_DATA_SUBDIRECTORY
            . DIRECTORY_SEPARATOR
            . $this->getDataFormat()
            . '.php';

        $resultCode = $this->loadFileContent($partialResultCodeFilePath);

        // Define variable $result
        // and assing to it expected result
        // of decoding operation.
        eval($resultCode);

        return $result;
    }
}
