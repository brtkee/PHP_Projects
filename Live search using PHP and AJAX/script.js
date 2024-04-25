const content = document.querySelector(".card-content");
const cardContentEl = document.querySelector(".card-container")

const showLoader = () => {
    if (!content.querySelector(".loader")) {
        const loader = document.createElement('div');
        loader.classList = "loader";

        content.appendChild(loader);
    }
}

const removeLoader = () => {
    const loader = document.querySelector(".loader");

    if (loader) {
        loader.remove();
    }
}

const inputElement = document.querySelector("#query")

inputElement.addEventListener('keypress', () => {
    showLoader()
    const inputValue = inputElement.value

    const xhr = new XMLHttpRequest()

    xhr.open("POST", "show_result.php", true)

    xhr.onload = () => {
        removeLoader()
        if(xhr.status === 200){
            content.innerHTML = xhr.responseText
        }
    }

    xhr.send(inputValue);
})
