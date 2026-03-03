<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>JavaScript</td>
                        <td><span class="code-badge">console.log("ok")</span></td>
                        <td>"ok"</td>
                        <td>2025-02-18</td>
                    </tr>
                </tbody>
            </table>

            <div class="add-panel">
                <div class="input-group">
                    <label>LANGUAGE</label>
                    <input class="dark-input" type="text" placeholder="ex: Python" required>
                </div>
                <div class="input-group">
                    <label>CODE</label>
                    <input class="dark-input" type="text" placeholder="code..." required>
                </div>
                <div class="input-group">
                    <label>OUTPUT</label>
                    <input class="dark-input" type="text" placeholder="output..." required>
                </div>
                <div class="input-group">
                    <label>DATE</label>
                    <input class="dark-input" type="text" placeholder="yyyy-mm-dd" required>
                </div>
                <button class="btn-add" aria-label="Adicionar código">
                    ADD VALUE
                </button>
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2025-02-18</td>
                        <td>1</td>
                    </tr>
            </table>

            <div class="add-panel">
                <div class="input-group">
                    <label>DATE</label>
                    <input class="dark-input" type="text" placeholder="yyyy-mm-dd" required>
                </div>
                <div class="input-group">
                    <label>CODE_ID</label>
                    <input class="dark-input" type="text" placeholder="code_id..." required>
                </div>
                <div style="flex: 2; min-width: 20px;"></div>
                <button class="btn-add" aria-label="Adicionar data">
                    ADD VALUE
                </button>
            </div>
        </section>

        <div class="separator"></div>

        <div class="error-log">
            <h3>
                <i>⚠️</i> ERROR LOG
            </h3>
            <pre>

            </pre>
    </div>
</body>
</html>