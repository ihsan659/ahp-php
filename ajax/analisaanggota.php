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
        $Eigin = $this->getEigen();
        if($Eigin != null){

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
            $matrixE = $matrix;
            foreach($result as $k => $v){
                $anggota[] = $k;
            }
            $NilaiEigen = $this->generateNilaiEigen($matrix, count($kriteria), $anggota);
            foreach($matrix as $key => $value){
                for($a = 0; $a < count($value); $a++){
                    if($a != count($value)-1){
                        for($b = 0; $b < count($value[$a]); $b++){
                            array_push($matrix[$key][$a], $NilaiEigen[$key][$a][$b]);
                        }
                        if($b){
                            array_push($matrix[$key][$a], $NilaiEigen[$key][$a][$b]);
                        }
                    }
                    
                }
            }


            
            foreach($NilaiEigen as $code => $val){
                for($i = 0; $i < count($val); $i++){
                    if($i != 0){
                        for ($j=0; $j < count($val[$i]); $j++) { 
                            if($j == count($val[$i])-1){
                                // $index[$i][$j][] = (float)$Eigin[$code][0] .' * '. $val[$i][count($val[$i])-1] ' = ' (float)$Eigin[$code][0] * $val[$i][count($val[$i])-1];
                                $index[$i][$j][] = (float)$Eigin[$code][0] * $val[$i][count($val[$i])-1];
                            }
                        }
                    }
                }
            }

            $ix =0;
            for ($n=1; $n <= count($index) ; $n++) { 
                $nilai[$anggota[$ix]][] = array_sum($index[$n][count($index)+1]);
                $ix++;
            }

            
            $send = array(
                'code' => 200,
                'message' => 'success',
                'result' => $result,
                'kriteria' => $kriteria,
                'matrix' => $matrix,
                'nilai' => $nilai
            );
        }else{
            $send = array(
                'code' => 200,
                'message' => 'Success',
                'result' => null,
            );
        }

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
        $anggota = array_keys($rows);
        foreach ($row as $key => $value) {
            for ($a=0; $a < count($value); $a++) {
                for ($b=0; $b < count($value); $b++) { 
                    $matrix[$key][$a][] = $value[$b][$a];
                }
                array_unshift($matrix[$key][$a], $anggota[$a]);
            }
        }
        array_unshift($anggota, '');

        foreach ($matrix as $key => $value) {
            array_unshift($matrix[$key], $anggota);
            for ($i=0; $i <= count($value); $i++) { 
                if($i != 0){
                    $data[$key][] = array_sum(array_column($value, $i));
                }
            }
            array_unshift($data[$key], 'Jumlah');
            array_push($matrix[$key], $data[$key]);
        }

        $jumlah = $data;
        return $matrix;

    }

    private function generateNilaiEigen($matrix, $index, $anggota){
        $jumlah = [];
        $nilai = [];
        $indeksRandom = array(0,0,0.58,0.90,1.12,1.24,1.32,1.41,1.45,1.49,1.51,1.48,1.56,1.57,1.59);
        // Memisahkan Jumlah Dengan Nilai

        foreach($matrix as $key => $value){
            $no = 0;
            for ($i=0; $i < count($value) ; $i++) { 
                if($i == count($value)-1){
                    for ($a=0; $a < count($value[$i]); $a++) { 
                        if($a != 0){
                            $jumlah[$key][] = $value[$i][$a];
                        }
                    }
                }else if($i != 0){
                    for ($a=0; $a < count($value[$i]); $a++) { 
                        if($a != 0){
                            $nilai[$key][$no][] = $value[$i][$a];
                        }
                    }
                    $no++;
                }
            }
        }

        // Menghitung Jumlah dengan Total
        // var_dump();
        for ($a = 1; $a <= count($anggota)+2; $a++) {
            if($a <= count($anggota)){
                if($a == 1){
                    $header[] = 'Nilai Eigen';
                }else{
                    $header[] = '';
                }
            }else if($a == count($anggota)+1){
                $header[] = 'Jumlah';
            }else if($a ==count($anggota)+2){
                $header[] = 'Rata-rata';
            }else{
                $header[] = '';
            }
        } 
        // $header = ['', '', '', '', '', '', '', '', ''];
        foreach($nilai as $code => $val){
            for ($i=0; $i < count($val); $i++){
                for ($j=0; $j<count($val[$i]); $j++) { 
                    $Eigen[$code][$i][] = $val[$i][$j] / $jumlah[$code][$j];
                }
                $total[$code][] = array_sum($Eigen[$code][$i]);
                $ratarata[$code][] = array_sum($Eigen[$code][$i]) / $index;
                array_push($Eigen[$code][$i], array_sum($Eigen[$code][$i]), array_sum($Eigen[$code][$i]) / $index);
                // array_unshift($Eigen[$code], 'Jumlah');
            }
            array_unshift($Eigen[$code], $header);
        }

        // var_dump($Eigen);
        return $Eigen;

    }

    private function getEigen(){
        $sql = "SELECT criteria, nilai FROM eigentotal";    
        if($this->conn->query($sql)->num_rows != 0){
            $query = $this->conn->query($sql);
            while ($row =  mysqli_fetch_assoc($query)){
                $result[$row['criteria']][] = $row['nilai'];
            }
        }else{
            $result = null;
        }
        return $result;
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