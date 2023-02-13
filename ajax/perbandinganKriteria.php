<?php

require_once '../includes/config.php';

class Perbandingan {
    private $conn = "";
    private $table;

    public function __construct($reason, $data) {
        $db = new koneksi();
        $this->conn = $db->getConnection();
        $this->data = $data;
        switch ($reason) {
            case 'data':
                $this->getData();
                break;
            default:
                break;
        }

    }

    private function getData(){
        $result = $this->hitungKretieria();
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result
        );
        echo json_encode($send);
	}

    private function hitungKretieria(){
        // $alternatif = $this->getAlternatif();
        $kriteria = $this->getKriteria();
        $index = count($kriteria);
        $maxBobot = max(array_column($kriteria, 'bobot'));
        $minBobot = min(array_column($kriteria, 'bobot'));
        $Interest = ($maxBobot- $minBobot) / $index;
        for ($i = 0; $i < $index; $i++) {
            for($j= 0; $j < $index; $j++){
                if($kriteria[$i]['bobot'] <= $kriteria[$j]['bobot'] ){
                    $range = $kriteria[$j]['bobot'] - $kriteria[$i]['bobot'];
                } else{
                    $range =  $kriteria[$i]['bobot']-$kriteria[$j]['bobot'];
                }

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

                if($kriteria[$i]['bobot'] == $kriteria[$j]['bobot']) {
                    $matrix[$i][$j] = 1;
                }else if($kriteria[$i]['bobot'] < $kriteria[$j]['bobot']){
                    $matrix[$i][$j] = 1/$row;
                }else if($kriteria[$i]['bobot'] > $kriteria[$j]['bobot']){
                    $matrix[$i][$j] = $row;
                }
            }
        }
        // var_dump(array_sum($matrix));
        return $matrix;
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
    
} 

new Perbandingan($_POST['reason'], json_decode($_POST['data']));