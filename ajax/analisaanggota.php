<?php

include '../includes/config.php';

class AnalisisAnggota {
    private $conn = "";
    private $table;

    public function __construct($reason, $session, $data) {
        $db = new koneksi();
        $this->Session  = $session;
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
        $result = [];
        $kriteria = $this->dataKriteria();
		$sql = "SELECT 
                    tugas.nrp, 
                    anggota.nama, 
                    tugas.bobot,
                    tugas.criteria,
                    tugas.date,
                    tugas.status
                FROM tugas
                    INNER JOIN anggota ON anggota.nrp = tugas.nrp
                where
                    tugas.status = '1' ";
        $query = $this->conn->query($sql);
        while($row = mysqli_fetch_assoc($query)) {
            for($i=0; $i<count($kriteria); $i++){
                if($kriteria[$i]['code'] == $row['criteria']){
                    $res[$row['nrp']]['nrp'] = $row['nrp'];
                    $res[$row['nrp']]['nama'] = $row['nama'];
                    $res[$row['nrp']][$kriteria[$i]['code']][] = (int)$row['bobot'];
                }else{
                    $res[$row['nrp']]['nrp'] = $row['nrp'];
                    $res[$row['nrp']]['nama'] = $row['nama'];
                    $res[$row['nrp']][$kriteria[$i]['code']][] = 0;
                }
            }
        }
        $result = $res;
        $matrix = $this->generateMatrix($kriteria, $result);
        
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result,
            'kriteria' => $kriteria,
            'matrix' => $matrix
        );

        echo json_encode($send);
	}

    private function generateMatrix($criteria, $rows){
        $hasil = [];
        $row = [];
        $matrix = [];
        $no = 0;
        for ($i=0; $i < count($criteria); $i++) { 
            foreach ($rows as $key => $value) {
                $hasil[$criteria[$i]['code']][] = array_sum($rows[$key][$criteria[$i]['code']]);
            }
        }

        foreach ($hasil as $key => $value) {
            $maxBobot = max($value);
            $minBobot = min($value);
            $Interest = ($maxBobot- $minBobot) / count($value);
            for($k = 0; $k < count($value); $k++){
                for($l = 0; $l < count($value); $l++){
                    if($hasil[$key][$k] < $hasil[$key][$l]){
                        $range = (100-($hasil[$key][$k] / $hasil[$key][$l]) *100);
                    } else  if($hasil[$key][$k] > $hasil[$key][$l]){
                        $range = (100-($hasil[$key][$l] / $hasil[$key][$k]) *100);
                    } else{
                        $range = 0;
                    }
                    
                    $Alternatif = $this->setAlternatif($range, $Interest);
                    // var_dump($hasil[$key][$k] . ' == ' . $hasil[$key][$l] . ' : ' . $range . ' => ' . $Alternatif);
                    if($hasil[$key][$k] < $hasil[$key][$l]){
                        $row[$key][$l][] = 1/$Alternatif;
                    }else if ($hasil[$key][$k] > $hasil[$key][$l]) {
                        $row[$key][$l][] = $Alternatif;
                    }else{
                        $row[$key][$l][] = 1;
                    }
                }
            }
        }

        // Transformasi matriks
        foreach ($row as $key => $value) {
            for ($a=0; $a < count($value); $a++) { 
                for ($b=0; $b < count($value); $b++) { 
                    $matrix[$key][$a][] = $value[$b][$a];
                }
            }
        }        
        return $matrix;

    }

    private function dataKriteria(){
        $result = array();
		$sql = "SELECT 
                    code,
                    keterangan as name
                FROM 
                    kriteria ";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
        return $result;
	}

    private function setAlternatif($range, $Interest){
        if($range == 0){
            $row = 1;
        } else if($range <= 20){
            $row = 2;
        } else if($range <= 30){
            $row = 3;
        } else if($range <= 40){
            $row = 4;
        } else if($range <= 50){
            $row = 5;
        } else if($range <= 60){
            $row = 6;
        } else if($range <= 70){
            $row = 7;
        } else if($range <= 80){
            $row = 8;
        } else {
            $row = 9;
        }
        return $row;
    }

    
} 

new AnalisisAnggota($_POST['reason'], json_decode($_POST['session']), json_decode($_POST['data']));