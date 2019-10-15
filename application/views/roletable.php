<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c81896db7c.js" crossorigin="anonymous"></script>


    <title>Roles list</title>
</head>
    <body>
    <? if (!empty($msg)): ?>
        <p><?php echo $msg ?></p>

    <? else: ?>
    <div class="col-md-10 col-md-offset-1">
        <div class="block-header">
            <h2>Roles list</h2>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">
                    <button class="btn btn-success btn-sm" title="edit">
                        <a href="/users/getuserrole">add new</a>
                    </button>
                </th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($rolelist as $role): ?>
            <tr>
                <td><?php echo $role['rolename']?></td>
                <td>
                    <button class="btn btn-warning btn-sm" title="delete">
                        <a href="/users/deluserrole/<?php echo $role['id']?>"></a><i class="fas fa-trash-alt"></i>
                    </button>
                    <button class="btn btn-warning btn-sm" title="edit">
                        <a href="/users/getuserrole/<?php echo $role['id']?>"></a><i class="fas fa-user-edit"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <? endif; ?>
    </body>
</html>