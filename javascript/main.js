var varId={};
var varSelect={};
var base_url = window.location.origin;
varId.loader = document.getElementById('titleLoader');
if(session.role == 0){
    document.getElementById('NavPangkat').style.display = 'none';
    document.getElementById('NavJabatan').style.display = 'none';
    document.getElementById('NavAnggota').style.display = 'none';
}

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


function formatNumber(number) {
    var result = '';
    var check = number === Math.floor(number) 
    if(check === true){
        result = number;
    }else{
        result = number;
    }
    return result;
}

function getDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 

    today = dd + '/' + mm + '/' + yyyy
    document.getElementById("Date").value = today;
}

function selectOption(section, elemet){
    elemet.forEach( function (value){
        var option = document.createElement("option");
        option.value = value.code;
        option.innerHTML = value.name;
        section.appendChild(option);
    });
    return section;
}

function getDataKriteria(method, result){
    selectOption(varId.Criteria, result.result);
}

function getDataKeterampilan(method, result){
    selectOption(varId.Keterampilan, result.result);
}

function getPangkat(method, result){
    varSelect.Pangkat = result.result;
    localStorage.setItem('pangkat', JSON.stringify(varSelect.Pangkat));
    return varSelect.Pangkat;
}

function getJabatan(method, result){
    varSelect.Jabatan = result.result;
    localStorage.setItem('jabatan', JSON.stringify(varSelect.Jabatan));
    return varSelect.Jabatan;
    selectOption(varId.selectJabatan, result.result);
}

async function request(method, data, session, url){
    if (method != "edit") {
        method = method.replace(/[0-9]/g, '');
    }
    const result = await $.get({
        url : base_url+url,
        type: 'post',
        data : {
            reason: method,
            session: session,
            data: data
        },
        success : function(response){
            try{
                var result = JSON.parse(response);
                if (result.code == 200){
                    if(method == 'edit'){
                        getEdit(method, result);
                    } else if(method == 'delate'){
                        getDelate(method, result);
                    } else if(method == 'kriteria'){
                        getDataKriteria(method, result);
                    } else if(method == 'keterampilan'){
                        getDataKeterampilan(method, result);
                    } else if(method == 'pangkat'){
                        getPangkat(method, result);
                    } else if(method == 'jabatan'){
                        getJabatan(method, result);
                    } else {
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
    request(data.method, JSON.stringify(data), JSON.stringify(session), url);
}

function errorServer(result){
    alert(result.message, 'Please try again', 'error');
}

function _file(file){
    if(file != 'null' && file != undefined){
        window.open('assets/upload/'+file);
    }else{
        Swal.fire({
            title: 'File is Not Found!',
            text: "Pleace upload file here",
            icon: 'error',
            // showCancelButton: true,
            confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        })
    }
}
function _approve(url){
    resetData();
    data.id = id(event).id;
    data.bobot = id(event).bobot;
    Swal.fire({
        title: 'Are you sure?',
        text: "Sure for Approve this data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Approve!'
    }).then((result) => {
        if (result.value) {
            startLoader();
            Swal.fire(
                'Approve!',
                'Your file has been approve.',
                'success'
            )
            request('approve', JSON.stringify(data), JSON.stringify(session), url);
        }
    })
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
            request('delete', JSON.stringify(data), JSON.stringify(session), url);
        }
    })
}

function alertDataNone(message, type, target = false) {
    Swal.fire({
        // title: 'Are you sure?',
        text: message,
        icon: type,
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
    }).then((result) => {
        if (result.value) {
            location.replace(target);
        //     startLoader();
        //     Swal.fire(
        //         'Deleted!',
        //         'Your file has been deleted.',
        //         'success'
        //     )
        //     request('delete', JSON.stringify(data), url);
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
    request('data', JSON.stringify(data), JSON.stringify(session), varId.url);
}
function getViewData(doc, url){
    resetData();
    data.method = doc == 'method' ? 'data' : doc;
    request(data.method, JSON.stringify(data), JSON.stringify(session), url);
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
    varId.Jabatan = result.result;
    localStorage.setItem('jabatan', JSON.stringify(varId.Jabatan));
    return varId.Jabatan;
}

function getSelected(name, select, value, selected = null){
    var options = '';
    options += '<option value="">' + name + '</option>';
    value.forEach(element => {
        options += '<option value="' + element.id + '" >' + element.nama + '</option>';
    });
    select.innerHTML = options; 
}
function nilaiIndeksRandom(nilai) {
    nilai >= 15 ? 15 : nilai;
    var indeksRandom = [0,0,0.58,0.90,1.12,1.24,1.32,1.41,1.45,1.49,1.51,1.48,1.56,1.57,1.59];
    return indeksRandom[nilai-1];
}

$('body').toggleClass('loaded');

