const alert = document.getElementById('alert')
const erro = document.getElementById('error')

erro.style.display = 'none'

alert.style.display = 'none'

function logIn() {
    var nome = document.getElementById('nome').value 
    var senha = document.getElementById('senha').value 
    axios.post('/services/usuarios/', {
            "acao": "entrar",
            "nome": nome,
            "senha": senha
      })
      .then(function (response) {
        var json = response.data

        if(json.login == true) 
            window.location.href="/pages/controlpanel/"
        else 
            alert.style.display = 'block'
      })
      .catch(function (error) {
        erro.style.display = 'block'

        erro.innerHTML = error
      })
}