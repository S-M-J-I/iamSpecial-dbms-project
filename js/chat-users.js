const chatThread = document.querySelector(".list-unstyled")

setInterval(() => {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", "includes/components/chat-users.php", true)
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response
                chatThread.innerHTML = data
            }
        }
    }
    xhr.send()
}, 500)