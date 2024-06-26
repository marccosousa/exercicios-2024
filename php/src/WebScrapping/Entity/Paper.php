<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * The Paper class represents the row of the parsed data.
 */
class Paper {

  /**
   * Paper Id.
   *
   * @var int
   */
  public $id;

  /**
   * Paper Title.
   *
   * @var string
   */
  public $title;

  /**
   * The paper type (e.g. Poster, Nobel Prize, etc).
   *
   * @var string
   */
  public $type;

  /**
   * Paper authors.
   *
   * @var \Chuva\Php\WebScrapping\Entity\Person[]
   */
  public $authors;

  /**
   * Builder.
   */
  public function __construct($id, $title, $type, $authors = []) {
    $this->id = $id;
    $this->title = $title;
    $this->type = $type;
    $this->authors = $authors;
  }

  /**
   * Paper get id.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Paper get title.
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Paper get type.
   */
  public function getType() {
    return $this->type;
  }

  /**
   * Paper get authors.
   */
  public function getAuthors() {
    return $this->authors;
  }

}
