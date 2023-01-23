varId = [];
var base_url = window.location.origin;
varId.msg = document.getElementById("Messange");
varId.boxMsg = document.getElementById("boxMsg");
varId.url = '/ajax/session.php';

varId.Username = document.getElementById('Username');
varId.Password = document.getElementById('Password');
var data = {
    username: '',
    password: ''
};

$('#btnLogin').on('click', function (e) {
    e.preventDefault();
    var result = [];
    data.username = varId.Username.value;
    data.password = varId.Password.value;
    if (data.username == '' || data.password == '') {
        result = {
            "status": false,
            "message": "Please fill all the fields"
        }
        varId.msg.innerHTML = result.message;
        varId.boxMsg.style.display = "block";
    }else{
        requestLogin('login', JSON.stringify(data), varId.url);
    }
})

async function requestLogin(method, data, url){
    const result = await $.get({
        url : base_url+url,
        type: 'post',
        data : {
            reason: method,
            data: data
        },
        success : function(hasil){
            try{
                var respon = JSON.parse(hasil);
                if(respon.code == 200){
                    // console.log(respon);
                    window.location.reload();
                }else if(respon.code == 401){
                    varId.boxMsg.setAttribute('style', 'display:block');
                    varId.msg.innerHTML = respon.status;
                }
            }catch(err){
                console.log(err);
            }
        }
    });
    return result;
}
