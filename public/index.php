<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyCode</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism-tomorrow.css" rel="stylesheet" />
</head>
<body>
    <?php
        $date = $_GET['dates'] ?? date('m/d/Y');
    ?>
    <header>
        <nav>
            <h1>Daily code</h1>
            <a href="https://github.com/rafssunny" rel="external" target="blank">
                <div class="github">
                    <img src="imgs/github.png" alt="GitHub Logo">
                    <p>Github</p>
                </div>
            </a>
        </nav>
    </header>
    <main>
        <form action="" method="get">
            <h2>What will be the output?</h2>
            <div class="container-terminal">
                <div class="terminal">
                    <div class="mac">
                        <div class="mac-buttons">
                            <span class="red"></span>
                            <span class="yellow"></span>
                            <span class="green"></span>
                        </div>
                        <img src="imgs/icons/python.png" alt="language icon" class="language-icon">
                    </div> 
                    <div class="code">
                        <pre><code class="language-python">print('Hello World')</code></pre>
                    </div>
                </div>
            </div>  
            <div class="container-output">
                <select name="dates" id="dates">
                    <option value="<?=$date?>"><?=$date?></option>
                    <option value="teste">teste</option>
                </select>
                <input type="text" name="output" id="output">
                <button type="submit" class="button">Ok</button>
            </div>
        </form>
    </main>
    <footer>
        <p>Every day a new coding challenge will be released for you to practice your skills.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/components/prism-python.min.js"></script>
    <script>
        const select = document.getElementById('dates')

        select.addEventListener("change", function(){
            window.location.href = "?dates="+select.value 
        })
    </script>
</body>
</html>