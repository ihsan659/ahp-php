varId.url = '/ajax/perbandinganKriteria.php';
varId.table = document.getElementById('tablePerbandinganKriteria');
varId.tableEigen = document.getElementById('tableNilaiEigen');
varId.lamdaMax = document.getElementById('lamdaMax');
varId.nialiCI = document.getElementById('nilaiCI');
varId.nilaiCR = document.getElementById('nilaiCR');
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
                    location.reload();
                }else{
                    return false
                }
            });
        }
    })
}

getViewData(data.dataType, varId.url);

function getData(method, __data){
    _data = __data.result;
    var table = varId.table;
    var thead = document.createElement('thead');
    var html = document.createElement('tbody');
    if(_data.length != 0){
        var trr = document.createElement('tr');
        for (var a = 0; a < _data.length; a++) {
            var th = document.createElement('th');
            if(a != 0){
                th.innerHTML = 'C'+(a);
            }else{
                th.innerHTML = '';
            }
            trr.appendChild(th);
            thead.appendChild(trr);
        }
        var tr = document.createElement('tr');
        for(var i = 0; i < _data.length; i++){
            var tr = document.createElement('tr');
            Object.keys(_data[i]).forEach(function (key){
                var td = document.createElement('td');
                if(key == 0){
                    var tdd = document.createElement('td');
                    tdd.innerHTML = (_data.length-1) != i ?'C'+(i+1) : 'Jumlah';
                    tr.appendChild(tdd);
                    td.innerHTML = _data[i][key];
                } else{
                    td.innerHTML = _data[i][key];
                }
                tr.appendChild(td);
            })
            html.appendChild(tr);
        }
        table.tHead.innerHTML = thead.innerHTML;
        table.tBodies[0].innerHTML = html.innerHTML;
        viewtableEigen(__data);
    }else{
        alertDataNone('Please generate criteria data', 'warning', 'kriteria.php');
    }
}

function viewtableEigen(_data){
    var _eigen = _data.eigen;
    var criteria = _data.result;
    var thead = document.createElement('thead');
    var html = document.createElement('tbody');
    var tr = document.createElement('tr');
    for (let a = 1; a < _eigen[0].length; a++) {
        var th = document.createElement('th');
        if(a == 1) {
            th.setAttribute('colspan', criteria.length-1)
            th.innerHTML = 'Nilai Eigen';
            tr.appendChild(th);
        }
        if(a == criteria.length-1){
            th.innerHTML = 'Jumlah';
            tr.appendChild(th);
        }
        if(a == criteria.length){
            th.innerHTML = 'Rata-Rata';
            tr.appendChild(th);
        }
        thead.appendChild(tr);
    }
    for (let i = 0; i < _eigen.length; i++) {
        var ttr = document.createElement('tr');
        Object.keys(_eigen[i]).forEach(function (key, value) {
            var td = document.createElement('td');
            td.innerHTML = _eigen[i][key];
            ttr.appendChild(td);
        })
        html.appendChild(ttr);
    }

    varId.tableEigen.tHead.innerHTML = thead.innerHTML;
    varId.tableEigen.tBodies[0].innerHTML = html.innerHTML;
    var lamdaMax = 0;
    for(var i = 0; i < (criteria.length-1); i++){
        lamdaMax = lamdaMax + (_eigen[i][_eigen[0].length-1] * criteria[criteria.length-1][i]);
    }
    lamdaMax = lamdaMax;
    var CI = criteria.length-1;
    var nialiCI = ((lamdaMax-CI)/(CI-1));
    var nilaiCR = nialiCI/nilaiIndeksRandom(CI);
    
    varId.lamdaMax.innerHTML = lamdaMax;
    varId.nialiCI.innerHTML = nialiCI;
    varId.nilaiCR.innerHTML = nilaiCR;
}