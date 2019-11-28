<?php


namespace app\components;
use Yii;

class Helper 
{
	
	public static function getCurrentHour()
	{
		 date_default_timezone_set('America/Lima');

          return date('H');
	}

	public static function getCurrentMinute()
	{
		 date_default_timezone_set('America/Lima');

          return date('i');
	}

	public static function getCurrentTime()
    {
          date_default_timezone_set('America/Lima');
           
          return date('H:i:s');
    }

	public static function getDateTimeNow()
	{
		 date_default_timezone_set('America/Lima');

          return date('Y-m-d H:i:s');
	}

	public static function getDateNow( string $date_format):string
	{
		 date_default_timezone_set('America/Lima');

		 $current_date = '';

		 if($date_format == 'd/m/Y') {

		 	$current_date = date('d/m/Y');

		 }else if ($date_format == 'Y-m-d') {

		 	$current_date = date('Y-m-d');

		 }else{

		 	$current_date = date('d/m/Y');
		 }

         return $current_date;
	}

	public static function validate_date_spanish(string $date)
	{
	    $values = explode('/', $date);

		if(count($values) == 3 && checkdate($values[1], $values[0], $values[2])) {
			
			return true;
	    }
		return false;
	}


	public static function getUserDefault()
	{
          return Yii::$app->user->identity->Empleado_Codigo;
          //return 18885;
	}

	public static function dias_transcurridos($fecha_i, $fecha_f)
	{
		$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
		$dias 	= abs($dias); $dias = floor($dias);		

		return $dias;
	}

	public static function  getMinMaxDateByWeek($year,$week)
	{
		$ano = $year;
		$numerosemana = $week;

		if ($numerosemana > 0 and $numerosemana < 54) {
		
			$numerosemana = $numerosemana;
			$primerdia = $numerosemana * 7 -7;
			$ultimodia = $numerosemana * 7 -1;
			$principioano = "$ano-01-01";
			$fecha1 = date('Y-m-d', strtotime("$principioano + $primerdia DAY")); 
			$fecha2 = date('Y-m-d', strtotime ("$principioano + $ultimodia DAY")); 

		if ($fecha2 <= date('Y-m-d', strtotime("$ano-12-31"))) {$fecha2 = $fecha2;} else {$fecha2 = date('Y-m-d',strtotime("$ano-12-31"));}
		}

		return array($fecha1,$fecha2);
	}

	public static function  getArrayMinMaxByDates($year,$week)
	{

		$arr_fechas = Helper::getMinMaxDateByWeek($year,$week);


		return Helper::devuelveArrayFechasEntreOtrasDos($arr_fechas[0], $arr_fechas[1]);
	}



	public static function devuelveArrayFechasEntreOtrasDos($fechaInicio, $fechaFin)
	{
		$arrayFechas  = array();
		$fechaMostrar = $fechaInicio;

		if($fechaInicio && $fechaFin) {

			while(strtotime($fechaMostrar) <= strtotime($fechaFin)) {

				$arrayFechas[] = $fechaMostrar;
				$fechaMostrar  = date("Y-m-d", strtotime($fechaMostrar . " + 1 day"));
				//Y-m-d
				/*$fechaMostrar_arr_tmp = explode('-',$fechaMostrar);

				 = $fechaMostrar_arr_tmp[2]."/".$fechaMostrar_arr_tmp[1]."/".$fechaMostrar_arr_tmp[1];*/


			}
		}



		return $arrayFechas;
		

	}

	public static function getDatesArrayFormatted($arr_fecha_semana, $separador)
	{

		$arr_fechas = array();

		if(count($arr_fecha_semana)>0) {

			foreach($arr_fecha_semana as $fecha_dia) {

				$fecha_dia_tmp	= explode('-',$fecha_dia);

				$arr_fechas[] = $fecha_dia_tmp[2].'/'.$fecha_dia_tmp[1].'/'.$fecha_dia_tmp[0] ;

			}

		}

		return $arr_fechas;

	}
        
        public static function formateaFecha($fecha,$formato)
        {
            if($formato == 'd/m/Y') {
                
                       $arr = explode('-',$fecha);
                       $fecha =$arr[2].'/'.$arr[1].'/'.$arr[0];
                     
                
            }else{
                
                       $arr = explode('/',$fecha);
                       $fecha =$arr[2].'-'.$arr[1].'-'.$arr[0];
            }
            
            return $fecha;
        }
        
        
}	