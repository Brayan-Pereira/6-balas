// validação de entrada tela admin

const userAdmin = "enzo viado"
const passwordAdmin = "12345"


function verificacao() {
    let user = prompt('Informe o usuario do administrador:')
    let password = prompt('Informe a senha do adminstrador:')

    if(user==userAdmin && password==passwordAdmin){
        window.location.href= '/Pages/admin/admin.html';
    }else{
        alert('Usuário ou senha incorretos!!!')
        window.location.href= '/index.html';
    }
}