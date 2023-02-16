<?php

require_once '../includes/config.php';

class Kriteria {
    private $conn = "";
    private $table;

    public function __construct($reason, $data) {
        $db = new koneksi();
        $this->conn = $db->getConnection();
        $this->data = $data;
        $this->table = "kriteria";
        switch ($reason) {
            case 'kriteria':
                $this->getData();
                break;
            case 'data':
                $this->getData();
                break;
            case 'getcode':
                $this->getNewID();
                break;
            case 'save':
                $this->saveData();
                break;
            case 'saveedit':
                $this->saveEdit();
                break;
            case 'genareate':
                $this->genareateCriteria();
                break;
            case 'edit':
                $this->editData();
                break;
            case 'delete':
                $this->deleteData();
                break;
            default:
                break;
        }

    }

    private function getData(){
        $result = array();
		$sql = "SELECT 
                    code,
                    keterangan,
                    bobot
                FROM 
                    $this->table ";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
        $jumlah = $this->checkCriteriaNilai();
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result,
            'jumlah' => $jumlah
        );
        echo json_encode($send);
	}

    private function editData(){
        $data = $this->data;
		$sql = "SELECT 
                    code,
                    keterangan,
                    bobot
                FROM 
                    $this->table
                WHERE code = '$data->id'";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
        
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result,
        );

        echo json_encode($send);
	}
    
    private function saveData(){
        $data = $this->data;
        $sql = "INSERT INTO $this->table (
                                    code,
                                    keterangan,
                                    bobot
                                )
                                VALUES(
                                    '$data->code',
                                    '$data->description',
                                    '$data->bobot'
                                )";
        $query = $this->conn->query($sql);
        if ($query) {
            $this->getData();
        }else{
            $send = array(
                'code' => 201,
                'message' => 'Data Tidak dapat disimpan',
                'result' => $data,
            );
            echo json_encode($send);
        }
    }
    
    private function saveEdit(){
        $data = $this->data;
        $sql = "UPDATE 
                    $this->table
                SET
                    keterangan = '$data->description',
                    bobot = '$data->bobot'
                WHERE 
                    code = '$data->id' ";
        $query = $this->conn->query($sql);
        if ($query) {
            $this->getData();
        }
    }
    private function getNewID() {
        $sql = "SELECT 
                    keterangan,
                    code,
                    bobot
                FROM $this->table
                ORDER BY code DESC LIMIT 1";
        $query = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($query);
        if($row != null) {
            $code = explode("C", $row['code']);
            $result = "C".($code[1]+1);
        }else {
            $result = "C1";
        }
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result,
        );

        echo json_encode($send);
    }

    private function deleteData() {
        $data = $this->data;
        $sql = "DELETE FROM $this->table where code = '$data->id'";
        $query = $this->conn->query($sql);
        if ($query) {
            $this->getData();
        }else{
            $send = array(
                'code' => 201,
                'message' => 'Data Tidak dapat disimpan',
                'result' => $query,
            );
            echo json_encode($send);
        }
    }

    private function checkCriteriaNilai(){
        $sql = "SELECT nilai FROM analisa_kriteria ";
        $query = $this->conn->query($sql);
        $row = mysqli_num_rows($query);
        return $row;
    }

    private function genareateCriteria(){
        $kriteria = $this->getKriteria();
        $index = count($kriteria);
        $maxBobot = max(array_column($kriteria, 'bobot'));
        $minBobot = min(array_column($kriteria, 'bobot'));
        $Interest = ($maxBobot- $minBobot) / $index;
        for ($i = 0; $i < $index; $i++){
            for($j= 0; $j < $index; $j++){

                if($kriteria[$i]['bobot'] <= $kriteria[$j]['bobot'] ){
                    $range = $kriteria[$j]['bobot'] - $kriteria[$i]['bobot'];
                } else{
                    $range =  $kriteria[$i]['bobot']-$kriteria[$j]['bobot'];
                }
                $row = $this->setAlternatif($range, $Interest);

                $nilai[$i][$j] = $row;

                if($kriteria[$i]['bobot'] == $kriteria[$j]['bobot']) {
                    $matrix[$i][$j] = 1;
                }else if($kriteria[$i]['bobot'] < $kriteria[$j]['bobot']){
                    $matrix[$i][$j] = 1/$row;
                }else if($kriteria[$i]['bobot'] > $kriteria[$j]['bobot']){
                    $matrix[$i][$j] = $row;
                }

            }
        }
        $check = $this->saveCriteria($matrix, $kriteria, $nilai);
        if($check){
            $send = array(
                'code' => 200,
                'message' => 'success'
            );
            echo json_encode($send);
        }
    }

    private function saveCriteria ($matrix, $kriteria, $nilai){
        foreach ($matrix as $key => $value) {
            foreach ($value as $index => $values){
                $sql = "INSERT INTO analisa_kriteria (
                    pertama,
                    nilai,
                    hasil,
                    kedua
                )
                VALUES(
                    '".$kriteria[$key]['code']."',
                    '".$nilai[$key][$index]."',
                    '".$values."',
                    '".$kriteria[$index]['code']."'
                )";

                $query = $this->conn->query($sql);
            }
        }
        return $query;
    }

    private function getKriteria (){
        $result = array();
		$sql = "SELECT 
                    code,
                    bobot
                FROM kriteria ";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }

        return $result;
    }

    private function getAlternatif (){
        $result = array();
		$sql = "SELECT 
                    kepentingan,
                    keterangan
                FROM alternatif ORDER BY kepentingan ASC";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }

        return $result;
    }

    private function setAlternatif($range, $Interest){
        if($range == 0){
            $row = 1;
        } else if($range <= ($Interest*2)){
            $row = 2;
        } else if($range <= ($Interest*3)){
            $row = 3;
        } else if($range <= ($Interest*4)){
            $row = 4;
        } else if($range <= ($Interest*5)){
            $row = 5;
        } else if($range <= ($Interest*6)){
            $row = 6;
        } else if($range <= ($Interest*7)){
            $row = 7;
        } else if($range <= ($Interest*8)){
            $row = 8;
        } else {
            $row = 9;
        }
        return $row;
    }
    
} 

new Kriteria($_POST['reason'], json_decode($_POST['data']));