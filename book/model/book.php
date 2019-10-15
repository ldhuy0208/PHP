<?php
class Book
{
    #begin Properties
    var $id;
    var $price;
    var $title;
    var $author;
    var $year;
    #end properties

    #Construct funtion
    function __construct($id, $price, $title, $author, $year)
    {
        $this->id = $id;
        $this->price = $price;
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    #Member function
    function display()
    {
        echo "Price: " . $this->price . "<br>";
        echo "Title: " . $this->title . "<br>";
        echo "Author: " . $this->author . "<br>";
        echo "Year: " . $this->year . "<br>";
    }
    static function getList()
    {
        $listBook = array();

        array_push($listBook, new Book(1, 20000, "Sách 1", "Lê Huy", 2019));
        array_push($listBook, new Book(2, 30000, "Sách 2", "Lê Huy", 2019));
        array_push($listBook, new Book(3, 10000, "Sách 3", "Lê Huy", 2019));

        return $listBook;
    }
    static function getListFromFile($search = null)
    {
        $arrData = file("data/book.txt");
        $books = array();
        foreach ($arrData as $key => $value) {


            $arrItem = explode("#", $value);

            if ($search == null
                    || strpos(strtolower($arrItem[1]), strtolower($search)) !== false
                    || strpos(strtolower($arrItem[3]), strtolower($search)) !== false
                    || strpos(strtolower($arrItem[4]), strtolower($search)) !== false){
                $book = new Book($arrItem[0], $arrItem[2], $arrItem[1], $arrItem[3], $arrItem[4]);
                array_push($books, $book);
            }
        }

        return $books;
    }
    static function add($book)
    {
        $books = Book::getListFromFile();
        foreach($books as $key=>$value){
            if($value->id == $book->id)
                return false;
        }
        $fp = fopen('data/book.txt', 'a');
        fwrite($fp, PHP_EOL);
        fwrite($fp, $book->id."#");
        fwrite($fp, $book->title."#");
        fwrite($fp, $book->price."#");
        fwrite($fp, $book->author."#");
        fwrite($fp, $book->year);
        fclose($fp);
        return true;
    }
    static function edit($book)
    {
        $books = Book::getListFromFile();
        $fp = fopen('data/book.txt', 'w');
        
        foreach($books as $key=>$value){
            if($value->id == $book->id){
                $value->title   = $book->title;
                $value->price   = $book->price;
                $value->author  = $book->author;
                $value->year    = $book->year; 
            }
           
            fwrite($fp, $value->id."#".$value->title."#".$value->price."#".$value->author."#".$value->year.PHP_EOL);
        }
        fclose($fp);
    }
    static function delete($id){
        $books = Book::getListFromFile();
        $fp = fopen('data/book.txt', 'w');
        foreach($books as $key=>$value){
            if($value->id != $id){
                fwrite($fp, $value->id."#".$value->title."#".$value->price."#".$value->author."#".$value->year);
            }
        }
        fclose($fp);
    }
}
