const select = document.getElementById('dates')
const form = document.getElementById('form')
let warning = document.querySelector('.warning')

let streak = Number(localStorage.getItem('streak')) || 0
let best_streak = Number(localStorage.getItem('best_streak')) || 0
const streak_DOM = document.getElementById('streak')
const best_streak_DOM = document.getElementById('best_streak')
let selected_date = document.getElementById('dates').value

let attempts_today = Number(localStorage.getItem('attempts_today')) || 0
const attempts_DOM = document.getElementById('attempts')

// streak functions
function verifyStreak(last_access_date, today_date, yesterday_date) {
    // if streak dont exists, start in 0
    if (last_access_date != yesterday_date && last_access_date != today_date) {
        streak = 0
        localStorage.setItem('streak', streak)
    }
}

function setBestStreak() {
    if (streak > best_streak) {
        best_streak = streak
        localStorage.setItem('best_streak', best_streak)
    }
}

// dates functions 
function getTodayDate() {
    return new Date().toISOString().split("T")[0]
}

function getYesterdayDate() {
    const date = new Date();
    date.setDate(date.getDate() - 1);

    const year = date.getFullYear();
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const day = date.getDate().toString().padStart(2, '0');

    return `${year}-${month}-${day}`;
}

// main function for daily access
function initializeDailyAccess() {
    const today_date = getTodayDate()
    const last_access_date = localStorage.getItem('lastAccessDate')
    const yesterday_date = getYesterdayDate()

    verifyStreak(last_access_date, today_date, yesterday_date)

    if (last_access_date != today_date) {
        localStorage.setItem('lastAccessDate', today_date)
        localStorage.setItem('attempts_today', attempts_today)
        localStorage.setItem('firstTodayHit', 'true')
        localStorage.setItem('warning_display', 'none')
    }

    return {
        today_date,
        last_access_date
    }
}

// start daily access logic
const dates = initializeDailyAccess()

// update page after submit
select.addEventListener("change", function () {
    form.submit()
})

// put the correct on result or incorrect and update streak
if (serverResult === 'Correct') {
    showToast('✔ Correct!', 'correct')
    if (selected_date == dates.today_date) {
        if (localStorage.getItem('firstTodayHit') == 'true' && selected_date == dates.today_date) {
            streak++
            localStorage.setItem('streak', streak)
            localStorage.setItem('warning_display', 'block')
        }
        localStorage.setItem('firstTodayHit', 'false')
    } else {
        serverResult = '';
    }
}
if (serverResult === 'Incorrect') {
    showToast('✖ Incorrect!', 'incorrect')

    if (localStorage.getItem('firstTodayHit') == 'true' && selected_date == dates.today_date) {
        attempts_today++
        localStorage.setItem('attempts_today', attempts_today)
    }
}

setBestStreak()

// DOM 
streak_DOM.innerHTML = streak + ' days'
best_streak_DOM.innerHTML = best_streak + ' days'
attempts_DOM.innerHTML = attempts_today + ' attempts'
if (selected_date == dates.today_date) {
    warning.style.display = localStorage.getItem('warning_display')
}

// for result notification
function showToast(message, type) {
    const toast = document.getElementById('toast')

    toast.textContent = message
    toast.className = 'toast show ' + type

    setTimeout(() => {
        toast.classList.remove('show')
    }, 2000)
}

// for menu
function showOptions() {
    const currentDisplay = window.getComputedStyle(select).display

    if (currentDisplay == 'none') {
        select.style.display = 'block'
        document.getElementById('options').innerText = '❌ close'
    } else {
        select.style.display = 'none'
        document.getElementById('options').innerText = '⚙️ see options'
    }
}