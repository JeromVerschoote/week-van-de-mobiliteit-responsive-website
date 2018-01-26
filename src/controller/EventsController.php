<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'EventDAO.php';

class EventsController extends Controller {

  private $eventDAO;

  function __construct() {
    $this->eventDAO = new EventDAO();
  }

  public function index() {
    $this->set('currentPage', 'home');
    $this->set('events', $this->eventDAO->selectSpotlightEvents());
  }

  public function programma() {

    if(!empty($_POST)){
      if(!empty($_POST['title'])){
        $criteria['title'] = $_POST['title'];
      }
      if(!empty($_POST['organiserId'])){
        $criteria['organiserId'] = $_POST['organiserId'];
      }
      if(!empty($_POST['organiserName'])){
        $criteria['organiserName'] = $_POST['organiserName'];
      }
      if(!empty($_POST['tag'])){
        $criteria['tag'] = $_POST['tag'];
      }
      if(!empty($_POST['day'])){
        $criteria['day'] = $_POST['day'];
      }
      if(!empty($_POST['locatie'])){
        $criteria['locatie'] = $_POST['locatie'];
      }

      if(!empty($criteria)){
        $this->_handleFilter($criteria);
      }else{
        $this->set('events', $this->eventDAO->selectAllEvents());
      }
    }else{
      $this->set('events', $this->eventDAO->selectAllEvents());
    }

    $this->set('currentPage', 'programma');
    $this->set('tags', $this->eventDAO->selectAllTags());
  }

  public function details() {
    $this->set('currentPage', 'details');

    if(!empty($_GET)){
      if(!empty($_GET['id'])){
        $criteria['id'] = $_GET['id'];
        $this->_handleFilter($criteria);
      }
    }else{
      // redirect to home page
    }

    /*if(!empty($_GET['id'])){
    $this->set('event', $this->eventDAO->selectById($_GET['id']));
  }*/
}

public function _handleFilter($criteria){
  if(!empty($criteria['id'])){
    $conditions[] = array(
      'field' => 'id',
      'comparator' => '=',
      'value' => $criteria['id']
    );
  }
  if(!empty($criteria['title'])){
    $conditions[] = array(
      'field' => 'title',
      'comparator' => 'like',
      'value' => $criteria['title']
    );
  }
  if(!empty($criteria['organiserId'])){
    $conditions[] = array(
      'field' => 'organiser_id',
      'comparator' => '=',
      'value' => $criteria['organiserId']
    );
  }
  if(!empty($criteria['organiserName'])){
    $conditions[] = array(
      'field' => 'organiser',
      'comparator' => 'like',
      'value' => $criteria['organiserName']
    );
  }
  if(!empty($criteria['tag'])){
      $conditions[] = array(
        'field' => 'tag',
        'comparator' => '=',
        'value' => $criteria['tag']
      );
  }
  if(!empty($criteria['day'])){
    /*$conditions[] = array(
    'field' => 'start',
    'comparator' => '>=',
    'value' => '2018-09-'.$date.' 00:00:00'
  );
  $conditions[] = array(
  'field' => 'end',
  'comparator' => '<=',
  'value' => '2018-09-'.$date.' 23:59:59'
);*/
$conditions[] = array(
  'field' => 'start',
  'comparator' => '<=',
  'value' => '2018-09-'.$criteria['day'].' 23:59:59'
);
$conditions[] = array(
  'field' => 'end',
  'comparator' => '>=',
  'value' => '2018-09-'.$criteria['day'].' 00:00:00'
);
}
if(!empty($criteria['locatie'])){
  $conditions[] = array(
    'field' => 'city',
    'comparator' => 'like',
    'value' => $criteria['locatie']
  );
}
// TODO: filteren op meerdere tags
$this->_handleSetConditions($conditions);
}

public function _handleSetConditions($conditions){

  $events = $this->eventDAO->search($conditions);
  if(!empty($events)){
    return $this->set('events', $events);
  }
}
}
