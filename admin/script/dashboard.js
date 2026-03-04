document.addEventListener("DOMContentLoaded", () => {
    const editButtons = document.querySelectorAll("button[name='edit_id_codes'], button[name='edit_id_dates']")

    editButtons.forEach(button => {
        button.onclick = function (e) {
            e.preventDefault()

            const form = this.closest("form")
            const row = this.closest("tr")
            const cells = row.querySelectorAll("td")
            const isCode = this.name === "edit_id_codes"

            const overlay = document.createElement("div")
            overlay.style.position = "fixed"
            overlay.style.top = "0"
            overlay.style.left = "0"
            overlay.style.width = "100%"
            overlay.style.height = "100%"
            overlay.style.background = "rgba(0,0,0,0.8)"
            overlay.style.display = "flex"
            overlay.style.alignItems = "center"
            overlay.style.justifyContent = "center"
            overlay.style.zIndex = "9999"

            const modal = document.createElement("div")
            modal.style.background = "#0a0a0a"
            modal.style.border = "1px solid #1f1f1f"
            modal.style.borderRadius = "12px"
            modal.style.padding = "2rem"
            modal.style.minWidth = "300px"
            modal.style.display = "flex"
            modal.style.flexDirection = "column"
            modal.style.gap = "1rem"

            let fields = ""

            if (isCode) {
                const language = cells[1].innerText
                const code = cells[2].innerText
                const output = cells[3].innerText
                const date = cells[4].innerText

                fields = `
                    <input class="dark-input" name="language" value="${language}" required>
                    <textarea class="dark-input" name="code" required>${code}</textarea>
                    <input class="dark-input" name="output" value="${output}" required>
                    <input class="dark-input" name="date_codes" value="${date}" required>
                `
            } else {
                const date = cells[1].innerText
                const codeId = cells[2].innerText

                fields = `
                    <input class="dark-input" name="date_dates" value="${date}" required>
                    <input class="dark-input" name="code_id" value="${codeId}" required>
                `
            }

            modal.innerHTML = `
                ${fields}
                <div style="display:flex; gap:1rem; justify-content:flex-end;">
                    <button type="button" class="btn-add cancel-btn">Cancel</button>
                    <button type="button" class="btn-add confirm-btn">Confirm</button>
                </div>
            `

            overlay.appendChild(modal)
            document.body.appendChild(overlay)

            modal.querySelector(".cancel-btn").onclick = () => {
                document.body.removeChild(overlay)
            }

            modal.querySelector(".confirm-btn").onclick = () => {
                const inputs = modal.querySelectorAll("input, textarea")
                inputs.forEach(input => {
                    const hidden = document.createElement("input")
                    hidden.type = "hidden"
                    hidden.name = input.name
                    hidden.value = input.value
                    form.appendChild(hidden)
                })
                document.body.removeChild(overlay)
                form.submit()
            }
        }
    })
})