<?php
class BooksDAO
{
  private static $db;
  static function initialize($className)
  {
    self::$db = new PDOService($className);
  }

  static function getBooks(): array
  {
    $sql = "SELECT * FROM Books;";
    self::$db->query($sql);
    self::$db->execute();
    return self::$db->resultSet();
  }

  static function addBook()
  {
    $sql = "INSERT INTO Books VALUE(:ISBN,:Author,:Title,:Price)";
    self::$db->query($sql);
    self::$db->bind(":ISBN", $_POST["isbn"]);
    self::$db->bind(":Author", $_POST["author"]);
    self::$db->bind(":Title", $_POST["title"]);
    self::$db->bind(":Price", $_POST["price"]);
    self::$db->execute();
  }
}
