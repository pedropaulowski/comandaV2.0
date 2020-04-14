const tbody = document.getElementById("tbody")

function carregar() {
    axios({
        method: 'get',
        url: '/services/pedidos/',
        params: {
            tipo: "para pagar 0"
        }
    })
  
    .then(function (response) {
        var json = response.data
        console.log(json)

        if(json.length > 0) {
            for(var i in json) {
                let id_pedido = json[i].id_pedido
                let mesa = json[i].mesa
                let pedidos = json[i].pedidos
                let precos = json[i].precos
                let total = json[i].total

                var ped = ''
                var fet = ''
                let feitos = [];
                let precoFeitos = []

                for(var j = 0; j < pedidos.length; j++) {  
                    ped += '<li>'+pedidos[j]+'</li>'

                    if(feitos.indexOf(pedidos[j]) == -1) {
                        feitos.push(pedidos[j])
                        precoFeitos.push(precos[j])
                    }
                    
                }

                for(var j = 0; j < feitos.length; j++) { 
                    let qtd = getOccurrence(pedidos, feitos[j]) 
                    fet += `
                    <li>
                        <ul>
                            <li>${feitos[j]}</li>
                            <li> QTD = <a id="qtd${feitos[j]}">${qtd}</a></li>
                            <li>VALOR UNITÁRIO ${new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(precoFeitos[j])}</li>
                            <li>VALOR TOTAL ${new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(precoFeitos[j]*qtd)}</li>
                        </ul>
                    </li>
                    `
                }

                
                let tr = `
                    <tr id="tr${id_pedido}">
                        <th scope="row">${id_pedido}</th>
                        <td>${mesa}</td>
                        <td>${total}</td>
                        <td>${ped}</td>
                        <td>
                            <a type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#modal${id_pedido}">
                                <i class="fas fa-money-check-alt"></i>
                            </a>
                            <a onclick="cancelar('${id_pedido}')" type="button" class="btn btn-danger text-white">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                `
                let modalIdpedido = `
                <div class="modal fade" id="modal${id_pedido}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pagamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                ${fet}
                                TOTAL R$ <a id="amount${id_pedido}">${total}</a>

                            <form>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <label for="recipient-name" class="col-form-label">Nome:</label>
                                            <input type="text" class="form-control" id="name${id_pedido}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">País:</label>
                                        <input type="text" class="form-control" id="country${id_pedido}" value="br">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <label for="recipient-name" class="col-form-label">Nome Portador do Cartão:</label>
                                            <input type="text" class="form-control" id="card_holder_name${id_pedido}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">Vencimento:</label>
                                        <input type="text" class="form-control" id="card_expiration_date${id_pedido}" value="ex: 0824">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <label for="recipient-name" class="col-form-label">Numero do Cartão:</label>
                                            <input type="text" class="form-control" id="card_number${id_pedido}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">CVV:</label>
                                        <input type="text" class="form-control" id="card_cvv${id_pedido}" value="ex: 111">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="recipient-name" class="col-form-label">CPF:</label>
                                            <input type="text" class="form-control" id="cpf${id_pedido}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="recipient-name" class="col-form-label">TEL:</label>
                                        <input type="text" class="form-control" id="phone_number${id_pedido}" value="ex: +5562990000000">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="email" class="form-control" id="email${id_pedido}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="recipient-name" class="col-form-label">CEP:</label>
                                        <input type="text" class="form-control" id="zipcode${id_pedido}" value="ex: 74000111">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <label for="recipient-name" class="col-form-label">Rua:</label>
                                            <input type="email" class="form-control" id="street${id_pedido}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">Número Rua:</label>
                                        <input type="text" class="form-control" id="street_number${id_pedido}" value="">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">Estado:</label>
                                            <input type="email" class="form-control" id="state${id_pedido}" value = "go">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">Cidade:</label>
                                        <input type="text" class="form-control" id="city${id_pedido}" value="Goiania">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">Bairro:</label>
                                        <input type="text" class="form-control" id="neighborhood${id_pedido}" value="Centro">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button onclick='finalizar(${id_pedido}, ${JSON.stringify(feitos)}, ${JSON.stringify(precoFeitos)})' type="button" class="btn btn-success">Finalizar</button>
                        </div>
                    </div>
                    </div>
                </div>                
                `                
                $('#tbody').append(tr)
                $('#tbody').append(modalIdpedido)
                                
                
            }
        }
            

        setTimeout(atualizar, 1000*15)
    });
}

function atualizar() {

    axios({
        method: 'get',
        url: '/services/pedidos/',
        params: {
            tipo: "para pagar"
        }
    })
    
    .then(function (response) {
        var json = response.data
        console.log(json)

        if(json.length > 0) {
            for(var i in json) {
                let id_pedido = json[i].id_pedido
                let mesa = json[i].mesa
                let pedidos = json[i].pedidos
                let precos = json[i].precos
                let obs = json[i].obs
                let total = json[i].total

                var ped = ''
                var fet = ''
                let feitos = [];
                let precoFeitos = []

                for(var j = 0; j < pedidos.length; j++) {  
                    ped += '<li>'+pedidos[j]+'</li>'

                    if(feitos.indexOf(pedidos[j]) == -1) {
                        feitos.push(pedidos[j])
                        precoFeitos.push(precos[j])
                    }
                    
                }

                for(var j = 0; j < feitos.length; j++) { 
                    let qtd = getOccurrence(pedidos, feitos[j]) 
                    fet += `
                    <li>
                        <ul>
                            <li>${feitos[j]}</li>
                            <li> QTD = <a id="qtd${feitos[j]}">${qtd}</a></li>
                            <li>VALOR UNITÁRIO ${new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(precoFeitos[j])}</li>
                            <li>VALOR TOTAL ${new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(precoFeitos[j]*qtd)}</li>
                        </ul>
                    </li>
                    `
                }

                
                let tr = `
                    <tr id="tr${id_pedido}">
                        <th scope="row">${id_pedido}</th>
                        <td>${mesa}</td>
                        <td>${total}</td>
                        <td>${ped}</td>
                        <td>
                            <a type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#modal${id_pedido}">
                                <i class="fas fa-money-check-alt"></i>
                            </a>
                            <a onclick="cancelar('${id_pedido}')" type="button" class="btn btn-danger text-white">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                `
                let modalIdpedido = `
                <div class="modal fade" id="modal${id_pedido}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pagamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                ${fet}
                                TOTAL R$ <a id="amount${id_pedido}">${total}</a>

                            <form>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <label for="recipient-name" class="col-form-label">Nome:</label>
                                            <input type="text" class="form-control" id="name${id_pedido}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">País:</label>
                                        <input type="text" class="form-control" id="country${id_pedido}" value="br">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <label for="recipient-name" class="col-form-label">Nome Portador do Cartão:</label>
                                            <input type="text" class="form-control" id="card_holder_name${id_pedido}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">Vencimento:</label>
                                        <input type="text" class="form-control" id="card_expiration_date${id_pedido}" value="ex: 0824">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <label for="recipient-name" class="col-form-label">Numero do Cartão:</label>
                                            <input type="text" class="form-control" id="card_number${id_pedido}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">CVV:</label>
                                        <input type="text" class="form-control" id="card_cvv${id_pedido}" value="ex: 111">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="recipient-name" class="col-form-label">CPF:</label>
                                            <input type="text" class="form-control" id="cpf${id_pedido}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="recipient-name" class="col-form-label">TEL:</label>
                                        <input type="text" class="form-control" id="phone_number${id_pedido}" value="ex: +5562990000000">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="email" class="form-control" id="email${id_pedido}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="recipient-name" class="col-form-label">CEP:</label>
                                        <input type="text" class="form-control" id="zipcode${id_pedido}" value="ex: 74000111">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <label for="recipient-name" class="col-form-label">Rua:</label>
                                            <input type="email" class="form-control" id="street${id_pedido}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">Número Rua:</label>
                                        <input type="text" class="form-control" id="street_number${id_pedido}" value="">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">Estado:</label>
                                            <input type="email" class="form-control" id="state${id_pedido}" value = "go">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">Cidade:</label>
                                        <input type="text" class="form-control" id="city${id_pedido}" value="Goiania">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="recipient-name" class="col-form-label">Bairro:</label>
                                        <input type="text" class="form-control" id="neighborhood${id_pedido}" value="Centro">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button onclick='finalizar(${id_pedido}, ${JSON.stringify(feitos)}, ${JSON.stringify(precoFeitos)})' type="button" class="btn btn-success">Finalizar</button>
                        </div>
                    </div>
                    </div>
                </div>                
                `                
                $('#tbody').append(tr)
                $('#tbody').append(modalIdpedido)
                
            }
        }

        setTimeout(atualizar, 1000*15)
    });

}

function cancelar(id) {
    $(`#tr${id}`).remove()
    $(`#modal${id}`).remove()

    axios({
        method: 'delete',
        url: '/services/pedidos/',
        data: {
            id_pedido: id
        }
    })
}

function finalizar(id, feitos, precoFeitos) {
    var amount = parseInt(document.getElementById(`amount${id}`).innerHTML * 100)
    var card_holder_name = document.getElementById(`card_holder_name${id}`).value
    var card_cvv = document.getElementById(`card_cvv${id}`).value
    var card_number = document.getElementById(`card_number${id}`).value
    var card_expiration_date = document.getElementById(`card_expiration_date${id}`).value
    var name = document.getElementById(`name${id}`).value
    var cpf = document.getElementById(`cpf${id}`).value
    var phone_number = document.getElementById(`phone_number${id}`).value
    var email = document.getElementById(`email${id}`).value
    var country = document.getElementById(`country${id}`).value
    var street = document.getElementById(`street${id}`).value
    var street_number = document.getElementById(`street_number${id}`).value
    var state = document.getElementById(`state${id}`).value
    var city = document.getElementById(`city${id}`).value
    var neighborhood = document.getElementById(`neighborhood${id}`).value
    var zipcode = document.getElementById(`zipcode${id}`).value
    console.log(zipcode)

    var precos = precoFeitos
    var items = []

    for(var i = 0; i < feitos.length; i++) {
        let qtd = parseInt(document.getElementById(`qtd${feitos[i]}`).innerHTML)
        let produtos = {
            "id": `"${Math.floor(Math.random() * 10)}`,
            "title": feitos[i],
            "unit_price": parseInt(precos[i]*100),
            "quantity": qtd,
            "tangible": true
        }
        items.push(produtos)
    }

    console.log(items)

    $(`#tr${id}`).remove()



    
    axios({
        method: 'post',
        url: '/services/pagamentos/',
        data: {
            tipo:"criar transacao",
            "amount":amount,
            "card_holder_name": card_holder_name,
            "card_cvv": String(card_cvv),
            "card_number" : String(card_number),
            "card_expiration_date" : String(card_expiration_date),
            "name": name,
            "cpf": String(cpf),
            "phone_number": [
                String(phone_number)
            ],
            "email" : email,
            "country" : country,
            "street" : street,
            "street_number" : String(street_number),
            "state": state,
            "city": city,
            "neighborhood": neighborhood,
            "zipcode": String(zipcode),
            "items": items
        }


    })
    .then(function(response) {
        fecharStatus(id)
    })


}
function fecharStatus(id) {
    axios({
        method: 'put',
        url: '/services/pedidos/',
        data: {
            id_pedido: id,
            estado: 3
        }
    })
}

function getOccurrence(array, value) {
    var count = 0;
    array.forEach((v) => (v === value && count++));
    return count;
}
