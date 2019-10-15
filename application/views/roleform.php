<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Role <?php echo (isset($roleid) ? 'edition' :'creation') ?></title>
</head>
<body>
<?php if (!empty($msg)): ?>
    <p><?php echo $msg ?></p>

<?php else: ?>
    <form method="post" action="<?php echo base_url('/roles/setrolerole/' . isset($roleid) ? $roleid :'') ?>" accept-charset="utf-8">

        <div class="col-md-10 col-md-offset-1">
            <div class="block-header">
                <h2>User <?php echo (isset($roleid) ? 'edition' :'creation') ?></h2>
            </div>
            <div class="card">
                <div class="form-group">
                    <label for="rolename" class="control-label">Role name</label>
                    <input type="text" name="rolename" class="form-control" value="<?php echo isset($roledata->rolename) ? $roledata->rolename :'' ?>" id="rolename" required/>
                </div>
            </div>
        </div>

        there must be table with link to profiles of all users with this role

        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div class="container container-fluid">
                <div class="col-sm-6 col-sm-offset-3 text-center">
                    <button type="submit" name="submit" value="save" class="btn btn-success navbar-btn">Save role</button>
                </div>
            </div>
        </nav>
    </form>
<?php endif;?>
</body>
</html>