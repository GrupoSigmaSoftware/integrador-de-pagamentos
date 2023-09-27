<?php

// Incluindo os headers principais na página
require_once('../../configs/headers.php');
// Incluindo as funções principais na página
require_once('../../configs/functions.php');

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
    break;

    case 'DELETE':
        // DELETE
    break;

    case 'PUT':
        // PUT
    break;

    case 'PATCH':
        // PATCH
    break;

    default:
        return returnJson(['message' => 'Método inválido!'], 405);
    break;

}

?>