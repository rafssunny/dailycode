const select = document.getElementById('dates')
const form = document.getElementById('form')
const result = document.querySelector('.result')

let streak = localStorage.getItem('streak') || 0
let best_streak = localStorage.getItem('best_streak') || 0
const streak_DOM = document.getElementById('streak')
const best_streak_DOM = document.getElementById('best_streak')
let selected_date = document.getElementById('dates').value

let attempts_today = localStorage.getItem('attempts_today') || 0
const attemps_DOM = document.getElementById('attemps')

// streak functions
function verifyStreak(streak, last_access_day, before_yesterday) {
    // if streak dont exists, start in 0
    if (Number(last_access_day) == before_yesterday) {
        localStorage.setItem('streak', streak)
    }
}

function setBestStreak() {
    if (best_streak <= streak) {
        localStorage.setItem('best_streak', streak)
    }
}

// dates functions 
function getTodayDate() {
    return new Date().toISOString().split("T")[0]
}

function getTodayDayNumber() {
    const date = new Date()
    return date.getDate()
}

function getBeforeYesterdayDayNumber() {
    const date = new Date()
    date.setDate(date.getDate() - 2)
    return date.getDate()
}

// main function for daily access
function initializeDailyAccess() {
    const today_date = getTodayDate()
    const today_day = getTodayDayNumber()
    const last_access = localStorage.getItem('lastAccessDate')
    const last_access_day = localStorage.getItem('lastAccessDay')
    const before_yesterday = getBeforeYesterdayDayNumber()

    if (last_access != today_date) {
        localStorage.setItem('lastAccessDate', today_date)
        localStorage.setItem('attempts_today', attempts_today)
        localStorage.setItem('firstTodayHit', 'true')
    }

    verifyStreak(streak, last_access_day, before_yesterday)

    if (last_access_day != today_day) {
        localStorage.setItem('lastAccessDay', today_day)
    }

    return {
        today_date,
        last_access_day
    }
}

// start daily access logic
const dates = initializeDailyAccess()

// update page after submit
select.addEventListener("change", function () {
    form.submit()
})

// put the correct on result or incorrect and update streak
if (result && result.textContent.trim() === 'Correct') {
    result.style.display = 'block'
    result.style.backgroundColor = '#268726ff';
    if (localStorage.getItem('firstTodayHit') == 'true' && selected_date == dates.today_date) {
        streak = Number(++streak)
        localStorage.setItem('streak', streak)
    }
    localStorage.setItem('firstTodayHit', 'false')


} else if (result && result.textContent.trim() == 'Incorrect') {
    result.style.display = 'block'
    result.style.backgroundColor = '#FF2020';

    if(localStorage.getItem('firstTodayHit') == 'true' && selected_date == dates.today_date) {
        Number(++attempts_today)
        localStorage.setItem('attempts_today', attempts_today)
    }
}

setBestStreak(best_streak, streak)
best_streak = localStorage.getItem('best_streak')

streak_DOM.innerHTML = streak + ' days'
best_streak_DOM.innerHTML = best_streak + ' days' 
attemps_DOM.innerHTML = attempts_today + ' attemps'

