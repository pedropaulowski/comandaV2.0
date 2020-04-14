const tbody = document.getElementById("tbody")

function carregar() {
    axios({
        method: 'get',
        url: '/services/pedidos/',
        params: {
            tipo: "afazer 0"
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
                let obs = json[i].obs

                var ped = ''

                for(var j = 0; j < pedidos.length; j++) {
                    
                    ped += '<li>'+pedidos[j]+'</li>'
   
                }

                $('#tbody').append('<tr class="linha" id="'+id_pedido+'"><th scope="row">'+id_pedido+'</th><td>'+mesa+'</td><td><ul>'+
                ped+
                '</ul></td><td><a onclick="cancelar('+id_pedido+')" class="btn btn-danger text-white"><i class="far fa-trash-alt"></i></a><a onclick="finalizar('+id_pedido+')"class="btn btn-success text-white"><i class="far fa-check-circle"></i></a><a type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter'+id_pedido+'"><i class="far fa-question-circle"></i></a></td></tr>')
                $('#tbody').append('<div class="modal fade id_pedido" id="exampleModalCenter'+id_pedido+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Observações</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="far fa-times-circle"></i></span></button></div><div class="modal-body">'+obs+'</div></div></div></div>')
                                
                var ped = ''
                
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
            tipo: "afazer"
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
                let obs = json[i].obs

                var ped = ''

                for(var j = 0; j < pedidos.length; j++) {
                    
                    ped += '<li>'+pedidos[j]+'</li>'
   
                }

                $('#tbody').append('<tr class="linha" id="'+id_pedido+'"><th scope="row">'+id_pedido+'</th><td>'+mesa+'</td><td><ul>'+
                ped+
                '</ul></td><td><a onclick="cancelar('+id_pedido+')" class="btn btn-danger text-white"><i class="far fa-trash-alt"></i></a><a onclick="finalizar('+id_pedido+')"class="btn btn-success text-white"><i class="far fa-check-circle"></i></a><a type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter'+id_pedido+'"><i class="far fa-question-circle"></i></a></td></tr>')
                $('#tbody').append('<div class="modal fade id_pedido" id="exampleModalCenter'+id_pedido+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Observações</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="far fa-times-circle"></i></span></button></div><div class="modal-body">'+obs+'</div></div></div></div>')
                                
                var ped = ''
                
            }
        }

        setTimeout(atualizar, 1000*15)
    });

}

function cancelar(id) {
    $(`#${id}`).remove()
    $(`.${id}`).remove()

    axios({
        method: 'delete',
        url: '/services/pedidos/',
        data: {
            id_pedido: id
        }
    })
}

function finalizar(id) {
    $(`#${id}`).remove()
    $(`.${id}`).remove()

    axios({
        method: 'put',
        url: '/services/pedidos/',
        data: {
            id_pedido: id,
            estado: 1
        }
    })
}
