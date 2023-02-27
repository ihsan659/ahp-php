varId.url = '/ajax/tugas.php';
varId.Date = document.getElementById('Date');
varId.Criteria = document.getElementById('Criteria');
varId.Keterampilan = document.getElementById('Keterampilan');
varId.Description = document.getElementById('Description');
varId.Bobot = document.getElementById('Bobot');
varId.AttachmentFile = document.getElementById('fileattach');

varId.table = document.getElementById('tableTugas');
varId.modal = document.getElementById('ModalTugas');
varId.dataTable = $('#tableTugas');
var today = new Date().toISOString().substr(0, 10);
var data = {
    id: '',
    nrp: '',
    date : '',
    criteria : '',
    keterampilan : '',
    description : '',
    file: '',
    bobot: '',
    status : 0,
    dataType : 'data',
    method: 'method'
};
const varButton = {
    new : document.getElementById('btnNew'),
    edit : document.getElementById('btnEdit'),
    delete : document.getElementById('btnHapus'),
    cancel : document.getElementById('btnCancel'),
    save : document.getElementById('btnSave'),
}
if(session.role > 0){
    varButton.new.setAttribute('style', 'display: none;');
}

request('kriteria', JSON.stringify(data), JSON.stringify(session), '/ajax/Master.php');
request('keterampilan', JSON.stringify(data), JSON.stringify(session), '/ajax/Master.php');

varButton.new.onclick = function () {
    varId.Date.value = today;
}

function resetData() {
    data.id = '';
    data.criteria = '';
    data.keterampilan = '';
    data.description = '';
    data.bobot = '';
    data.date = '';
    data.file = '';
    data.dataType = 'data';
    varId.Date.value = '';
    varId.Criteria.value = '';
    varId.Keterampilan.value = '';
    varId.Description.value = '';
    varId.Bobot.value = '';
    varId.Date.value = '';
    varId.AttachmentFile.value = '';
}

varButton.cancel.onclick = function () {
    cancel(varId.modal.id);
}

varButton.save.onclick = function () {
    saveData();
}

varId.AttachmentFile.onchange = function (e) {
    newUploadFile(varId.AttachmentFile.files);
}

function newUploadFile(file){
    var fd = new FormData();
    for (let index = 0; index < file.length; index++){
        fd.append('files', file[index]);
        var tempName = file[index].name;
        $.ajax({
            url: base_url + '/ajax/uploadFile.php',
            method: "POST",
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                Toast.fire({
                    icon: 'success',
                    type: 'success',
                    title: 'Upload successfully'
                });
            }
        })
        localStorage.setItem('file', JSON.stringify(tempName));
    }
}

function saveData() {
    method = data.method == 'data' ? 'save' : 'save' + data.method;
    if(varId.Date.value != ''){
        data.date = varId.Date.value;
        data.criteria = varId.Criteria.value;
        data.keterampilan = varId.Keterampilan.value;
        data.description = varId.Description.value;
        data.file = JSON.parse(localStorage.getItem('file')) != null ? JSON.parse(localStorage.getItem('file')) : data.file;
        data.bobot = varId.Bobot.value;
        result = request(method, JSON.stringify(data), JSON.stringify(session), varId.url).then( async (result) => {
            if (JSON.parse(result).code == 200){
                localStorage.removeItem('file');
                resetData();
                return true
            }else{
                return false
            }
        })
    }else{
        alert('Form is Empty', 'Please enter an unique Form', 'error');
        return false;
    }
}

getViewData(data.dataType, varId.url);
function getData(method, _data){
    var modal = $(`#${varId.modal.id}`);
    var backdrop = $('.modal-backdrop');
    if(method == 'save' || method == 'saveedit'){
        modal.method ='method';
        modal.removeClass('show');
        modal.attr("style", "display:none;");
        backdrop.remove();
    }
    refresh(_data, varId.table, varId.dataTable, 'tugas', varId.url);
}


function getEdit(method, _data){
    if(method == 'edit'){
        var __data = _data.result[0];
        data.id = __data.id;
        data.file = __data.file;
        varId.Date.value = __data.date;
        varId.Criteria.value = __data.criteria;
        varId.Keterampilan.value = __data.keterampilan;
        varId.Description.value = __data.description;
        varId.Bobot.value = __data.bobot;
    }
}

function viewTable(datatable, data, length = 0, table, type, url){
    var html = document.createElement('tbody');
    if(length!=0){
        datatable.DataTable().destroy();
        for (var i = 0; i < length; i++){
            var tr = document.createElement('tr');
            Object.keys(data[i]).forEach(function (key){
                var td = document.createElement('td');
                if(key != 'id' && key != 'status' && key != 'file'){
                    td.innerHTML = data[i][key];
                    tr.appendChild(td);
                }
            })
            var tdd = document.createElement('td');  
            // console.log(data[i].status);
            
            if(data[i].status == '0'){
                if(session.nrp ==  data[i].nrp || session.role > 0){
                    var aaaaa = document.createElement('a');
                    var iiiii = document.createElement('i');   
                    iiiii.setAttribute('class', 'material-icons text-info text-sm m-2');
                    aaaaa.setAttribute('class', 'align-middle');
                    aaaaa.setAttribute('data-file', data[i].file);
                    aaaaa.setAttribute('data-id', data[i].id);
                    iiiii.setAttribute('data-method', 'file');
                    aaaaa.setAttribute('onclick', '_file("' + data[i].file + '");');
                    iiiii.innerHTML = 'plagiarism'; 
                    aaaaa.appendChild(iiiii);
                    tdd.appendChild(aaaaa);

                    if(session.role > 0){
                        var aaaa = document.createElement('a');
                        var iiii = document.createElement('i');   
                        iiii.setAttribute('class', 'material-icons text-info text-sm m-2');
                        aaaa.setAttribute('class', 'align-middle');
                        aaaa.setAttribute('data-bobot', data[i].bobot);
                        aaaa.setAttribute('data-id', data[i].id);
                        iiii.setAttribute('data-method', 'approve');
                        aaaa.setAttribute('onclick', '_approve("' + varId.url + '");');
                        iiii.innerHTML = 'assignment_turned_in'; 
                        aaaa.appendChild(iiii);
                        tdd.appendChild(aaaa);
                    }
                    
                    var aa = document.createElement('a');
                    var ii = document.createElement('i');   
                    ii.setAttribute('class', 'material-icons text-success text-sm m-2');
                    aa.setAttribute('class', 'align-middle');
                    aa.setAttribute('data-id', data[i].id);
                    ii.setAttribute('data-method', 'edit');
                    aa.setAttribute('data-bs-toggle', 'modal');
                    aa.setAttribute('data-bs-target', `#${varId.modal.id}`);
                    aa.setAttribute('onclick', '_edit("' + varId.url + '")');
                    ii.innerHTML = 'edit'; 
                    aa.appendChild(ii);
                    tdd.appendChild(aa);
    
                    var aaa = document.createElement('a');
                    var iii = document.createElement('i');   
                    iii.setAttribute('class', 'material-icons text-danger text-sm m-2');
                    aaa.setAttribute('class', 'align-middle');
                    aaa.setAttribute('data-id', data[i].id);
                    iii.setAttribute('data-method', 'delete');
                    aaa.setAttribute('onclick', '_delete("' + varId.url + '");');
                    iii.innerHTML = 'delete'; 
                    aaa.appendChild(iii);
                    tdd.appendChild(aaa);
                }
            }else{
                var span = document.createElement('span');
                span.setAttribute('class', 'badge bg-success');
                span.innerHTML = 'Succcess';
                tdd.appendChild(span);
            }
            
            tr.appendChild(tdd);
            html.appendChild(tr);
        }
        table.tBodies[0].innerHTML = html.innerHTML;
    }
    datatable.DataTable({
        order: [[2, 'asc']],
    });
}

function tableText(text) {
    return (
        '<p class="text-sm mb-0">'+text+'</p>'
    );
}

function id(event) {
    var data = {
        id: event.target.parentNode.dataset.id,
        date: event.target.parentNode.dataset.date,
        bobot: event.target.parentNode.dataset.bobot
    }
    return data;
}