<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyCode</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism-tomorrow.css" rel="stylesheet" />
</head>

<body>
    <header>
        <nav>
            <h1>Daily code</h1>
            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-list">
                <li><a href="#home">Home</a></li>
                <li><a href=#statistics>Statistics</a></li>
                <li><a href="#credits">Credits</a></li>
            </ul>

        </nav>
    </header>
    <main id="home">
        <h2>What will be the output?</h2>
        <div class="container-terminal">
            <div class="terminal">
                <div class="mac">
                    <div class="mac-buttons">
                        <span class="red"></span>
                        <span class="yellow"></span>
                        <span class="green"></span>
                    </div>
                    <img src="imgs/icons/<?= $language_values['icon'] ?>" alt="language icon" class="language-icon">
                </div>
                <div class="code">
                    <pre><code class=<?= $language_values['formatting'] ?>><?= htmlspecialchars($code) ?></code></pre>
                </div>
            </div>
        </div>
        <p class="warning">You've already completed today's challenge!</p>
        <form action="#home" method="post">
            <div class="container-output">
                <input type="text" name="output" id="output" placeholder="output..." required>
                <button type="submit" class="button">Ok</button>
            </div>
        </form>
        <form action="#home" method="get" id="form">
            <div class="container-output">
                <select name="dates" id="dates">
                    <?php foreach ($options as $option): ?>
                        <option value="<?= $option['date'] ?>" <?= $option['selected'] ? 'selected' : '' ?>>
                            <?= $option['date'] ?> -
                            <?= $option['language'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button onclick="showOptions()" type="button" id="options">⚙️ see options</button>
            </div>
        </form>
    </main>
    <hr>
    <?php include_once __DIR__ . "/../views/statistics.php"; ?>
    <hr>
    <?php include_once __DIR__ . "/../views/credits.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/plugins/autoloader/prism-autoloader.min.js" defer></script>

    <script>
        let serverResult = "<?= $result ?>";
    </script>
    <script src="script/script.js" defer></script>
    <script src="script/mobile-navbar.js" defer></script>

    <div id="toast" class="toast"></div>
</body>

</html>