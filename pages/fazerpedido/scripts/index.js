var pedidos = [];
var precos = [];

function carregar() {
    axios({
        method: 'get',
        url: '/services/produtos/',
    })
  
    .then(function (response) {
        var json = response.data
        console.log(json)

        for(var i in json) {
            let id_produto = json[i].id_produto
            let produto = json[i].produto
            let preco = json[i].preco
            let descricao = json[i].descricao


            $('#tbody').append('<tr class="linha" id="'+id_produto+'"><th scope="row">'+id_produto+'</th><td>'+produto+'</td><td><ul>'+
            preco+
            '</ul></td><td><a onclick="adicionar(\''+produto+'\', \''+preco+'\', \''+id_produto+'\')" class="btn btn-success text-white"><i class="far fa-check-circle"></i></a><a type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter'+id_produto+'"><i class="far fa-question-circle"></i></a>'+
            '<input id="quantidade'+id_produto+'"class="form-control input" type="number"/>'+
            '</td></tr>')
            $('#tbody').append('<div class="modal fade id_produto" id="exampleModalCenter'+id_produto+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Descrição</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="far fa-times-circle"></i></span></button></div><div class="modal-body">'+descricao+'</div></div></div></div>')
            $(".input").css('width', '84px')
            
        }
            
    });
}

function adicionar(produto, preco, id_produto, quantidade = 1) {
    if(document.getElementById(`quantidade${id_produto}`).value != '')
        quantidade = document.getElementById(`quantidade${id_produto}`).value

    for(var i = 0; i < quantidade; i++) {
        pedidos.push(produto)
        precos.push(preco)
        console.log(pedidos, precos)

    }
}

function fazerPedido() {
    var mesa = document.getElementById('mesa'). value
    var obs = document.getElementById('obs'). value

    axios.post('/services/pedidos/', {
        "mesa": mesa, 
        "pedidos": pedidos,
        "precos": precos,
        "obs": obs
    })

    $('input').val('')
    $('textarea').val('')
    

}