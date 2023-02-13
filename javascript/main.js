var varId={};
var base_url = window.location.origin;
varId.loader = document.getElementById('titleLoader');

function startLoader() {
    varId.loader.classList.add('pageloader');
    varId.loader.style.display = "";
}
function stopLoader(){
    varId.loader.classList.remove('pageloader');
    varId.loader.style.display = "none";
}
setTimeout(() => {
    stopLoader();
}, 2000);
async function request(method, data, url){
    if (method != "edit") {
        method = method.replace(/[0-9]/g, '');
    }
    const result = await $.get({
        url : base_url+url,
        type: 'post',
        data : {
            reason: method,
            data: data
        },
        success : function(response){
            try{
                var result = JSON.parse(response);
                if (result.code == 200){
                    if(method == 'pangkat'){
                        getPangkat(method, result);
                    }else if(method == 'jabatan'){
                        getJabatan(method, result);
                    }else if(method == 'edit'){
                        getEdit(method, result);
                    }else if(method == 'delate'){
                        getDelate(method, result);
                    }else if(method == 'getcode'){
                        
                    }else{
                        getData(method, result);
                    }
                }else if (result.code == 500 || result.code == 504 || result.code == 403 || result.code == 201){
                    stopLoader()
                    if (method == 'save' || method == 'saveedit' || method == 'delete') {
                        errorServer(result)
                    }
                }
            }catch(e){
                console.log(e);
            }
        }
    });
    return result;
}

function _edit(url) {
    data.id = id(event).id;
    data.method = 'edit';
    request(data.method, JSON.stringify(data), url);
}

function errorServer(result){
    alert(result.message, 'Please try again', 'error');
}

function _delete(url){
    resetData();
    data.id = id(event).id;
    Swal.fire({
        title: 'Are you sure?',
        text: "Sure for Delete this data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete!'
    }).then((result) => {
        if (result.value) {
            startLoader();
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
            request('delete', JSON.stringify(data), url);
        }
    })
}

function id(event) {
    var data = {
        id: event.target.parentNode.dataset.id,
        date: event.target.parentNode.dataset.date
    }
    return data;
}

function refresh(response = null, table, datatable, type = null, url) {
    response.result == null ? length = 0 : length = response.result.length;
    viewTable(datatable, response.result, length, table, type, url);
    stopLoader();
}
function cancelRefresh() {
    request('data', JSON.stringify(data), varId.url);
}
function getViewData(doc, url){
    data.method = doc;
    resetData();
    request(data.method, JSON.stringify(data), url);
}

function formatDate(date){
    var d = date.split('-');
    return d[2] + '/' + d[1] + '/' + d[0];
}

function cancel(document) {
    swetCancel(document);
}
function selectBox(select){
    if(!select.getAttribute('checked')){
        select.setAttribute("checked", "true");
    }else{
        select.removeAttribute("checked");
        select.removeAttribute("checked");
    }
}

function getPangkat(method, result) {
    varId.pangkat = result.result;
    localStorage.setItem('pangkat', JSON.stringify(varId.pangkat));
    return varId.pangkat;
}
function getJabatan(method, result) {
    varId.jabatan = result.result;
    localStorage.setItem('jabatan', JSON.stringify(varId.jabatan));
    return varId.jabatan;
}

function getSelected(name, select, value, selected = null){
    var options = '';
    options += '<option value="">' + name + '</option>';
    value.forEach(element => {
        options += '<option value="' + element.id + '" >' + element.nama + '</option>';
    });
    select.innerHTML = options; 
}

$('body').toggleClass('loaded');
