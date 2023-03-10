varId.url = '/ajax/jabatan.php';
varId.Nama = document.getElementById('Nama');
varId.Description = document.getElementById('Description');
varId.Status = document.getElementById('Status');

varId.table = document.getElementById('tableJabatan');
varId.modal = document.getElementById('ModalJabatan');
varId.dataTable = $('#tableJabatan');
var data = {
    id: '',
    description : '',
    nama : '',
    status : '',
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

function resetData() {
    data.id = '';
    data.description = '';
    data.nama = '';
    data.status = '';
    data.dataType = 'data';
    varId.Description.value = '';
    varId.Nama.value = '';
    varId.Status.checked = false;
}

varButton.cancel.onclick = function () {
    cancel(varId.modal.id);
}

varButton.save.onclick = function () {
    saveData();
}

function saveData() {
    method = data.method == 'data' ? 'save' : 'save' + data.method;
    if(varId.Nama.value != ''){
        data.nama = varId.Nama.value;
        data.description = varId.Description.value;
        data.status = varId.Status.checked == true ? 1 : 0;
        result = request(method, JSON.stringify(data), JSON.stringify(session), varId.url).then( async (result) => {
            if (JSON.parse(result).code == 200){
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
    refresh(_data, varId.table, varId.dataTable, 'jabatan', varId.url);
}
function getEdit(method, _data){
    if(method == 'edit'){
        var __data = _data.result[0];
        data.id = __data.id;
        varId.Nama.value = __data.nama;
        varId.Description.value = __data.keterangan;
        varId.Status.checked = __data.status == 1 ? true : false;
        varId.Nama.parentNode.classList.add('is-filled')
        varId.Description.parentNode.classList.add('is-filled')
    }
}

function viewTable(datatable, data, length = 0, table, type, url){
    var html = document.createElement('tbody');
    if(length!=0){
        datatable.DataTable().destroy();
        for (var i = 0; i < length; i++){
            var tr = document.createElement('tr');
            Object.keys(data[i]).forEach(function (key){
                if(key != 'id'){
                    var td = document.createElement('td');
                    td.innerHTML = data[i][key];
                    tr.appendChild(td);
                }
            })
            var tdd = document.createElement('td');  
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
            tr.appendChild(tdd);
            html.appendChild(tr);
        }
        table.tBodies[0].innerHTML = html.innerHTML;
    }
    datatable.DataTable();
}

function tableText(text) {
    return (
        '<p class="text-sm mb-0">'+text+'</p>'
    );
}

function id(event) {
    var data = {
        id: event.target.parentNode.dataset.id,
        date: event.target.parentNode.dataset.date
    }
    return data;
}