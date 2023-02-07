function setError(element) {
    const span = element.parentElement.querySelector('span')

    element.style.border = '2px solid #FF0000';
    span.style.display = 'block';
}


function removeError(element) {
    const span = element.parentElement.querySelector('span')

    element.style.border = '';
    span.style.display = 'none';
}


function nameValidate(element) {
    if (element.value.length < 3) {
        setError(element);
    } else {
        removeError(element);
    }
}

function emailValidate(element) {
    const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;

    if (!emailRegex.test(element.value)) {
        setError(element);
    } else {
        removeError(element);
    }
}

function messageValidate(element) {
    if (element.value.length === 0) {
        setError(element);
    } else {
        removeError(element);
    }
}

function submitForm() {
    const payload = {
        nome: document.getElementById('nome').value,
        email: document.getElementById('email').value,
        mensagem: document.getElementById('mensagem').value
    }

    try {
        axios.post('./php/enviaemail.php', payload).then((response) => {
            alert(response.data)
        })
    } catch (e) {
        alert('Houve um erro e o e-mail não foi enviado. Tente novamente.')
    }
}