const button = document.querySelector("#send-message");
const resultMessage = document.querySelector("#result-message");

button.addEventListener('click', (e) => {
    e.preventDefault();

    const xhr = new XMLHttpRequest();

    const formData = {
        EmailToSend: document.querySelector("#email-to").value,
        Email: document.querySelector("#enter-email").value,
        PhoneNumber: document.querySelector("#phone-number").value,
        Website: document.querySelector("#website").value,
        Message: document.querySelector("#write-message").value
    }

    xhr.open('POST', 'send_message.php', true)

    xhr.onload = () => {
        if(xhr.status === 200){
            resultMessage.innerText = xhr.responseText
        }
    }

    xhr.setRequestHeader('Content-Type', 'application/json')

    xhr.send(JSON.stringify(formData))
})
