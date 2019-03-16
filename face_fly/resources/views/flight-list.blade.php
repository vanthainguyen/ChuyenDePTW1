@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        <section> 
            <h2>{{$name_city_airport_from[0]['city_name']}} <i class="glyphicon glyphicon-arrow-right"></i>{{$name_city_airport_to[0]['city_name']}}</h2>
                
                @foreach($data as $item) 
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><strong><a href="#">{{$item['airline_name']}}</a></strong></h4>
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                            <label class="control-label">From:</label>
                                            
                                            <div><big class="time">{{date("Y-m-d H:i:s", $item['fl_departure_date'])}}</big></div>
                                            
                                            <div><span class="place">{{$name_city_airport_from[0]['city_name']}} ({{$name_city_airport_from[0]['city_code']}})</span></div>
                                            
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label class="control-label">To:</label>
                                           
                                            <div><big class="time">{{date("Y-m-d H:i:s", $item['fl_return_date'])}}</big></div>
                                            
                                            <div><span class="place">{{$name_city_airport_to[0]['city_name']}}({{$name_city_airport_to[0]['city_code']}})</span></div>
                                            
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label class="control-label">Duration:</label>
                                            
                                            <div><big class="time">{{date("H:i",$item['transit_landing_date'])}} </big></div>
                                            <div><strong class="text-danger">{{$item['transit_departure_date']}} Transit</strong></div>
                                            
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            
                                            <h3 class="price text-danger"><strong> {{number_format($item['fl_cost'], 0, ',', '.').' VNĐ'}}</strong></h3>
                                            
                                            <div>
                                                <a href="flight-detail/{{$item['fl_id']}}" class="btn btn-link">See Detail</a>
                                                <a href="flight-book/{{$item['fl_id']}}" class="btn btn-primary">Choose</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <!-- <div class="text-center">
                    <ul class="pagination">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">&lsaquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">&rsaquo;</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div> -->
            @endforeach
            </section>
        </div>
    </main>
    @endsection
