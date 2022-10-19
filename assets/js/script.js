$(document).ready( function () {
   listUser();

   $('#tel').inputmask('(99) 99999-9999');
   $('#cpf').inputmask('999.999.999-99');

   $('#edit-tel').inputmask('(99) 99999-9999');
   $('#edit-cpf').inputmask('999.999.999-99');

   closeLoader();
} );

const closeLoader = () => {
    $('.preloader').fadeOut("slow", 0);
}

const openLoader = () => {

    $('.preloader').fadeTo("slow", 1);
}

const addUser = () => {

    openLoader();

    let dados = new FormData($('#form-users')[0]);

    const result = fetch('backend/addUser.php', {
        method: 'POST',
        body: dados
    })
    .then((response)=>response.json())
    .then((result)=> {

        closeLoader();  

        Swal.fire({
            icon: result.return == true ? 'success' : 'error',
            text: result.message,
            title: result.return == true ? 'Sucesso!' : 'Oops',
        })

          result.return == true ? $('#form-users')[0].reset() : ''

          result.return == true ? listUser() : ''
    })
}

const listUser = () =>{
    const result = fetch('backend/listUser.php',{
        method: 'POST',
        body: ''
    })
    .then((response)=>response.json())
    .then((result)=>{

        let data = moment().format('DD/MM/YYYY HH:mm')

        $('#horarioAtualizado').html(data)

        $("#tabela").dataTable().fnDestroy()

        $('#tabela-dados').html('')

        result.map(user=> { 
            $('#tabela-dados').append(`
            <tr>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${moment(user.created_at).format('DD/MM/YYYY HH:mm:ss')}</td>
                <td>
                    <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="ativo" ${user.status==1 ? 'checked' : ''} onchange="updateUserActive(${user.id})">
                    </div>
                </td>
                <td class="text-center">
                    <button class="btn btn-primary" onclick="listUserById(${user.id})"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn btn-danger" onclick="deleteUser(${user.id})"><i class="bi bi-trash3"></i></button>
                </td>
            </tr>
        `)

        })
        $('#tabela').DataTable({
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
            },
            retrieve: true,
        });
    })
}

const updateUserActive = (id) => {
    const result = fetch('backend/updateUserActive.php', {
        method: "POST",
        body: `id=${id}`,
        headers: {
            'content-type': 'application/x-www-form-urlencoded'
        }
    })
    .then((response)=> response.json())
    .then((result)=> {

        Swal.fire({
            icon: result.return == true ? 'success' : 'error',
            text: result.message,
            title: result.return == true ? 'Sucesso!' : 'Oops',
        })
    })
}

const deleteUser = (id) => {
    const result = fetch('backend/deleteUser.php', {
        method: "POST",
        body: `id=${id}`,
        headers: {
            'content-type': 'application/x-www-form-urlencoded'
        }
    })
    .then((response)=> response.json())
    .then((result)=> {

        Swal.fire({
            icon: result.return == true ? 'success' : 'error',
            text: result.message,
            title: result.return == true ? 'Sucesso!' : 'Oops',
        })

        listUser()
    })
}

listUserById = (id) => {
    const result = fetch('backend/listUserById.php', {
        method: "POST",
        body: `id=${id}`,
        headers: {
            'content-type': 'application/x-www-form-urlencoded'
        }
    })
    .then((response)=> response.json())
    .then((result)=> {

        console.log(result);

        $('#edit-name').val(result.name);
        $('#edit-email').val(result.email);
        $('#edit-tel').val(result.telephone);
        $('#edit-cpf').val(result.cpf);

        const modalEdit = new bootstrap.Modal('#update-user-modal');

        modalEdit.show();
    })
}