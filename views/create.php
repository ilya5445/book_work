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