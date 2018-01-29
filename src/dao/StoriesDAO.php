<?php
require_once __DIR__ . '/DAO.php';
class StoriesDAO extends DAO {

  public function selectAll(){
    $sql = "SELECT * FROM `ma3_stories`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectSpotlighStories(){
    $sql = "SELECT * FROM `ma3_stories`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
