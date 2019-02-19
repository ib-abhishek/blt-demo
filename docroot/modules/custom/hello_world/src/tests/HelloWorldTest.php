<?php

namespace Drupal\hello_world\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * @file
 * Tests for the hello world module.
 */
class HelloWorldTest extends WebTestBase {


/**
 * Metadata about our test case.
 */
public static function getInfo() {
  return array(
    // The human readable name of the test case.
    'name' => 'Hello World',
    // A short description of the tests this case performs.
    'description' => 'Tests for the Hello World module.',
    // The group that this case belongs too, used for grouping tests together
    // in the UI.
    'group' => 'Hello World Group',
  );
}

/**
 * Perform any setup tasks for our test case.
 */
public function setUp() {
 parent::setUp(array('helloworld'));
}


public function testHelloWorld() {
  // Navigate to /hello.
  $this->drupalGet('hello');
  // Verify that the text "Hello World ...", exists on the page.
  $this->assertText('Hello, World!');
}



}
