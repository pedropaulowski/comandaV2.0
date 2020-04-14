function sair() {

    axios.post('/services/usuarios/', {
            acao: "sair",
      })
      .then(function (response) {
            window.location.href = '../login/'
      })
      .catch(function (error) {
        console.log(error)
      })
}