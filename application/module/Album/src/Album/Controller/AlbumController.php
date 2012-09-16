<?php
// module/Album/src/Album/Controller/AlbumController.php:
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album;
use Zend\Form\Annotation\AnnotationBuilder;

class AlbumController extends AbstractActionController{
    protected $albumTable;

    public function indexAction(){
      return new ViewModel(array(
          'albums' => $this->getAlbumTable()->fetchAll(),
      ));
    }
    private function form(){
      $builder = new AnnotationBuilder();
      $form = $builder->createForm(new Album());
      $form->add(array(
        'name' => 'submit',
        'attributes' => array(
            'type'  => 'submit',
            'value' => 'Add',
            'id' => 'submitbutton',
        ),  
      ));
      return $form;
    }
    public function addAction(){
      $form = $this->form();
      $request = $this->getRequest();
      if ($request->isPost()) {
          $album = new Album();
          $form->setData($request->getPost());

          if ($form->isValid()) {
              $album->exchangeArray($form->getData());
              $this->getAlbumTable()->saveAlbum($album);

              // Redirect to list of albums
              return $this->redirect()->toRoute('album');
          }
      }
      return array('form' => $form);
    }

    public function editAction(){
      $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));
        }
        $album = $this->getAlbumTable()->getAlbum($id);

        $form  = $this->form();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getAlbumTable()->saveAlbum($album);

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction(){
       $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getAlbumTable()->deleteAlbum($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }

        return array(
            'id'    => $id,
            'album' => $this->getAlbumTable()->getAlbum($id)
        );
    }
    public function getAlbumTable(){
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }
}
