<?php
class Page
{

  public static $title = "Please set your title!";

  static function header()
  { ?>
    <!DOCTYPE html>
    <html>

    <head>
      <title><?php echo self::$title; ?></title>
      <meta charset="utf-8">
      <meta name="author" content="Danny">
      <link href="css/styles.css" rel="stylesheet">
    </head>

    <body>
      <header>
        <h1><?php echo self::$title ?></h1>
      </header>
      <article>
      <?php }

    static function footer()
    { ?>
      </article>
    </body>

    </html>
  <?php }

    static function listBooks($bookData)
    {
  ?>
    <section class="main">
      <h2>Current Data</h2>
      <table>
        <thead>
          <tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Price</th>
            <th>Delete</th>
          </tr>
        </thead>
        <?php
        $i = 0;
        foreach ($bookData as $book) {
          if ($i % 2 == 1)
            echo "<tbody class=\"evenRow\">";
          else
            echo "<tbody class=\"oddRow\">";

          echo '<tr>
            <td>' . $book->getISBN() . '</td>
            <td>' . $book->getTitle() . '</td>
            <td>' . $book->getAuthor() . '</td>
            <td>' . $book->getPrice() . '</td>
            <td><a href="' . $_SERVER["PHP_SELF"] . '?action=delete&isbn=' . $book->getISBN() . '
            ">Delete</a></td>
            </tr>';
          $i++;
        }
        echo '</table>
            </section>';
      }

      static function addForm()
      { ?>
        <section class="form1">
          <h2>Add a new entry</h2>
          <form method="post" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
            ISBN: <input type="text" name="isbn" size=30 placeholder="X-XXX-XXXXX-X"><br>
            Title: <input type="text" name="title" size=30 placeholder="Book Title"><br>
            Author: <input type="text" name="author" size=30 placeholder="Book Author"><br>
            Price: <input type="text" name="price" size=30 placeholder="Book Price XX.XX"><br>
            <input type="submit" name="submit" value="Add entry">
          </form>
        </section>
    <?php }
    }
