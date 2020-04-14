const alert = document.getElementById('alert')

alert.style.display = 'none'

const alert2 = document.getElementById('alert2')

alert2.style.display = 'none'

function cadastrar() {
    var nome = document.getElementById('nome').value 
    var senha = document.getElementById('senha').value 
    var senha_r = document.getElementById('senha_r').value 

    if(senha === senha_r) {
        axios.post('/services/usuarios/', {
                "acao": "cadastrar",
                "nome": nome,
                "senha": senha
        })
        .then(function (response) {
            var json = response.data

            if(json.singup == true) 
                window.location.href="/pages/controlpanel/"
            else 
                alert.style.display = 'block'
        })
        .catch(function (error) {
            console.log(error)
        })
    } else {
        alert2.style.display = 'block'
        setTimeout(function() {
            alert2.style.display = 'none'
        }, 1200);
    }
}