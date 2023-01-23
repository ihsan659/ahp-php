varId.url = '/ajax/anggota.php';
varId.Nrp = document.getElementById('Nrp');
varId.Nama = document.getElementById('Nama');
varId.selectFile = document.getElementById('selectFile');
varId.selectJabatan = document.getElementById('selectJabatan');
varId.selectPangkat = document.getElementById('selectPangkat');
varId.Password = document.getElementById('Password');
varId.Menjabat = document.getElementById('Menjabat');

varId.table = document.getElementById('tableAnggota');
varId.modal = document.getElementById('ModalAnggota');
varId.dataTable = $('#tableAnggota');
var data = {
    id: '',
    nrp : '',
    nama : '',
    status : '',
    selectFile : '',
    selectJabatan : '',
    selectPangkat : '',
    password : '',
    menjabat : '',
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
    data.nrp = '';
    data.nama = '';
    data.status = '';
    data.selectFile = '';
    data.selectJabatan =  '';
    data.selectPangkat = '';
    data.password = '';
    data.menjabat = '';
    data.dataType = 'data';
    varId.Nrp.value = '';
    varId.Nama.value = '';
    varId.selectJabatan.value = '';
    varId.selectPangkat.value = '';
    varId.Menjabat.value = '';
    varId.Password.value = '';
    // varId.Status.checked = false;
}

if (JSON.parse(localStorage.getItem('pangkat')) == null) {
  request('pangkat', JSON.stringify(data), '/ajax/pangkat.php');
} else {
  varId.pangkat = JSON.parse(localStorage.getItem('pangkat'));
}

if (JSON.parse(localStorage.getItem('jabatan')) == null) {
  request('jabatan', JSON.stringify(data), '/ajax/jabatan.php');
} else {
  varId.jabatan = JSON.parse(localStorage.getItem('jabatan'));
}

varButton.new.onclick = function () {
  getSelected('Jabatan', varId.selectJabatan, varId.jabatan);
  getSelected('Pangkat', varId.selectPangkat, varId.pangkat);
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
        data.nrp = varId.Nrp.value;
        data.nama = varId.Nama.value;
        data.selectFile = varId.selectFile.value;
        data.selectJabatan = varId.selectJabatan.value;
        data.selectPangkat = varId.selectPangkat.value;
        data.menjabat = varId.Menjabat.value;
        data.password = varId.Password.value;
        result = request(method, JSON.stringify(data), varId.url).then( async (result) => {
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
    refresh(_data, varId.table, varId.dataTable, 'anggota', varId.url);
}
function getEdit(method, _data){
    if(method == 'edit'){
        var __data = _data.result[0];
        getSelected('Jabatan', varId.selectJabatan, varId.jabatan);
        getSelected('Pangkat', varId.selectPangkat, varId.pangkat);
        data.id = __data.id;
        varId.Nrp.value = __data.nrp;
        varId.Nama.value = __data.nama;
        varId.selectJabatan.value = __data.jabatan;
        varId.selectPangkat.value = __data.pangkat;
        varId.Menjabat.value = __data.tggl_menjabat;
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
                td.innerHTML = data[i][key];
                tr.appendChild(td);
            })
            var tdd = document.createElement('td');  
            var aa = document.createElement('a');
            var ii = document.createElement('i');   
            ii.setAttribute('class', 'material-icons text-success text-sm m-2');
            aa.setAttribute('class', 'align-middle');
            aa.setAttribute('data-id', data[i].nrp);
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
            aaa.setAttribute('data-id', data[i].nrp);
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

function id(event) {
    var data = {
        id: event.target.parentNode.dataset.id,
        date: event.target.parentNode.dataset.date
    }
    return data;
}
