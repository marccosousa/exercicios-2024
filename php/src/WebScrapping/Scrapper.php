<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

    /**
     * Loads paper information from the HTML and returns the array with the data.
     */
    public function scrap(\DOMDocument $dom): array {
        $papers = [];
        $linkTags = $dom->getElementsByTagName('a');
        foreach ($linkTags as $link) {
            if (strpos($link->getAttribute('class'), 'paper-card') === 0) {

                $id = self::findPaperId($link);
                $title = self::findPaperTitle($link);
                $type = self::findPaperType($link);
                $authors = self::findPaperAuthors($link);

                $papers[] = new Paper($id, $title, $type, $authors);
            }
        }

        return $papers;
    }

    /**
     * Finds the ID of the paper.
     */
    private function findPaperId(\DOMElement $link): string {
        $id = '';
        $divs = $link->getElementsByTagName('div');
        foreach ($divs as $divId) {
            if (strpos($divId->getAttribute('class'), 'volume-info') === 0) {
                $id = $divId->textContent;
                break;
            }
        }
        return $id;
    }

    /**
     * Finds the title of the paper.
     */
    private function findPaperTitle(\DOMElement $link): string {
        $title = $link->getElementsByTagName('h4')->item(0)->textContent;
        return $title;
    }

    /**
     * Finds the type of the paper.
     */
    private function findPaperType(\DOMElement $link): string {
        $type = '';
        $divs = $link->getElementsByTagName('div');
        foreach ($divs as $divType) {
            if (strpos($divType->getAttribute('class'), 'tags mr-sm') === 0) {
                $type = $divType->textContent;
                break;
            }
        }
        return $type;
    }

    /**
     * Finds the authors of the paper.
     */
    private function findPaperAuthors(\DOMElement $link): array {
        $authorSpans = $link->getElementsByTagName('span');
        foreach ($authorSpans as $authorSpan) {
            $authorName = $authorSpan->textContent;
            $authorInstitution = $authorSpan->getAttribute('title');
            $authors[] = new Person($authorName, $authorInstitution);
        }
        return $authors;
    }
}