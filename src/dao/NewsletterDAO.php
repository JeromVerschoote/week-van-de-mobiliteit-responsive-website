<?php
require_once __DIR__ . '/DAO.php';
class NewsletterDAO extends DAO {

  public function selectById($id){
    $sql = "SELECT * FROM `ma3_subscribtions` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($data) {
    $errors = $this->validate($data);
      $sql = "INSERT INTO `ma3_subscribtions` (`email`) VALUES (:email)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':email', $data['email']);
      $stmt->execute();
      if($stmt->execute()) {
        $insertedId = $this->pdo->lastInsertId();
        return $this->selectById($insertedId);
      }

    return false;
  }

  public function validate( $data ){
    $errors = [];
    if (!isset($data['email'])) {
      $errors['email'] = 'Gelieve user in te vullen';
    }
    return $errors;
  }
}
