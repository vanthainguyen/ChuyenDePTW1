<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class FlightList extends Model
{
    protected $table = 'flight_list';
    protected $timestamp = false;
    protected $primarykey = 'idfly';
    protected $fillable = [
    	'fl_id',
    	'fl_fc-id',
    	'fl_code',
    	'fl_total',
    	'fl_cost',
    	'fl_city_from_id',
    	'fl_city_to_id',
    	'fl_departure_date',
        'fl_return_date',
        'fl_type',
        'fl_airline_id',
        'fl_distance'
    ];

    public function getCityFrom($a)
    {
        $values = FlightList::where('fl_id' , $a)
        ->join('cities','cities.city_id', '=', 'flight_list.fl_city_from_id')
        ->join('airports','airports.airport_id', '=', 'flight_list.fl_airport_id_from')
        ->get();
        return $values;
    }
    public function getCityTo($b)
    {
        $values = FlightList::where('fl_id' , $b)
        ->join('cities','cities.city_id', '=', 'flight_list.fl_city_to_id')
        ->join('airports','airports.airport_id', '=', 'flight_list.fl_airport_id_to')
        ->get();
        return $values;
    }
    public function getDataFlight($id_fly)
    {
        $values = FlightList::where('fl_id',$id_fly)
        ->join('flight_classes','flight_classes.fc_id', '=', 'flight_list.fl_fc_id')
        ->join('airlines','airlines.airline_id', '=', 'flight_list.fl_airline_id')
        ->get();
        return $values;
    }


    /*
    * Hai hàm thao tác tính giá tiền - theo thời gian và theo tỉ lệ giảm giá - tăng giá 
    * 
    */
    public function gia($percent,$giam,$distance)
    {
        if($giam == true )
        {
            if( 0 < $distance && $distance <= 100 )
            {
                $values = 500000 - ( 500000 * $percent/100) ;
            }
            elseif (101 < $distance && $distance <= 200) 
            {
               $values = 1000000 - (1000000 * $percent/100) ;
           }
           elseif (201 < $distance && $distance <= 500) 
           {
               $values = 2000000 - (2000000 * $percent/100) ;
           }
           elseif (501 < $distance && $distance <= 1000) 
           {
                $values =3000000 - (3000000 * $percent/100) ;
           }
           elseif (1001 <$distance && $distance <= 2001) 
           {
                $values = 6000000 - ( 6000000 * $percent/100) ;
           }
           elseif (2001 <$distance && $distance <= 5001) 
           {
                $values = 20000000 - ( 20000000* $percent/100) ;
           }
           else
           {
                $values = 30000000 - ( 30000000* $percent/100) ;
           }
        }
        else
        {
          if( 0 < $distance && $distance <= 100 )
          {
                $values = 500000 + (500000 * $percent/100) ;
          }
            elseif (101 < $distance && $distance <= 200) 
          {
               $values = 1000000 + (1000000 * $percent/100) ;
          }
           elseif (201 < $distance && $distance <= 500) 
          {
               $values = 2000000 + (2000000 * $percent/100) ;
          }
           elseif (501 < $distance && $distance <= 1000) 
           {
                $values = 3000000+ (3000000 * $percent/100) ;
           }
           elseif (1001 <$distance && $distance <= 2001) 
           {
                $values = 6000000 + (6000000 * $percent/100) ;
           }
           elseif (2001 <$distance && $distance <= 5001) 
           {
                $values = 20000000 + (20000000 * $percent/100) ;
           }
           else
           {
                $values = 30000000 + ( 30000000 * $percent/100) ;
           }
        }
        return $values;
    }

    public function tinhtien($time , $distance )
    {
        $obj_fl = new FlightList();
        $time_now = time('Asia/Ho_Chi_Minh'); // Lấy thời gian hiện tại 
        // So sánh thời gian hiện tại - với thời gian trong list danh sách chuyến bay 
        $num_mul = $time - $time_now;
        if($num_mul > 86400 ) // nếu thời gian còn hơn 1 ngày thì mới tính tiền 
        {
            $num_day = $num_mul/86400; // tính số ngày 
            // quét qua vòng lặp 
            if($num_day >= 60 )
            {
                $tongtien = $obj_fl->gia(10,true,$distance );
            }
            elseif (30 <= $num_day && $num_day <= 60) 
            {
                 $tongtien = $obj_fl->gia(5,true,$distance );
            }
            elseif (14 <= $num_day && $num_day <= 30 ) 
            {
                 $tongtien = $obj_fl->gia(10,false,$distance );
            }
            elseif (7 <= $num_day && $num_day <= 14) {
                 $tongtien = $obj_fl->gia(20,false,$distance );
            }
            elseif ( 1 <= $num_day && $num_day <= 7) {
                $tongtien = $obj_fl->gia(50,false,$distance );  
            }
        }
        else
        {
           $tongtien = 0;
        }
        return  $tongtien;
    }

}
