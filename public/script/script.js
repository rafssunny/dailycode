const select = document.getElementById('dates')
const form = document.getElementById('form')
const result = document.querySelector('.result')

let streak = localStorage.getItem('streak')
let selected_date = document.getElementById('dates').value

const today_date = new Date().toISOString().split("T")[0]

let yesterday = new Date()
yesterday.setDate(yesterday.getDate()-1)

const last_access = localStorage.getItem('lastAccessDate')
const last_access_day = localStorage.getItem('lastAccessDay')

// if streak dont exists, start in 0
if (streak == null){
    streak = 0
}

// check if is the first acess of the day
if (last_access != today_date){
    localStorage.setItem('lastAccessDate', today_date)
    localStorage.setItem('firstTodayHit', 'true')
}

// update page after submit
select.addEventListener("change", function () {
    form.submit()
})

// put the correct on result or incorrect and update streak
if (result && result.textContent.trim() === 'Correct') {
    result.style.display = 'block'
    result.style.backgroundColor = '#268726ff';
    if (localStorage.getItem('firstTodayHit') == 'true' && selected_date == today_date){
        streak = Number(streak++)
        localStorage.setItem('streak', streak)
    }
    localStorage.setItem('firstTodayHit', 'false')


} else if (result && result.textContent.trim() == 'Incorrect') {
    result.style.display = 'block'
    result.style.backgroundColor = '#FF2020';
}

