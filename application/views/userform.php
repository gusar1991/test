<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>User <?php echo (isset($userid) ? 'edition' :'creation') ?></title>
</head>

<body>
<?php if (!empty($msg)): ?>
    <p><?php echo $msg ?></p>

<?php else: ?>
<form method="post" action="<?php echo ('/users/setuser/' . (isset($userid) ? $userid :'')) ?>" accept-charset="utf-8">

    <div class="col-md-10 col-md-offset-1">
        <div class="block-header">
            <h2>User <?php echo (isset($userid) ? 'edition' :'creation') ?></h2>
        </div>
        <div class="card">
            <div class="form-group">
                <label for="username" class="control-label">User name</label>
                <input type="text" name="username" class="form-control" value="<?php echo isset($userdata->username) ? $userdata->username :'' ?>" id="username" required/>
            </div>
            <div class="form-group">
                <label for="role_id" class="control-label">User role</label>
                <select name="role_id" id="role_id" class="form-control" size="1" required>
                    <option value="">Choose user role (required)</option>
                    <?php foreach ($userroles as $roleItem): ?>
                        <option value="<?php echo $roleItem->role_id ?>"
                            <?php echo (isset($userdata->role_id) && $userdata->role_id == $roleItem->role_id) ? 'selected' : ''?>>
                            <?php echo $roleItem->rolename ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container container-fluid">
            <div class="col-sm-6 col-sm-offset-3 text-center">
                <button type="submit" name="submit" value="save" class="btn btn-success navbar-btn">Save user</button>
            </div>
        </div>
    </nav>
</form>
<?php endif;?>
</body>

</html>