varId.url = '/ajax/perbandinganKriteria.php';
varId.table = document.getElementById('tablePerbandinganKriteria');
varId.resetData = document.getElementById('resetData');

var data = {
    id: '',
    dataType : 'data',
    method: 'method'
};

function resetData() {
    data.id = '';
    data.dataType = 'data';
}

varId.resetData.onclick = function(){
    Swal.fire({
        title: 'Are you sure?',
        text: "Sure for Delate this data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delate!'
    }).then((result) => {
        if (result.value) {
            startLoader();
            request('reset', JSON.stringify(data), varId.url).then( async (result) => {
                if (JSON.parse(result).code == 200){
                    varButton.resetData.style.display = 'none';
                }else{
                    return false
                }
            });
        }
    })
}

getViewData(data.dataType, varId.url);

function getData(method, _data){
    _data = _data.result;
    var table = varId.table;
    var html = document.createElement('tbody');

    if(_data.length != 0){
        for(var i = 0; i < _data.length; i++){
            var tr = document.createElement('tr');
            Object.keys(_data[i]).forEach(function (key){
                var td = document.createElement('td');
                if(key == 0){
                    var tdd = document.createElement('td');
                    tdd.innerHTML = 'C'+(i+1);
                    tr.appendChild(tdd);
                    td.innerHTML = _data[i][key];
                }else{
                    td.innerHTML = _data[i][key];
                }
                tr.appendChild(td);
            })
            html.appendChild(tr);
        }
    }else{
        varId.resetData.style.display = 'none';
    }
    table.tBodies[0].innerHTML = html.innerHTML;
}
