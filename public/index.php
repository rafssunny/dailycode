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
    <?php
        include_once('../process/functions.php');
        include_once('../process/variables.php');
        addTodayDate($connection);
    ?>
    <header>
        <nav>
            <h1>Daily code</h1>
            <a href="https://github.com/rafssunny" rel="external" target="_blank">
                <div class="github">
                    <img src="imgs/github.png" alt="GitHub Logo">
                    <p>Github</p>
                </div>
            </a>
        </nav>
    </header>
    
    <main>
        <form action="" method="get" id="form">
            <h2>What will be the output?</h2>
            <div class="container-terminal">
                <div class="terminal">
                    <div class="mac">
                        <div class="mac-buttons">
                            <span class="red"></span>
                            <span class="yellow"></span>
                            <span class="green"></span>
                        </div>
                        <img src="imgs/icons/<?=$language_values['icon']?>" alt="language icon" class="language-icon">
                    </div> 
                    <div class="code">
                        <pre><code class=<?=$language_values['formatting']?>><?=htmlspecialchars($code)?></code></pre>
                    </div>
                </div>
            </div>  
            <div class="result">
                <p><?=$result?></p>
            </div>
            <div class="container-output">
                <select name="dates" id="dates">
                    <?php foreach($dates as $index => $date):?>
                    <?php
                        $selected = (isset($_GET['dates']) && $_GET['dates'] == $date) ? 'selected' : '';    
                    ?>
                        <option value="<?= $date ?>" <?= $selected ?>><?= $date?> - <?=$languages[$index]?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="output" id="output" placeholder="output...">
                <button type="submit" class="button">Ok</button>
            </div>
        </form>
    </main>
    <footer>
        <p>Every day a new coding challenge will be released for you to practice your skills.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/plugins/autoloader/prism-autoloader.min.js" defer></script>

    <script src="script/script.js" defer></script>
</body>
</html>