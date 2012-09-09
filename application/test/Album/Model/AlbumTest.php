<?php
namespace Album\Model;



class AlbumTest extends \PHPUnit_Framework_TestCase{
  private $album;

  public function setUp(){
  }
  public function testThisStuff(){
    $album = new Album();
    $album->exchangeArray(array('title'=> 'Mo Thug'));
    $this->assertEquals('Mo Thug', $album->title);
  }
}
