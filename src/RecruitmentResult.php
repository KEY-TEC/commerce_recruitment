<?php

namespace Drupal\commerce_recruiting;

use Drupal\commerce_price\Price;

/**
 * Class RecruitmentResult.
 */
class RecruitmentResult {

  /**
   * The title.
   *
   * @var string
   */
  private $title;

  /**
   * The price.
   *
   * @var \Drupal\commerce_price\Price
   */
  private $price;

  /**
   * The result counter.
   *
   * @var int
   */
  private $counter = 0;

  /**
   * RecruitmentResult constructor.
   *
   * @param string $title
   *   The title.
   * @param \Drupal\commerce_price\Price $price
   *   The price.
   * @param int $count
   *   The result counter.
   */
  public function __construct($title, Price $price, $count = 1) {
    $this->title = $title;
    $this->price = $price;
    $this->counter = $count;
  }

  /**
   * Gets the title.
   *
   * @return string
   *   The title.
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Gets the price.
   *
   * @return \Drupal\commerce_price\Price
   *   The price.
   */
  public function getPrice() {
    return $this->price;
  }

  /**
   * Adds given price.
   *
   * @param \Drupal\commerce_price\Price $price
   *   The price.
   */
  public function addPrice(Price $price) {
    $this->price = $price->add($price);
  }

  /**
   * Increments the counter.
   */
  public function counterIncrement() {
    $this->counter++;
  }

  /**
   * Returns the result count.
   */
  public function getCount() {
    return $this->counter;
  }

}
