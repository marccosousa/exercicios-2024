<?php

namespace Chuva\Php\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class ExcelWriter {
    protected $writer;

    public function __construct() {
        $this->writer = WriterEntityFactory::createXLSXWriter();
    }

    public function writePapersToExcel(array $papers, $filePath) {
        $this->writer->openToFile($filePath);

        // Add headers for spreadsheet
        $headers = ['ID', 'Title', 'Type'];
        foreach ($papers[0]->getAuthors() as $index => $author) {
            $headers[] = "Author " . ($index + 1);
            $headers[] = "Author " . ($index + 1) . " institution";
        }
        $this->writer->addRow(WriterEntityFactory::createRowFromArray($headers));

        // Get papers atributes. 
        foreach ($papers as $paper) {
            $details = [
                $paper->getId(),
                $paper->getTitle(),
                $paper->getType()
            ];

            // Get authors atributes
            foreach ($paper->getAuthors() as $author) {
                $details[] = $author->getName();
                $details[] = $author->getInstitution();
            }

            // Write row in spreadsheet
            $this->writer->addRow(WriterEntityFactory::createRowFromArray($details));
        }

        $this->writer->close();
    }
}