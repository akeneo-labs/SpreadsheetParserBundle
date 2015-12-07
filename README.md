Akeneo Spreadsheet Parser Bundle
================================

This component is designed to extract data from spreadsheets, while being easy on resources, even for large files.

The actual version of the spreadsheet parser only works with xlsx files.


Installing the bundle
---------------------

From your application root:

    $ php composer.phar require --prefer-dist "akeneo-labs/spreadsheet-parser-bundle"


You will then have to add the bundle to your AppKernel :

    $bundles[] = new Akeneo\Bundle\SpreadsheetParserBundle\AkeneoSpreadsheetParserBundle();


Usage
-----

To extract data from a spreadsheet, use the following code:

    <?php

    [...]

    class MyService implements ContainerAwareInterface
    {
        public method readSpreadsheet()
        {
            $loader = $this->container->get('akeneo_spreadsheet_parser.spreadsheet_loader');
            $spreadsheet = $loader->open('myfile.xlsx');

            $myWorksheetIndex = $spreadsheet->getWorksheetIndex('myworksheet');

            foreach ($spreadsheet->createRowIterator($myWorksheetIndex) as $rowIndex => $values) {
                var_dump($rowIndex, $values);
            }
        }

        [...]
    }
