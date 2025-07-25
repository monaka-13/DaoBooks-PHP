<?php
require_once("inc/config.php");
require_once("inc/Entities/Book.class.php");
require_once("inc/Entities/Page.class.php");
require_once("inc/Util/PDOService.class.php");
require_once("inc/Util/BooksDAO.class.php");
require_once("log/error_log.txt");

BooksDAO::initialize("Book");

Page::header();

if(isset($_POST['submit'])){
  BooksDAO::addBook();
}

Page::listBooks(BooksDAO::getBooks());
Page::addForm();
Page::footer();

?>