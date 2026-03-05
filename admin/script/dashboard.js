// tabs and dashboard visualization (show more/less)
document.addEventListener("DOMContentLoaded", () => {

    const tabs = document.querySelectorAll(".tab-btn")
    const contents = document.querySelectorAll(".tab-content")

    tabs.forEach(btn => {
        btn.onclick = () => {
            tabs.forEach(t => t.classList.remove("active"))
            contents.forEach(c => c.classList.remove("active"))

            btn.classList.add("active")
            document.getElementById(btn.dataset.tab).classList.add("active")
        }
    })

    function limitTable(sectionId, limit = 6) {
        const section = document.getElementById(sectionId)
        const rows = section.querySelectorAll("tbody tr")

        if (rows.length <= limit) return

        rows.forEach((row, index) => {
            if (index >= limit) row.style.display = "none"
        })

        const container = document.createElement("div")
        container.className = "show-more-container"

        const button = document.createElement("button")
        button.className = "btn-add"
        button.textContent = "Show more"

        let expanded = false

        button.onclick = () => {
            expanded = !expanded

            rows.forEach((row, index) => {
                if (index >= limit) {
                    row.style.display = expanded ? "table-row" : "none"
                }
            })

            button.textContent = expanded ? "Show less" : "Show more"
        }

        container.appendChild(button)
        section.querySelector("table").after(container)
    }

    limitTable("codes", 6)
    limitTable("dates", 6)

})

// for the edit section on dashboard
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
                const action = document.createElement("input")
                action.type = "hidden"
                action.name = button.name
                action.value = button.value
                form.appendChild(action)
                document.body.removeChild(overlay)
                form.submit()
            }
        }
    })
})


