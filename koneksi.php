<?php
    $host = "localhost";
    $dbuser = "root";
    $dbpass = "firman88";
    $dbname = "posgpt";
    $con = mysqli_connect($host, $dbuser, $dbpass, $dbname);

    @session_start();
    $sesuser = @$_SESSION['id_user'];

    function identitas($data = ""){
        if(empty($data) || $data == "judul"){
            return "Poin of Sale GPT";
        }else if($data == "url"){
			return "http://localhost/posgpt/";
		}
    }

    $sesixxxx = mysqli_query($con, "SELECT * FROM users WHERE id_user = '".$sesuser."'");
    $sesi = mysqli_fetch_array($sesixxxx);


    function autotransaksi(){
		date_default_timezone_set('Asia/Jakarta');
		$tglauto			= date("ymd.Hi");
		// $jumun				= date("Hi");
		
		$sdata 				= mysqli_query($con, "SELECT MAX(RIGHT(no_transaksi, 5)) as max_id FROM transaksi WHERE LEFT(no_transaksi,11) = '".$tglauto."'");
		$hdata				= mysqli_num_rows($sdata);
		if ($hdata > 0) {
			$ddata			= mysqli_fetch_array($sdata);
			$id_max_data	= $ddata['max_id'];
			$sort_data 		= (int) substr($id_max_data, 0, 5);
			$sort_data++;
			$new_data 		= $tglauto.".TRANS.". sprintf("%05s", $sort_data);
		} else {
			$new_data		= $tglauto.".TRANS.00001";
		}
		return $new_data;
	}


	function rupiah($angka){

		$hasil_rupiah = number_format($angka, 0, ',', '.');
		return $hasil_rupiah;
	}

	
	function tgl_indo($tunggulin, $jenis = "")
	{
		$tunggulin	= date('Y-m-d', strtotime($tunggulin));
		if(empty($tunggulin)){
			return "";
		}else{
			if(empty($jenis)) {
				
				$belendung = array(
					1 =>   'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
				$pecahkandong = explode('-', $tunggulin);
				return $pecahkandong[2] . ' ' . $belendung[(int) $pecahkandong[1]] . ' ' . $pecahkandong[0];
			} else if($jenis == "x") {
				$belendung = array(
					1 =>   'Jan',
					'Feb',
					'Mar',
					'Apr',
					'Mei',
					'Jun',
					'Jul',
					'Agus',
					'Sept',
					'Okt',
					'Nov',
					'Des'
				);
				$pecahkandong = explode('-', $tunggulin);
				return $pecahkandong[2] . ' ' . $belendung[(int) $pecahkandong[1]] . ' ' . $pecahkandong[0];
			} else {
				return date('d/m/Y', strtotime($tunggulin));
			}
		}
	}
?>