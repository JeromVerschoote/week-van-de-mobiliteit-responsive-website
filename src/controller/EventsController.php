<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'EventDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'NewsletterDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'StoriesDAO.php';

class EventsController extends Controller {

  private $eventDAO;

  function __construct() {
    $this->eventDAO = new EventDAO();
    $this->newsletterDAO = new NewsletterDAO();
    $this->storiesDAO = new StoriesDAO();
  }

  public function index() {
    $this->set('currentPage', 'home');
    $this->set('spotlightEvents', $this->eventDAO->selectSpotlightEvents());
    $this->set('events', $this->eventDAO->selectAllEvents());
    $this->set('stories', $this->storiesDAO->selectSpotlighStories());

    if (!empty($_POST['action'])) {
      if ($_POST['action'] == 'insertEmail') {
        $this->_handleInsertEmail();
      }
    }
  }

  public function programma() {
    if (!empty($_POST['action'])) {
      if ($_POST['action'] == 'insertEmail') {
        $this->_handleInsertEmail();
      }
    }

    if(!empty($_GET)){
      if(!empty($_GET['title'])){
        $criteria['title'] = $_GET['title'];
      }
      if(!empty($_GET['organiserId'])){
        $criteria['organiserId'] = $_GET['organiserId'];
      }
      if(!empty($_GET['organiserName'])){
        $criteria['organiserName'] = $_GET['organiserName'];
      }
      if(!empty($_GET['tag'])){
        $criteria['tag'] = $_GET['tag'];
      }
      if(!empty($_GET['day'])){
        $criteria['day'] = $_GET['day'];
      }
      if(!empty($_GET['locatie'])){
        $criteria['locatie'] = $_GET['locatie'];
      }
      if(!empty($criteria)){
        $this->_handleFilter($criteria);
      }else{
        $events = $this->eventDAO->selectAllEvents();

        if (strtolower($_SERVER['HTTP_ACCEPT']) == 'application/json') {
          header('Content-Type: application/json');
          echo json_encode($events);
          exit();
        }

        $this->set('events', $events);
      }
    }else{
      $events = $this->eventDAO->selectAllEvents();

      if (strtolower($_SERVER['HTTP_ACCEPT']) == 'application/json') {
        header('Content-Type: application/json');
        echo json_encode($events);
        exit();
      }

      $this->set('events', $events);
    }

    $this->set('currentPage', 'programma');
    $this->set('tags', $this->eventDAO->selectAllTags());
  }

  public function details() {
    if (!empty($_POST['action'])) {
      if ($_POST['action'] == 'insertEmail') {
        $this->_handleInsertEmail();
      }
    }

    if(!empty($_GET)){
      if(!empty($_GET['id'])){
        $criteria['id'] = $_GET['id'];
        $this->_handleFilter($criteria);
      }else{
        $_GET['page'] = 'home';
        header('Location: index.php');
      }
    }

    $this->set('currentPage', 'details');
    $this->set('spotlightEvents', $this->eventDAO->selectSpotlightEvents());
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
$this->_handleSetConditions($conditions);
}

public function _handleSetConditions($conditions){

  $events = $this->eventDAO->search($conditions);

  if (strtolower($_SERVER['HTTP_ACCEPT']) == 'application/json') {
    header('Content-Type: application/json');
    echo json_encode($events);
    exit();
  }
  return $this->set('events', $events);
}

private function _handleInsertEmail() {
  $data = array(
    'email' => $_POST['email']
  );
  $insertScoreResult = $this->newsletterDAO->insert($data);
  if (!$insertScoreResult) {
    $errors = $this->newsletterDAO->validate($data);
    $this->set('errors', $errors);
    if (strtolower($_SERVER['HTTP_ACCEPT']) == 'application/json') {
      header('Content-Type: application/json');
      echo json_encode(array(
        'result' => 'error',
        'errors' => $errors
      ));
      exit();
    }
    $_SESSION['error'] = 'Je email-adres kon niet toegevoegd worden!';
  } else {
    if (strtolower($_SERVER['HTTP_ACCEPT']) == 'application/json') {
      header('Content-Type: application/json');
      echo json_encode(array(
        'result' => 'ok',
        'score' => $insertScoreResult
      ));
      exit();
    }
    $_SESSION['info'] = 'Je email-adres is toegevoegd!';
    header('Location: index.php');
    exit();
  }
}
}
