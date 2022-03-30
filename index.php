<?php

// Автозагрузка классов API Retail
spl_autoload_register(function (string $className) {
	if (file_exists('vendor/' . str_replace('\\', '/', $className) . '.php'))
    	require_once 'vendor/' . str_replace('\\', '/', $className) . '.php';
	if (file_exists('classes/' . str_replace('\\', '/', $className) . '.php'))
    	require_once 'classes/' . str_replace('\\', '/', $className) . '.php';
	if (file_exists('views/' . str_replace('\\', '/', $className) . '.php'))
    	require_once 'views/' . str_replace('\\', '/', $className) . '.php';
});

$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);

$class = 'BookController';
$method = 'index';

$params['id'] = intval($urls[0]);

// Определение страницы
if (isset($urls[1]) && $urls[1]) {
    preg_match('/page-(\d{1,})$/', $urls[1], $page);
    if (!intval($page[1])) die('404');
    $params['page'] = intval($page[1]);
}

if ($params['id']) $method = 'show';

(new $class($params))->$method();
exit();


use fb2\src\FBController;

if (!empty($_FILES) && isset($_FILES['book'])) {

    $uploaddir = 'books/';
    $file_name = basename($_FILES['book']['name']);
    $uploadfile = $uploaddir . $file_name;

    if (move_uploaded_file($_FILES['book']['tmp_name'], $uploadfile)) {

        $db = new DB();
        $id = $db->query(" INSERT INTO `Book` (`book_file`) VALUES ('$file_name') ");
        ob_start();
        header("Location: /$id");

    } else {
        echo "Ошибка загрузки книги";
        die();
    }

}

$file = file_get_contents('books/3.fb2');

$item = new FBController($file);

// echo '<pre>';
// print_r($item->getBook());
// echo '</pre>';

// echo "HELLO";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0;">
            <form class="col-4" enctype="multipart/form-data" method="POST">
                <div class="row justify-content-between">
                    <div class="form-file col-6">
                        <input type="file" class="form-file-input" name="book">
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Загрузить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
