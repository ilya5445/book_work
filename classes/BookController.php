<?php

use fb2\src\FBController;

class BookController {

    public $params;
    private $view;
    private $tpl;
    protected $db;

    public function __construct($params = []) {
        $this->params = $params;
        $this->view = new View;
        $this->db = new DB();
    }

    public function index() {

        $this->tpl = 'create.php';

        if (!empty($_FILES) && isset($_FILES['book'])) {

            $uploaddir = 'books/';
            $file_name = basename($_FILES['book']['name']);
            $uploadfile = $uploaddir . $file_name;

            if (move_uploaded_file($_FILES['book']['tmp_name'], $uploadfile)) {

                $id = $this->db->query(" INSERT INTO `Book` (`book_file`) VALUES ('$file_name') ");
                ob_start();
                header("Location: /$id");

            } else {
                echo "Ошибка загрузки книги";
                die();
            }

        }

        $this->view->render($this->tpl, []);
    }

    public function show() {

        $this->tpl = 'show.php';

        $id = $this->params['id'];
        $page = intval($this->params['page']);
        $book_url = 'books/';

        $book_file = $this->db->queryGetOne(" SELECT `book_file` FROM `Book` WHERE `id` = $id ")['book_file'];
        
        if (!$book_file) die('404');        
        
        $file = file_get_contents($book_url.$book_file);
        $book = new FBController($file);

        $book_info = $book->getBook();

        $pageData = [];
        
        $pageData['id'] = $id;
        $pageData['page'] = $page ? $page : 1;
        $pageData['book'] = $book_info;
        
        $current_page = $book_info->getChapters()[$pageData['page']-1];

        if (!isset($current_page)) die('404');

        $pageData['last_page'] = count($book_info->getChapters());
        
        $pageData['body']['title'] = $current_page->getTitle();
        $pageData['body']['content'] = $current_page->getContent();

        $pageData['meta']['add'] = [];

        if ($page) $pageData['meta']['add'][] = '<meta name="googlebot" content="noindex">';

        $pageData['meta']['title'] = $book_info->getTitleInfo()->getTitle();

        if ($book_info->getTitleInfo()->getAnnotation()) $pageData['meta']['description'] = $book_info->getTitleInfo()->getAnnotation();
        else $pageData['meta']['description'] = mb_substr(strip_tags($current_page->getContent()), 0, 200).'...';

        if ($page) {
            $pageData['meta']['title'] .= ' - страница '.$page;
            $pageData['meta']['description'] .= ' - страница '.$page;
        }

        // Запись просмотров страниц
        $this->db->query(" INSERT INTO `book_history` (`book_id`, `page`, `read`) VALUES ($id, '{$pageData['page']}', '1') ON CONFLICT(`book_id`, `page`) DO UPDATE SET `read` = `read` + 1 ");

        // Получаем колличество просмотров
        $q_page_read = $this->db->queryGetAll(" SELECT `page`, `read` FROM `book_history` WHERE `book_id` = $id ");

        // форматируем просмотры для бысрого доступа
        if (!empty($q_page_read)) foreach ($q_page_read as $item) 
            $page_read[$item['page']-1] = $item['read'];

        $pageData['page_read'] = $page_read ?? null;

        $this->view->render($this->tpl, $pageData);
    }
}