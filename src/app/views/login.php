<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="../global/style.css">
    <link rel="shortcut icon" href="../public/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="login-card">
        <h2>Admin login</h2>
        <div class="subhead">Hey, should you be here?</div>

        <form action="#" method="post">
            <div class="input-group">
                <label for="username">username</label>
                <input type="text" id="username" name="username" autocomplete="off" required>
            </div>

            <div class="input-group">
                <label for="password">password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="login-btn">Login</button>

            <hr>
        </form>
    </div>
</body>

<div id="toast" class="toast"></div>

<script>
    let js_warning = "<?= $js_warning ?? '' ?>" 
</script>
<script src="../global/script.js"></script>
<script src="script/admin.js"></script>

</html>