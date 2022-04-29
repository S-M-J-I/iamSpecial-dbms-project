const sendBtn = document.getElementById("send")
const form = document.getElementById("typing-area")
const inputField = document.getElementById("message")
const chatbox = document.getElementById("chat-history")

form.onsubmit = (e) => {
    e.preventDefault()
}

sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "includes/insert-chat.php", true)
    xhr.onload = () => {
        if (xhr.status == 200) {
            inputField.value = ""
        }
    }


    let formData = new FormData(form)
    xhr.send(formData)
}

// check for new chats after 500ms
setInterval(() => {
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "includes/get-chat.php", true)
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let data = xhr.response
                chatbox.innerHTML = data
            }
        }
    }

    let formData = new FormData(form)
    xhr.send(formData)
}, 500)