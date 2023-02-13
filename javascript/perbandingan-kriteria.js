varId.url = '/ajax/perbandinganKriteria.php';
varId.table = document.getElementById('tablePerbandinganKriteria');

var data = {
    id: '',
    dataType : 'data',
    method: 'method'
};

function resetData() {
    data.id = '';
    data.dataType = 'data';
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
    }
    table.tBodies[0].innerHTML = html.innerHTML;
}
