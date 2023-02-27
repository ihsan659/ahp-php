varId.url = '/ajax/analisaanggota.php';
varId.tableAnggota = document.getElementById('tableAnggota');
varId.tableMatrix = document.getElementById('tableMatrix');

var data = {
    dataType : 'data',
    method: 'method'
};

function resetData() {
    data.dataType = 'data'
    data.method= 'method';
}

getViewData(data.dataType, varId.url);

function getData(method, _data){
    viewTables(_data);
    stopLoader();
}

function viewTables(data){
    viewtableAnggota(varId.tableAnggota,data);
    viewTablesAlternatif('container-Kriteria',data);
}

function viewtableAnggota(tables, _data){
    var __data = _data.result
    _data.kriteria.unshift({code: 'nrp', name: 'NRP'}, {code: 'Name', name: 'Name'})
    var headLength = Object.keys(_data.kriteria).length;
    let trr = document.createElement('tr');
    for (let i = 0; i < headLength; i++) {
        let th = document.createElement('th');
        th = formatTable(_data.kriteria[i].name, th);
        trr.appendChild(th);
    }

    var tbody = document.createElement('tbody');
    Object.keys(__data).forEach(function (key){
        let tr = document.createElement('tr');
        Object.keys(__data[key]).forEach(function (index){
            let td = document.createElement('td');
            if(index ==  'nrp' || index == 'nama'){
                td = formatTable(__data[key][index], td)
                tr.appendChild(td);
            }else{
                td = formatTable(__data[key][index].reduce((a, b) => a + b, 0), td)
                tr.appendChild(td);
            }
        })
        tbody.appendChild(tr)
    })
    tables.tHead.innerHTML = trr.innerHTML;
    tables.tBodies[0].innerHTML = tbody.innerHTML;
    
}

function viewTablesAlternatif(divId, data){
    var conten = document.getElementById(divId);
    var _data = data.matrix;
    var html = document.createElement('div');
    Object.keys(_data).forEach(function (key){
        var rowDiv = document.createElement('div');
        rowDiv = createTable(_data[key], key, rowDiv);
        html.appendChild(rowDiv);

    })
    conten.innerHTML = html.innerHTML;
}

function createTable(data, key, rowDiv){
    var collDiv = document.createElement('div');
    var card = document.createElement('div');
    var cardBody = document.createElement('div');
    var table = document.createElement('table');
    rowDiv.setAttribute('class', 'row mt-3');
    collDiv.setAttribute('class', 'col-lg-12 mb-lg-0 mb-4');
    card.setAttribute('class', 'card p-3');
    cardBody.setAttribute('class', 'table-responsive');
    table.setAttribute('id', `tableAlternatif${key}`);
    table.setAttribute('class', 'table align-items-center');
    for (let a = 0; a < data.length; a++) {
        var tr = document.createElement('tr');
        for (let b = 0; b < data[a].length; b++) {
            var td = document.createElement('td');
            td.setAttribute('class', 'w-10 text-center');
            td = formatTable(data[a][b], td);
            tr.appendChild(td);
        }
        table.appendChild(tr);
    }
    cardBody.appendChild(table);
    card.appendChild(cardBody);
    collDiv.appendChild(card);
    rowDiv.appendChild(collDiv)
   
    return rowDiv;
}

function formatTable(data, td){
    var div = document.createElement('div');
    var p = document.createElement('p');
    p.classList = 'text-sm font-weight-bold mb-0';
    if((typeof data) == 'number' && (data - Math.floor(data)) !== 0){
        data = data.toFixed(3);
    }
    p.innerHTML = formatNumber(data);
    div.appendChild(p);
    td.appendChild(div);

    return td;
}