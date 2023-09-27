<?php

// Função que imprime um array convertido em json para respostas finais da api 
function returnJson(array $obj, int $response_code = 200): void {
    http_response_code($response_code);
    echo json_encode($obj);
    exit;
}

// Função que recebe o body da requisição e um array com os campos obrigatórios e retorna se todos estão presentes
function validateRequiredFields(array $body, array $requiredFields): bool {
    foreach ($requiredFields as $field) {
        $fieldArray = explode('.', $field);
        $temp = $body;
        
        foreach ($fieldArray as $subfield) {
            if (!isset($temp[$subfield])) {
                return false;
            }
            $temp = $temp[$subfield];
        }
    }
    return true;
}

?>