const select = document.getElementById('dates')
const form = document.getElementById('form')
const result = document.querySelector('.result')

select.addEventListener("change", function () {
    form.submit()
})

if (result && result.textContent.trim() === 'Correct') {
    result.style.display = 'block'
    result.style.backgroundColor = '#268726ff';
} else if (result && result.textContent.trim() == 'Incorrect') {
    result.style.display = 'block'
    result.style.backgroundColor = '#FF2020';
}

