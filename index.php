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