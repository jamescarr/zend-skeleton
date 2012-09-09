<?php
namespace Album\Controller;

use Zend\ServiceManager\ServiceManager as ServiceManager;
use Phake;

use Album\Model\Album;

class AlbumControllerTest extends \PHPUnit_Framework_TestCase{
  private $controller;
  private $albumTable;
  public function setUp(){
    $this->controller = new AlbumController();
    $serviceManager = new ServiceManager();
    $serviceManager->setAllowOverride(true);
    $this->controller->setServiceLocator($serviceManager);
    $this->albumTable =Phake::mock('\Album\Model\AlbumTable');

    $serviceManager->setService('Album\Model\AlbumTable', $this->albumTable, false);
  }

  public function testAddGeneratesForm(){
    $view = $this->controller->addAction();

    $formNames = array_map(function($e){
      return $e->getName();
    }, $view['form']->getElements());

    $this->assertContains('title', $formNames);
    $this->assertContains('artist', $formNames);
  }

  public function testSubmitButtonIsAdded(){
    $view = $this->controller->addAction();

    $this->assertEquals('Add', $view['form']->get('submit')->getValue());

  }

  public function testIndexActionReturnsAllElements(){
    $albums = array(new Album());
    Phake::when($this->albumTable)->fetchAll()->thenReturn($albums);

    $result = $this->controller->indexAction();

    $this->assertSame($albums, $result->albums);
    
  }
  

}
