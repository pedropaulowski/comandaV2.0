<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

require '../../vendor/autoload.php';
require '../../config.php';
require '../../configapi.php';

$method = $_SERVER['REQUEST_METHOD'];
$pagarme = new PagarMe\Client(API_KEY);

switch($method) {
    case 'PUT':

    break;

    case 'DELETE':

    break;

    case 'POST':
        $parametros = (json_decode(file_get_contents("php://input"), true));
        
        switch($parametros['tipo']) {

            case 'criar cartao':

                $card = $pagarme->cards()->create([
                'holder_name' => $parametros['holder_name'],
                'number' => $parametros['number'],
                'expiration_date' => $parametros['expiration_date'],
                'cvv' => $parametros['cvv']
                ]);
                
                $card->id;
            break;
            case 'criar transacao':
                $parametros = (json_decode(file_get_contents("php://input"), true));
                

                /*$card = $pagarme->cards()->create([
                    'holder_name' => $parametros['card_holder_name'],
                    'number' => $parametros['card_number'],
                    'expiration_date' => $parametros['card_expiration_date'],
                    'cvv' => $parametros['card_cvv']
                ]);*/

                $transaction = $pagarme->transactions()->create([
                    'amount' => $parametros['amount'],
                    'payment_method' => 'credit_card',
                    'card_holder_name' => $parametros['card_holder_name'],
                    'card_cvv' => $parametros['card_cvv'],
                    'card_number' => $parametros['card_number'],
                    'card_expiration_date' => $parametros['card_expiration_date'],
                    'customer' => [
                        'external_id' => md5($parametros['name']),
                        'name' => $parametros['name'],
                        'type' => 'individual',
                        'country' => 'br',
                        'documents' => [
                          [
                            'type' => 'cpf',
                            'number' => $parametros['cpf']
                          ]
                        ],
                        'phone_numbers' => $parametros['phone_number'],
                        'email' => $parametros['email']
                    ],
                    'billing' => [
                        'name' => $parametros['name'],
                        'address' => [
                          'country' => $parametros['country'],
                          'street' => $parametros['street'],
                          'street_number' => $parametros['street_number'],
                          'state' => $parametros['state'],
                          'city' => $parametros['city'],
                          'neighborhood' => $parametros['neighborhood'],
                          'zipcode' => $parametros['zipcode']
                        ]
                    ],
                    
                    'items' => $parametros['items']
                    
                    /*[
                        [
                          'id' => '1',
                          'title' => 'Titulo QUaluer',
                          'unit_price' => 300,
                          'quantity' => 1,
                          'tangible' => true
                        ],
                        [
                          'id' => '2',
                          'title' => 'C-3PO',
                          'unit_price' => 700,
                          'quantity' => 1,
                          'tangible' => true
                        ]
                    ]*/
                ]);
                if($transaction->status == 'paid') {
                    http_response_code(200);
                } else {
                    http_response_code(500);
                    $arr = ['error' => 'transaction refused'];
                    echo json_encode($arr);
                }
            break;
        }
    break;

    case 'GET':
        $parametros = (json_decode(file_get_contents("php://input"), true));
    break;

    default:
        echo json_encode($error_array);
    break;
}
