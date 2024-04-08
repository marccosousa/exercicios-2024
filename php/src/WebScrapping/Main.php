<?php

namespace Chuva\Php\WebScrapping;

libxml_use_internal_errors(true);

/**
 * Runner for the Webscrapping exercice.
 */
class Main
{

    /**
     * Main runner, instantiates a Scrapper and runs.
     */
    public static function run(): void
    {
        $content = file_get_contents(__DIR__ . '/../../assets/origin.html');
        $dom = new \DOMDocument('1.0', 'utf-8');
        $dom->loadHTML($content);

        $data = (new Scrapper())->scrap($dom);

        // Write your logic to save the output file bellow.
        print_r($data);
        $excelWriter = new ExcelWriter();

        // Run method for write spreadsheet. 
        $excelWriter->writePapersToExcel($data, __DIR__ . '/../../assets/model.xlsx');
    }
}
