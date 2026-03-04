<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="../global/style.css">
    <link rel="shortcut icon" href="../public/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="dashboard">
        <div class="dashboard-header">
            <h1>
                Dashboard
            </h1>
        </div>

        <section class="table-section">
            <div class="section-title">table codes</div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>language</th>
                        <th>code</th>
                        <th>output</th>
                        <th>date</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($code_values as $value): ?>
                        <tr>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value['language'] ?></td>
                            <td><span class="code-badge"><?= htmlspecialchars($value['code']) ?></span></td>
                            <td><?= $value['output'] ?></td>
                            <td><?= $value['date'] ?></td>
                            <td>
                                <form action="" method="POST">
                                    <button type="submit" name="delete_id_codes" value="<?= $value['id'] ?>"
                                        onclick="return confirm('Are you sure?')">🗑️</button>
                                    <button type="submit" name="edit_id_codes" value="<?= $value['id'] ?>">✏️</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="add-panel">
                <form action="" method="POST">
                    <div class="input-group">
                        <label>LANGUAGE</label>
                        <input name="language" class="dark-input" type="text" placeholder="ex: Python" required>
                    </div>
                    <div class="input-group">
                        <label>CODE</label>
                        <textarea name="code" class="dark-input" rows="1" cols="30" placeholder="code..."
                            required></textarea>
                    </div>
                    <div class="input-group">
                        <label>OUTPUT</label>
                        <input name="output" class="dark-input" type="text" placeholder="output..." required>
                    </div>
                    <div class="input-group">
                        <label>DATE</label>
                        <input name="date_codes" class="dark-input" type="text" placeholder="yyyy-mm-dd" required>
                    </div>
                    <button class="btn-add" type="submit" name="insert_id_codes">
                        ADD VALUE
                    </button>
                </form>
            </div>
        </section>

        <section class="table-section">
            <div class="section-title">table dates</div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>date</th>
                        <th>code_id</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($date_values as $value): ?>
                        <tr>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value['date'] ?></td>
                            <td><?= $value['code_id'] ?></td>
                            <td>
                                <form action="" method="POST">
                                    <button type="submit" name="delete_id_dates" value="<?= $value['id'] ?>"
                                        onclick="return confirm('Are you sure?')">🗑️</button>
                                    <button type="submit" name="edit_id_dates" value="<?= $value['id'] ?>">✏️</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tr>
            </table>

            <div class="add-panel">
                <form action="" method="POST">
                    <div class="input-group">
                        <label>DATE</label>
                        <input name="date_dates" class="dark-input" type="text" placeholder="yyyy-mm-dd" required>
                    </div>
                    <div class="input-group">
                        <label>CODE_ID</label>
                        <input name="code_id" class="dark-input" type="text" placeholder="code_id..." required>
                    </div>
                    <div style="flex: 2; min-width: 20px;"></div>
                    <button class="btn-add" type="submit" name="insert_id_dates">
                        ADD VALUE
                    </button>
                </form>
            </div>
        </section>

        <div class="separator"></div>

        <div class="error-log">
            <h3>
                <i>⚠️</i> ERROR LOG
            </h3>
            <pre>
                <?= $error ?? '' ?>
            </pre>
        </div>

</body>

<div id="toast" class="toast"></div>

<script>
    let js_warning = "<?= $js_warning ?? '' ?>" 
</script>
<script src="../global/script.js"></script>
<script src="script/admin.js"></script>
<script src="script/dashboard.js"></script>

</html>