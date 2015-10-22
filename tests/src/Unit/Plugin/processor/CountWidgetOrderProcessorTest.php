<?php

/**
 * @file
 * Contains \Drupal\Tests\facetapi\Plugin\Processor\CountWidgetOrderProcessorTest.
 */

namespace Drupal\Tests\facetapi\Unit\Plugin\Processor;

use Drupal\facetapi\Plugin\facetapi\processor\CountWidgetOrderProcessor;
use Drupal\facetapi\Processor\WidgetOrderProcessorInterface;
use Drupal\facetapi\Result\Result;
use Drupal\Tests\UnitTestCase;

/**
 * @group facetapi
 */
class CountWidgetOrderProcessorTest extends UnitTestCase {

  /**
   * The processor to be tested.
   *
   * @var WidgetOrderProcessorInterface
   */
  protected $processor;

  /**
   * An array containing the results before the processor has ran.
   *
   * @var \Drupal\facetapi\Result\Result[]
   */
  protected $original_results;

  /**
   * Creates a new processor object for use in the tests.
   */
  protected function setUp() {
    parent::setUp();

    $this->original_results = [
      new Result('llama', 10),
      new Result('badger', 5),
      new Result('duck', 15),
    ];

    $this->processor = new CountWidgetOrderProcessor([], 'count_widget_order', []);
  }

  /**
   * Test sorting ascending.
   */
  public function testAscending() {

    $sorted_results = $this->processor->sortResults($this->original_results, 'ASC');

    $this->assertEquals(5, $sorted_results[0]->getCount());
    $this->assertEquals('badger', $sorted_results[0]->getValue());
    $this->assertEquals(10, $sorted_results[1]->getCount());
    $this->assertEquals('llama', $sorted_results[1]->getValue());
    $this->assertEquals(15, $sorted_results[2]->getCount());
    $this->assertEquals('duck', $sorted_results[2]->getValue());
  }

  /**
   * Test sorting descending.
   */
  public function testDescending() {

    $sorted_results = $this->processor->sortResults($this->original_results, 'DESC');

    $this->assertEquals(15, $sorted_results[0]->getCount());
    $this->assertEquals('duck', $sorted_results[0]->getValue());
    $this->assertEquals(10, $sorted_results[1]->getCount());
    $this->assertEquals('llama', $sorted_results[1]->getValue());
    $this->assertEquals(5, $sorted_results[2]->getCount());
    $this->assertEquals('badger', $sorted_results[2]->getValue());
  }

}