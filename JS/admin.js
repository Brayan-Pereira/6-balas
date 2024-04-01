// validação de entrada tela admin

const userAdmin = "enzo viado"
const passwordAdmin = "12345"


function verificacao() {
    let user = prompt('Informe o usuario do administrador:')
    let password = prompt('Informe a senha do adminstrador:')

    if(user==userAdmin && password==passwordAdmin){
        window.location.href= 'http://localhost/6-BALAS/Pages/admin/admin.html';
    }else{
        alert('Usuário ou senha incorretos!!!')
        window.location.href= 'localhost/6-balas/index.html';
    }
}