<?php
namespace Test\Foo\Bar\Baz;

abstract class AbstractDaoTestCase extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        parent::setUp();
    }

    public function tearDown() {
        parent::tearDown();
    }

    public function getMockRestfulService() {
      return "Yer Mom";
    }

}

?>
