<section id="statistics">
    <h1>Statistics</h1>
    <div class="container-statistics">
        <div class="card">
            <p>🔥</p>
            <p id="streak"></p>
            <p class="note">Your Streak</p>
        </div>
        <div class="card">
            <p>🏆</p>
            <p id="best_streak"></p>
            <p class="note">Your best streak</p>
        </div>
        <div class="card">
            <p>🎯</p>
            <p id="attempts"></p>
            <p class="note">Your attempts today</p>
        </div>
        <div class="card">
            <p>🌍</p>
            <p><?= $global_attempts_today->attempts ?> attempts</p>
            <p class="note">Global attempts today</p>
            <p><?= $global_hits_today->hits ?> hits</p>
            <p class="note">Global hits today</p>
        </div>
    </div>
</section>