<?php
// MariaDB [books]> desc books;
// +--------+------------+------+-----+---------+-------+
// | Field  | Type       | Null | Key | Default | Extra |
// +--------+------------+------+-----+---------+-------+
// | ISBN   | char(13)   | NO   | PRI | NULL    |       |
// | Author | char(50)   | YES  |     | NULL    |       |
// | Title  | char(100)  | YES  |     | NULL    |       |
// | Price  | float(4,2) | YES  |     | NULL    |       |
// +--------+------------+------+-----+---------+-------+
// 4 rows in set (0.030 sec)

// MariaDB [books]>

class Book
{
  private $ISBN;
  private $Author;
  private $Title;
  private $Price;

  function getISBN()
  {
    return $this->ISBN;
  }
  function getAuthor()
  {
    return $this->Author;
  }
  function getTitle()
  {
    return $this->Title;
  }
  function getPrice()
  {
    return $this->Price;
  }
  function setPrice(float $price)
  {
    $this->Price = $price;
  }

  function setISBN(string $isbn)
  {
    $this->ISBN = $isbn;
  }

  function setTitle(string $title)
  {
    $this->Title = $title;
  }

  function setAuthor(string $author)
  {
    $this->Author = $author;
  }
}
