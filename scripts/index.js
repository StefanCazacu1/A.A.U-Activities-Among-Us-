console.log('HELLo, World!')

const postForm = document.getElementById('postForm')
const thumbnail = document.getElementById('thumbnail')

postForm.addEventListener('change', e => {
	if (e.target.id === 'image') {
		thumbnail.src = e.target.value
		const reader = new FileReader()

		reader.onload = () => {
			thumbnail.src = reader.result
		}
		reader.readAsDataURL(e.target.files[0])
	}
	console.log(e.target)
})

// Get current date information
const today = new Date()
const currentMonth = today.getMonth()
const currentYear = today.getFullYear()
const currentDay = today.getDate()

// Function to generate calendar for the current month
function generateCalendar(year, month, dayToHighlight) {
	const firstDay = new Date(year, month, 1)
	const lastDay = new Date(year, month + 1, 0)

	const tableBody = document
		.getElementById('calendar')
		.getElementsByTagName('tbody')[0]
	tableBody.innerHTML = ''

	let date = 1
	for (let i = 0; i < 6; i++) {
		const row = tableBody.insertRow(i)

		for (let j = 0; j < 7; j++) {
			const cell = row.insertCell(j)

			if (i === 0 && j < firstDay.getDay()) {
				// Empty cells before the first day of the month
			} else if (date > lastDay.getDate()) {
				// Empty cells after the last day of the month
			} else {
				cell.innerHTML = date

				// Highlight the current day
				if (date === dayToHighlight) {
					cell.classList.add('current-day')
				}

				date++
			}
		}
	}
}

// Call the function to generate the calendar for the current month
generateCalendar(currentYear, currentMonth, currentDay)
