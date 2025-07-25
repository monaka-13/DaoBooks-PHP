<?php
class BooksDAO
{
  private static $db;
  static function initialize($className)
  {
    self::$db = new PDOService($className);
  }

  static function getBooks(): Array
  {
    $sql = "SELECT * FROM Books;";
    self::$db->query($sql);
    self::$db->execute();
    return self::$db->resultSet();
  }
}
