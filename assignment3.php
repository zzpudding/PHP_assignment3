<?php
/**
 * Created by PhpStorm.
 * User: zhangyujia
 * Date: 4904.12.17
 * Time: 08:29
 */

//$user = 'root';
//$password = 'root';
//$db = 'Book';
//$host = 'localhost';
//$port = 8889;
//$link = mysqli_init();
//$connection = mysqli_real_connect(
//    $link,
//    $host,
//    $user,
//    $password,
//    $db,
//    $port
//);


//connect to database
//if ($connection->connect_error) {
//    die("Connection failed: " . $connection->connect_error);
//} else {
//    echo "Connected took MySQL";
//}
?>


<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        table, th, td {
            border: 1px solid black;
        }

        textarea {
            display: inline-block;
            vertical-align: middle;
        }
    </style>
</head>

<body>


<form action="assignment3.php" method="post">
    <table>
        <tr>
            <td>Title</td>
            <td><input id="title" type="text" name="title"></td>
        </tr>
        <tr>
            <td>Author name</td>
            <td><input id="authorName" type="text" name="author"></td>
        </tr>
        <tr>
            <td>Rate</td>
            <td><select name="rate">
                    <option id="rate1" value="1">1 star</option>
                    <option id="rate2" value="2">2 stars</option>
                    <option id="rate3" value="3">3 stars</option>
                    <option id="rate4" value="4" selected>4 stars</option>
                    <option id="rate5" value="5">5 stars</option>
                    <option id="rate6" value="6">6 stars</option>
                </select></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><select name="status">
                    <option id="status1" value="buy">buy</option>
                    <option id="status2" value="read" selected>read</option>
                    <option id="status3" value="finished">finished</option>
                </select></td>
        </tr>
        <tr>
            <td>Comments:</td>
            <td><textarea id="inputValue" name="comments"></textarea></td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" name="submit">Submit</button>
            </td>
        </tr>
    </table>

</form>


<?php
$user = 'root';
$password = 'root';
$db = 'Book';
$host = 'localhost';
//$port = 8889;
//$link = mysqli_init();
$connection = new mysqli(
//    $link,
    $host,
    $user,
    $password,
    $db
//    $port
);
//connect to database
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    echo "Connected took MySQL";
}


if (isset($_POST['submit'])) {
    echo "kkkk";

    class Book
    {
        public $title;
        public $author;
        public $rate;
        public $status;
        public $comments;

        public function setInfo($title, $author, $rate, $status, $comments)
        {
            $this->title = $title;
            $this->author = $author;
            $this->rate = $rate;
            $this->status = $status;
            $this->commment = $comments;
        }

        /**
         * @return mixed
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * @return mixed
         */
        public function getAuthor()
        {
            return $this->author;
        }

        /**
         * @return mixed
         */
        public function getRate()
        {
            return $this->rate;
        }

        /**
         * @return mixed
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * @return mixed
         */
        public function getComments()
        {
            return $this->comments;
        }
    }

    $Book = new Book();
    $Book->setInfo($_POST['title'], $_POST['author'], $_POST['rate'], $_POST['status'], $_POST['comments']);
    $title = $Book->getTitle();
    $author = $Book->getAuthor();
    $rate = $Book->getRate();
    $status = $Book->getStatus();
    $comments = $Book->getComments();

    $validated = false;

    function validation()
    {
        global $validated;

        if (empty($_POST['title'])) {
            echo $_POST['title'] . 'hhjhkhk';
            echo "Title cannot be empty";
        } else {
            if (empty($_POST['author'])) {
                echo "Author cannot be empty";
            } else {
                if (!preg_match("/^([a-zA-Z]+\s?)+$/", $_POST['author'])) {
                    echo "Name can only contain letters.";
                } else {
                    echo "Pass validation";
                    $validated = true;
                }
            }
        }
        return $validated;
    }

    if (validation() == true) {
        echo $validated;

        $sql = "INSERT INTO book(title,author,rate,status,comments) VALUES ('$title','$author','$rate','$status','$comments')";
        if ($connection->query($sql) === true) {
            echo "New book information added";
        } else {
            // echo "Combination of title+author+status must be unique";
        }
    }



}


?>
</body>
</html>