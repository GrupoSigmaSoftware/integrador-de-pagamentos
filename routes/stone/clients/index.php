<?php

// Incluindo os headers principais na página
require_once('../../../configs/headers.php');
// Incluindo as funções principais na página
require_once('../../../configs/functions.php');

// Atribuindo o body da requisição para a variável $body, já o convertendo para um array
$body = (array) json_decode(file_get_contents('php://input'), true);
// Atribuindo o método da requisição para a variável $method
$method = (string) $_SERVER['REQUEST_METHOD'];

// Switch para identificar o método da requisição, deixar somente os cases que serão utilizados
switch ($method) {

    case 'GET':
        // GET
    break;

    case 'POST':
        // POST

        // Verificando se todos os campos obrigatórios foram passados
        if (!validateRequiredFields($body, [
            'address.country',
            'address.state',
            'address.city',
            'address.street',
            'birthdate',
            'name',
            'code',
            'document',
            'document_type',
            'type',
            'gender',
            'metadata'
        ])) return returnJson(['message' => 'Campos faltando!'], 400);;

        // Body que será enviado na requisição para a stone
        $bodyRequest = [
            'address' => [
                'country' => $body['address']['country'],
                'state' => $body['address']['state'],
                'city' => $body['address']['city'],
                'zip_code' => $body['address']['zip_code'] ?? null,
                'line_1' => $body['address']['street'],
                'line_2' => $body['address']['complement'] ?? null
            ],
            'birthdate' => $body['birthdate'],
            'name' => $body['name'],
            'email' => $body['email'],
            'code' => $body['code'],
            'document' => $body['document'],
            'document_type' => $body['document_type'],
            'type' => $body['type'],
            'gender' => $body['gender'],
            'metadata' => $body['metadata'],
            'phones' => []
        ];
        
        // Adicionando o telefone da casa, caso tenha sido passado
        if (isset($body['phones']['home_phone'])) {
            $bodyRequest['phones']['home_phone'] = [
                'country_code' => $body['phones']['home_phone']['country_code'],
                'area_code' => $body['phones']['home_phone']['area_code'],
                'number' => $body['phones']['home_phone']['number']
            ];
        }
        
        // Adicionando o telefone móvel, caso tenha sido passado
        if (isset($body['phones']['mobile_phone'])) {
            $bodyRequest['phones']['mobile_phone'] = [
                'country_code' => $body['phones']['mobile_phone']['country_code'],
                'area_code' => $body['phones']['mobile_phone']['area_code'],
                'number' => $body['phones']['mobile_phone']['number']
            ];
        }

        // Início da requisição
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.pagar.me/core/v5/customers",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($bodyRequest),
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            http_response_code(500);
            echo $response;
            exit;
        }

    break;

    case 'DELETE':
        // DELETE
    break;

    case 'PUT':
        // PUT
    break;

    default:
        return returnJson(['message' => 'Método inválido!'], 405);
    break;

}

?>