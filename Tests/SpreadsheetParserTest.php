<?php

namespace Akeneo\Bundle\SpreadsheetParserBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests the dependency injection
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SpreadsheetParserTest extends WebTestCase
{
    protected function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
    }

    public function testSpreadsheetLoader()
    {
        $container = static::$kernel->getContainer();
        $loader = $container->get('akeneo_spreadsheet_parser.spreadsheet_loader');
        $this->assertInstanceOf(
            'Akeneo\Component\SpreadsheetParser\SpreadsheetLoader',
            $loader
        );
        $this->assertInstanceOf(
            'Akeneo\Component\SpreadsheetParser\Xlsx\Spreadsheet',
            $loader->open(__DIR__ . '/fixtures/test.xlsx')
        );
        $this->assertInstanceOf(
            'Akeneo\Component\SpreadsheetParser\Csv\Spreadsheet',
            $loader->open(__DIR__ . '/fixtures/test.txt', 'csv')
        );
    }

    public function testCsvSpreadsheetLoader()
    {
        $container = static::$kernel->getContainer();
        $loader = $container->get('akeneo_spreadsheet_parser.csv.spreadsheet_loader');
        $this->assertInstanceOf(
            'Akeneo\Component\SpreadsheetParser\Csv\SpreadsheetLoader',
            $loader
        );
        $this->assertInstanceOf(
            'Akeneo\Component\SpreadsheetParser\Csv\Spreadsheet',
            $loader->open(__DIR__ . '/fixtures/test.txt')
        );
    }

    public function testXlsxSpreadsheetLoader()
    {
        $container = static::$kernel->getContainer();
        $loader = $container->get('akeneo_spreadsheet_parser.xlsx.spreadsheet_loader');
        $this->assertInstanceOf(
            'Akeneo\Component\SpreadsheetParser\Xlsx\SpreadsheetLoader',
            $loader
        );
        $this->assertInstanceOf(
            'Akeneo\Component\SpreadsheetParser\Xlsx\Spreadsheet',
            $loader->open(__DIR__ . '/fixtures/test.xlsx')
        );
        $this->assertInstanceOf(
            'Akeneo\Component\SpreadsheetParser\Xlsx\Spreadsheet',
            $loader->open(__DIR__ . '/fixtures/test.xlsm')
        );
    }
}
