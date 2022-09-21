$(document).ready( function () {
    listUser();
} );

// Função que adiciona usuários
const addUser = () => {
    // Capitura todo o formulário (tudo mesmo, inclusive os valores)
    let dados = new FormData($('#form-users')[0]);

    // Fetch serve para mandar ou receber dados de uma página para outra usando o Ajax, ou seja, a página não irá recarregar
    // Nessa const, iremos enviar os dados do formulário para a página add_user.php
    const result = fetch('backend/add_user.php', {
        method: 'POST',
        body: dados
    })
    // Aqui verificamos se a resposta do arquivo foi em formato .json. (Ela poderia ser uma string, array, etc.)
    .then((response)=>response.json())
    // Se foi em formato .json, declaramos que queremos trabalhar com o resultado da result(const), e colocamos oq quiser dentro da função.
    .then((result) => {
        // Colocamos aqui ->
        Swal.fire({
            title: result.return == true ? 'Ebaaaa' : 'Eitaaa',
            text: result.message,
            icon: result.return == true ? 'success' : 'error',
            confirmButtonText: 'Ok'
        })

        result.return == true ? $('#form-users')[0].reset() : null;
    })

}

const listUser = () => {
    // Requisições para listagem não preciso de METHOD e nem de BODY.
    const result = fetch('backend/list_user.php')
    .then((response)=>response.json())
    .then((result) => {
        result.map(user=>{
            $('#tabela-dados').append(`
                <tr>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td class="text-center">
                        <a href="" class="btn btn-primary">Alterar</a>
                        <a href="" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
            `)
        })
    })
}

$('#table').DataTable({
    "language": {
        url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
    }
});