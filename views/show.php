<?php
// echo "<pre>";
// print_r($pageData);
// echo "</pre>";
// die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="<?=$pageData['meta']['description']?>">
    <title><?=$pageData['meta']['title']?></title>

    <?php if (isset($pageData['meta']['add']) && !empty($pageData['meta']['add'])): ?>
        <?php foreach($pageData['meta']['add'] as $meta): ?>
            <?=$meta?>
        <?php endforeach ?>
    <?php endif ?>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="my-4">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Оглавление</h5>
                    </div>
                    <div class="card-body">
                        <?php foreach($pageData['book']->getChapters() as $index => $chapter): ?>
                            <div class="py-2 card-padding-x border-bottom">
                                <div class="d-flex align-items-center py-1">
                                    <a class="mx-2 text-truncate" href="/<?=$pageData['id']?>/<?=$pageData['page'] ? 'page-'.($index+1) : ''?>">
                                        <?=$chapter->getTitle()?>
                                    </a>
                                    <div class="ms-auto text-primary">
                                        <?=$pageData['page_read'][$index] ?? 0?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title"><?=$pageData['book']->getChapters()[$pageData['page']-1]->getTitle()?></h1>
                    </div>
                    <div class="card-body">
                        <?=$pageData['book']->getChapters()[$pageData['page']-1]->getContent()?>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($pageData['last_page'] > 1): ?>
            <div class="row pt-4 justify-content-center">
                <div class="col-auto">
                    <nav aria-label="Пример навигации по страницам">
                        <ul class="pagination">
                            
                            <li class="page-item <?=$pageData['page'] <= 1 ? 'disabled' : ''?>">
                                <a class="page-link"
                                    href="<?=$pageData['page'] <= 1 ? '#' : "/{$pageData['id']}/page-".($pageData['page']-1)?>">Предыдущая</a>
                            </li>

                            <?php for($i = 1; $i <= $pageData['last_page']; $i++ ): ?>
                            <li class="page-item <?=$pageData['page'] == $i ? 'active' : ''?>">
                                <a class="page-link" href="<?="/{$pageData['id']}/page-".$i?>"> <?=$i?> </a>
                            </li>
                            <?php endfor; ?>

                            <li class="page-item <?php if($pageData['page'] >= $pageData['last_page']) { echo 'disabled'; } ?>">
                                <a class="page-link"
                                    href="<?=$pageData['page'] >= $pageData['last_page'] ? '#' : "/{$pageData['id']}/page-".($pageData['page']+1)?>">Следующая</a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif ?>
    </div>
</body>
</html>