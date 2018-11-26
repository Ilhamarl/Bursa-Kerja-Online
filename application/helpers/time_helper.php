<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
/**
if ( ! defined('BASEPATH')) exit('No direct script access allowed');	
 * Fungsi untuk convert waktu ke d-m-Y
 * @param date
 * @param string default 'd-m-Y'
 * @return string
 */

if(!function_exists('waktu'))
{
	function waktu($date, $format = 'j F Y')
	{
		if($date != '0000-00-00') {
			$convert_date_to_unix = strtotime($date);
			$formating = date($format, $convert_date_to_unix);    		
		} else {
			$formating = '';	
		}

		return $formating;
	}
}

if(!function_exists('tanggal_waktu'))
{
	function tanggal_waktu($date, $format = 'j F Y ( h:i A )')
	{
		if($date != '0000-00-00') {
			$convert_date_to_unix = strtotime($date);
			$formating = date($format, $convert_date_to_unix);    		
		} else {
			$formating = '';	
		}

		return $formating;
	}
}


/**
 * Fungsi untuk convert waktu mysql db 'Y-m-d'
 * @param date $data
 * @param date $format
 * @return string
 */

if(!function_exists('tanggal_db'))
{
	function tanggal_db($date)
	{
		// jika fungsi waktu tersedia
		if(function_exists('waktu')) 
		{
			$formating = waktu($date, 'Y-m-d');
		}

		// jika tidak gunakan native
		else
		{
			$convert_date_to_unix = strtotime( $date );
			$formating = date('Y-m-d', $convert_date_to_unix);
		}

		return $formating;
	}

}

/**
 * Fungsi untuk mendapatkan bulan pada waktu tertentu
 * @param date
 * @return string
 */

if(!function_exists('get_bulan'))
{
	function get_bulan( $date )
	{
		$convert_date_to_unix = strtotime( $date );
		$formating = date( 'n', $convert_date_to_unix);
		return $formating;
	}

}

/**
 * Fungsi menghitung hari
 * @param date
 * @return string
 */

if(!function_exists('count_date'))
{
	function count_date( $date2 )
	{
		// tanggal aktif sekarang
		$date1 = date('Y-m-d');

		// hitung hari
		$days = (strtotime($date1) - strtotime($date2)) / (60 * 60 * 24);

		// return nilai hari
		return $days;
	}

}