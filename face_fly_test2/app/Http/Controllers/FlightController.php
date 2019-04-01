<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Airlines;
use App\Model\Airports;
use App\Model\FlightClasses;
use App\Model\Cities;
use App\Model\Customers;
use App\Model\FlightBooking;
use App\Model\Nation;
use App\Model\Transits;
use App\Model\FlightList;
use App\Model\FlightRoute;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Collection;


class FlightController extends Controller
{

    // Function tạo constructor cho trả về view 
    public function __construct() {
        $this->data_view = [
            'test' => 'array',
        ];
    }
    // Page Home  
    public function loadhome()
    {
        //processing
        $city1 = Cities::all();    
        $city2 = Cities::orderBy('city_id','DESC')->get();
        $flightclass = FlightClasses::all();
        $nation1 = Nation::all();
        $nation2 = Nation::orderBy('nation_id','DESC')->get();
        $flight_route = FlightRoute::all();
        // return to view
        $this->data_view = array_merge($this->data_view,[
            'city1'=> $city1 , 
            'flightclass' =>$flightclass,
            'city2'=> $city2,
            'nation1' =>$nation1,
            'nation2' => $nation2,
            'flight_route'=>$flight_route
        ]);

        return view('index', $this->data_view);
    }

    // Page List - tìm kiếm 
    public function getFlightlist(Request $request)
    {
        $obj_fl = new FlightList();

        if($request->city_from == $request->city_to)
        {
            $errors = new MessageBag(['error' => 'Không thể tìm kiếm chuyến bay cùng 1 thành phố ! Vui lòng kiểm tra lại !']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
        else
        {
            // Convert date to int 
            $time_departure = strtotime($request->departure_date);
            $time_return = strtotime($request->return_date);

            // If time is null 
            if( $time_departure == NULL &&  $time_return== NULL )
            {
                # Truy vấn + Phân trang luôn 
                $data  = FlightList::where ([
                    ['fl_flight_route_id', $request->flight_route],
                    ['fl_city_from_id' , $request->city_from] ,
                    ['fl_city_to_id', $request->city_to],
                    ['fl_fc_id', $request->flight_class],
                    ['fl_type', $request->flight_type],
                    ['fl_total', $request->total]])
                ->join('flight_classes','flight_classes.fc_id', '=', 'flight_list.fl_fc_id')
                ->join('airlines','airlines.airline_id', '=', 'flight_list.fl_airline_id')
                ->paginate(4);

                if(count($data) > 0 ) # Nếu có dữ liệu được lấy ra và thời gian đinó lớn hơn hiện tại người đnag truy cập 
                {
                    $name_city_airport_from = $obj_fl->getCityFrom($data[0]['fl_id']);
                    $name_city_airport_to = $obj_fl->getCityTo($data[0]['fl_id']);
                    for ($row = 0; $row < $data->count(); $row++)
                    {
                        $data = $data->filter(function ($value, $key) {
                            return $value['fl_departure_date'] >  time('Asia/Ho_Chi_Minh');
                        });
                        for ($row = 0; $row < $data->count(); $row++)
                        {
                            $num_trans = Transits::where('fl_id' , $data[$row]['fl_id'])
                            ->join('flight_list','transits.transit_fl_id', '=', 'flight_list.fl_id')
                            ->get();
                            if($num_trans->count() > 0)
                            {
                                $duration = 0;
                                for ($row1 = 0; $row1 < $num_trans->count(); $row1++)
                                {
                                    $duration += $num_trans[$row1]->transit_landing_date - $num_trans[$row1]->transit_departure_date;
                                }
                                $data[$row]['transit_departure_date'] = $num_trans->count();
                                $data[$row]['transit_landing_date'] = $duration;
                                $price = $obj_fl->tinhtien($data[$row]['fl_departure_date'] , $data[$row]['fl_distance']);
                                $data[$row]['fl_cost'] = $price;
                                $this->data_view = array_merge($this->data_view,[
                                    'name_city_airport_from' =>$name_city_airport_from,
                                    'name_city_airport_to'=> $name_city_airport_to , 
                                    'data'=> $data
                                ]);
                                return view('flight-list', $this->data_view);
                            }
                            else
                            {
                                $duration = $data[0]['fl_return_date'] - $data[0]['fl_departure_date'] ;
                                $price = $obj_fl->tinhtien($data[$row]['fl_departure_date'] , $data[$row]['fl_distance']);
                                $data[$row]['fl_cost'] = $price;
                                $data[$row]['transit_departure_date'] = $num_trans->count();
                                $data[$row]['transit_landing_date'] = $duration;

                                $this->data_view = array_merge($this->data_view,[
                                    'name_city_airport_from' =>$name_city_airport_from,
                                    'name_city_airport_to'=> $name_city_airport_to , 
                                    'data'=> $data
                                ]);
                                return view('flight-list', $this->data_view);
                            }
                        }
                    }
                }
                else
                {
                        $errors = new MessageBag(['error' => ' Không tìm thấy chuyến bay yêu cầu !!']);
                        return redirect()->back()->withInput()->withErrors($errors);
                }
            }

            else
            {
                # Gom where lại thành nhóm duyệt lệnh 
                    $data  = FlightList::where ([
                        ['fl_city_from_id' , $request->city_from] ,
                        ['fl_city_to_id', $request->city_to],
                        ['fl_fc_id', $request->flight_class],
                        ['fl_type', $request->flight_type],
                        ['fl_total', $request->total],
                        ['fl_departure_date', $time_departure],
                        ['fl_return_date', $time_return]])
                    ->join('flight_classes','flight_classes.fc_id', '=', 'flight_list.fl_fc_id')
                    ->join('airlines','airlines.airline_id', '=', 'flight_list.fl_airline_id')
                    ->paginate(4);
                if(count($data) > 0 ) # Nếu có dữ liệu được lấy ra và thời gian đinó lớn hơn hiện tại người đnag truy cập 
                {
                    $name_city_airport_from = $obj_fl->getCityFrom($data[0]['fl_id']);
                    $name_city_airport_to = $obj_fl->getCityTo($data[0]['fl_id']);
                    for ($row = 0; $row < $data->count(); $row++)
                    {
                        $data = $data->filter(function ($value, $key) {
                            return $value['fl_departure_date'] >  time('Asia/Ho_Chi_Minh');
                        });
                        for ($row = 0; $row < $data->count(); $row++)
                        {
                            $num_trans = Transits::where('fl_id' , $data[$row]['fl_id'])
                            ->join('flight_list','transits.transit_fl_id', '=', 'flight_list.fl_id')
                            ->get();
                            if($num_trans->count() > 0)
                            {
                                $duration = 0;
                                for ($row1 = 0; $row1 < $num_trans->count(); $row1++)
                                {
                                    $duration += $num_trans[$row1]->transit_landing_date - $num_trans[$row1]->transit_departure_date;
                                }
                                $data[$row]['transit_departure_date'] = $num_trans->count();
                                $data[$row]['transit_landing_date'] = $duration;
                                $price = $obj_fl->tinhtien($data[$row]['fl_departure_date'] , $data[$row]['fl_distance']);
                                $data[$row]['fl_cost'] = $price;
                                $this->data_view = array_merge($this->data_view,[
                                    'name_city_airport_from' =>$name_city_airport_from,
                                    'name_city_airport_to'=> $name_city_airport_to , 
                                    'data'=> $data
                                ]);
                                return view('flight-list', $this->data_view);
                            }
                            else
                            {
                                $duration = $data[0]['fl_return_date'] - $data[0]['fl_departure_date'] ;
                                $price = $obj_fl->tinhtien($data[$row]['fl_departure_date'] , $data[$row]['fl_distance']);
                                $data[$row]['fl_cost'] = $price;
                                $data[$row]['transit_departure_date'] = $num_trans->count();
                                $data[$row]['transit_landing_date'] = $duration;

                                $this->data_view = array_merge($this->data_view,[
                                    'name_city_airport_from' =>$name_city_airport_from,
                                    'name_city_airport_to'=> $name_city_airport_to , 
                                    'data'=> $data
                                ]);
                                return view('flight-list', $this->data_view);
                            }
                        }
                    }
                }
                else
                {
                    $errors = new MessageBag(['error' => ' Không tìm thấy chuyến bay yêu cầu !']);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            }
        }    
    }

    // Page Detail 
    public function getDetail($idfly)
    {
        $obj_fl = new FlightList();
        $obj_ts = new Transits();
        $detail_data  = $obj_fl->getDataFlight($idfly);
        $name_city_airport_from = $obj_fl->getCityFrom($idfly);
        $name_city_airport_to = $obj_fl->getCityTo($idfly);
        $detail_transit  = $obj_ts->getTransit($idfly);

        if(count( $detail_transit) > 0)
        {
                // tính thời lượng chung
            $duration = 0;
            for ($row = 0; $row < $detail_transit->count(); $row++)
            {
                $duration += $detail_transit[$row]->transit_landing_date - $detail_transit[$row]->transit_departure_date;
            } 
                // Tính giá tiền chuyến bay
            $price = $obj_fl->tinhtien($detail_data[0]['fl_departure_date'] , $detail_data[0]['fl_distance']);
            $detail_data[0]['fl_cost'] = $price;
                // return 
            $this->data_view = array_merge($this->data_view,[
                'detail_data'=> $detail_data , 
                'detail_transit' =>$detail_transit,
                'duration'=>$duration,
                'name_city_airport_from' =>$name_city_airport_from,
                'name_city_airport_to' =>$name_city_airport_to,
            ]);
            return view('flight-detail', $this->data_view);
        }
        else
        {
                // tính thời lượng chung - khi mà ko có transit 
            $duration = 0;
            $duration = $detail_data[0]['fl_return_date'] - $detail_data[0]['fl_departure_date'] ;
                // Tính giá tiền chuyến bay
            $price = $obj_fl->tinhtien($detail_data[0]['fl_departure_date'] , $detail_data[0]['fl_distance']);
            $detail_data[0]['fl_cost'] = $price;
            $this->data_view = array_merge($this->data_view,[
                'detail_data'=> $detail_data , 
                'detail_transit' =>$detail_transit,
                'duration'=>$duration,
                'name_city_airport_from' =>$name_city_airport_from,
                'name_city_airport_to' =>$name_city_airport_to,
            ]);
            return view('flight-detail', $this->data_view);
        }    

    }

    // Page Booking - đặt vé 
    public function getBooking($idfly)
    {
        $obj_fl = new FlightList();
        $obj_ts = new Transits();
        $detail_data  = $obj_fl->getDataFlight($idfly);
        $name_city_airport_from = $obj_fl->getCityFrom($idfly);
        $name_city_airport_to = $obj_fl->getCityTo($idfly);
        $detail_transit  = $obj_ts->getTransit($idfly);
        $duration = 0;
        for ($row = 0; $row < $detail_transit->count(); $row++)
        {
            $duration += $detail_transit[$row]->transit_landing_date - $detail_transit[$row]->transit_departure_date;
        } 
        $price = $obj_fl->tinhtien($detail_data[0]['fl_departure_date'] , $detail_data[0]['fl_distance']);
        $detail_data[0]['fl_cost'] = $price;
        $this->data_view = array_merge($this->data_view,[
            'detail_data'=> $detail_data , 
            'detail_transit' =>$detail_transit,
            'duration'=>$duration,
            'name_city_airport_from' =>$name_city_airport_from,
            'name_city_airport_to' =>$name_city_airport_to,
        ]);
        return view('flight-book', $this->data_view);
    }


     // Insert booking 
    public function insertBooking(Request $request)
    {

    }
}
