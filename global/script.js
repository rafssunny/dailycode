// for result notification
window.showToast = function(message, type) {
    const toast = document.getElementById('toast')

    toast.textContent = message
    toast.className = 'toast show ' + type

    setTimeout(() => {
        toast.classList.remove('show')
    }, 2000)
}