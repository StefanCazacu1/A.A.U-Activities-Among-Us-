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
