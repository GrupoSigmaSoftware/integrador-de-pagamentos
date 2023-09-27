# Documentação da API

## Descrição
Esta API é responsável por processar requisições em um sistema de pagamento.

## Endpoints

### Criar Cliente

- **Método:** POST
- **URL:** `https://seusite.com/api/criar-cliente`
- **Descrição:** Este endpoint permite criar um novo cliente no sistema de pagamento.

#### Requisição

A requisição deve ser feita com o método HTTP POST e um corpo JSON contendo os seguintes campos obrigatórios:

- `address.country` - País do cliente.
- `address.state` - Estado do cliente.
- `address.city` - Cidade do cliente.
- `address.street` - Rua do cliente.
- `birthdate` - Data de nascimento do cliente.
- `name` - Nome completo do cliente.
- `code` - Código do cliente.
- `document` - Documento do cliente.
- `document_type` - Tipo de documento do cliente.
- `type` - Tipo de cliente.
- `gender` - Gênero do cliente.
- `metadata` - Metadados do cliente (coloque o nome do sistema que esta utilizando a api).

Você também pode incluir informações de telefone com os seguintes campos:

- `phones.home_phone.country_code` - Código do país do telefone residencial.
- `phones.home_phone.area_code` - Código de área do telefone residencial.
- `phones.home_phone.number` - Número do telefone residencial.
- `phones.mobile_phone.country_code` - Código do país do telefone móvel.
- `phones.mobile_phone.area_code` - Código de área do telefone móvel.
- `phones.mobile_phone.number` - Número do telefone móvel.

Exemplo de corpo da requisição:

```json
{
    "address": {
        "country": "BR",
        "state": "SP",
        "city": "São Paulo",
        "street": "Rua ABC"
    },
    "birthdate": "1990-01-01",
    "name": "John Doe",
    "code": "12345",
    "document": "1234567890",
    "document_type": "CPF",
    "type": "individual",
    "gender": "male",
    "metadata": "Yacht Club",
    "phones": {
        "home_phone": {
            "country_code": "55",
            "area_code": "11",
            "number": "987654321"
        },
        "mobile_phone": {
            "country_code": "55",
            "area_code": "11",
            "number": "999999999"
        }
    }
}
