@extends('layouts.app')
@section('content')
    <main>
        <div class="container">  
            <section> 
                @foreach($detail_data as $post)
                <h2>{{$name_city_airport_from[0]['city_name']}} ({{$name_city_airport_from[0]['city_code']}}) <i class="glyphicon glyphicon-arrow-right"></i>{{$name_city_airport_to[0]['city_name']}} ({{$name_city_airport_to[0]['city_code']}})</h2>
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><strong>{{$post['airline_name']}}</strong></h4>
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                            <label class="control-label">From:</label>
                                            
                                            <div><big class="time">{{date("Y-m-d H:i:s",$post['fl_departure_date'])}}</big></div>
                                            
                                            <div><span class="place">{{$name_city_airport_from[0]['city_name']}} ({{$name_city_airport_from[0]['city_code']}})</span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">To:</label>
                                            <div><big class="time">{{date("Y-m-d H:i:s",$post['fl_return_date'])}} </big></div>
                                            <div><span class="place"> {{$name_city_airport_to[0]['city_name']}} ({{$name_city_airport_to[0]['city_code']}}) </span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">Duration:</label>
                                            <div><big class="time">{{date("H:i",$duration)}} </big></div>
                                            <div><strong class="text-danger"> {{$detail_transit->count()}} Transit</strong></div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <h3 class="price text-danger"><strong>{{number_format($post['fl_cost'], 0, ',', '.').' VNĐ'}}</strong></h3>
                                            <div>
                                                <a href="{{route('flight-book',['fl_id'=>$post['fl_id']])}}" class="btn btn-primary">Choose</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#flight-detail-tab">Flight Details</a></li>
                                        <li><a data-toggle="tab" href="#flight-price-tab">Price Details</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="flight-detail-tab" class="tab-pane fade in active">
                                            <ul class="list-group">
                                                    @for($i = -1 ; $i < $detail_transit->count(); $i++)
                                                    <li class="list-group-item">
                                                        <h5>
                                                            <strong class="airline"> </strong>
                                                            <p><span class="flight-class">{{$post['fc_name']}}</span></p>
                                                        </h5>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="row">
                                                                    @if($i == -1)
                                                                        <div class="col-sm-4">
                                                                            <div><big class="time"> {{date("H:i",$post['fl_departure_date'])}} </big></div>
                                                                            <div><small class="date">{{date("d M Y",$post['fl_departure_date'])}}</small>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-sm-4">
                                                                            <div><big class="time"> {{date("H:i",$detail_transit[$i]['transit_landing_date'])}} </big></div>
                                                                            <div><small class="date">{{date("d M Y",$detail_transit[$i]['transit_landing_date'])}}</small>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    
                                                                    
                                                                    <div class="col-sm-6">
                                                                        <div><span class="place">
                                                                            @if($i == -1)
                                                                                {{$name_city_airport_from[0]['city_name']}} ({{$name_city_airport_from[0]['city_code']}})
                                                                            @else
                                                                                {{$detail_transit[$i]['city_name']}} ({{$detail_transit[$i]['city_code']}})
                                                                            @endif
                                                                        </span></div>
                                                                        <div><small class="airport">
                                                                            @if($i == -1)
                                                                                {{$name_city_airport_from[0]['airport_name']}}
                                                                            @else
                                                                                {{$detail_transit[$i]['airport_name']}}
                                                                            @endif</small></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <i class="glyphicon glyphicon-arrow-right"></i>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="row">
                                                                    @if($i == $detail_transit->count()-1 )
                                                                        <div class="col-sm-4">
                                                                            <div><big class="time"> {{date("H:i",$post['fl_return_date'])}} </big></div>
                                                                            <div><small class="date">{{date("d M Y",$post['fl_return_date'])}}</small>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    @elseif($detail_transit->count() > 0)
                                                                        <div class="col-sm-4">
                                                                            <div><big class="time">{{date("H:i",$detail_transit[$i+1]['transit_departure_date'])}}</big></div>
                                                                            <div><small class="date">{{date("d M Y",$detail_transit[$i+1]['transit_departure_date'])}}</small>
                                                                        </div>
                                                                    </div>
                                                                            
                                                                    @endif
                                                                    
                                                                    <div class="col-sm-6">
                                                                        <div><span class="place">
                                                                            @if($i+1 == $detail_transit->count())
                                                                                    {{$name_city_airport_to[0]['city_name']}} ({{$name_city_airport_to[0]['city_code']}})
                                                                            @elseif($detail_transit->count() > 0)
                                                                                {{$detail_transit[$i+1]['city_name']}} ({{$detail_transit[$i+1]['city_code']}})
                                                                            @endif
                                                                    </span></div>
                                                                        <div><small class="airport">
                                                                            @if($i+1 == $detail_transit->count())
                                                                                {{$name_city_airport_to[0]['airport_name']}}
                                                                            
                                                                            @elseif($detail_transit->count() > 0)
                                                                                {{$detail_transit[$i+1]['airport_name']}}
                                                                            @endif</small></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 text-right">
                                                                <label class="control-label">Duration:</label>
                                                                <div><strong class="time">{{date("H:i",$detail_transit[$i]['transit_landing_date'] - $detail_transit[$i]['transit_departure_date'])}}</strong></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @if(($i + 1) < $detail_transit->count())
                                                    <li class="list-group-item list-group-item-warning">
                                                        <ul>
                                                            <li>Transit for {{date("H:i",$detail_transit[$i+1]['transit_departure_date'] - $detail_transit[$i]['transit_landing_date'])}} in {{$detail_transit[$i+1]['city_name']}} ({{$detail_transit[$i+1]['city_code']}})</li>
                                                        </ul>
                                                    </li>
                                                    @else
                                                    @endif
                                                    @endfor
                                                
                                            </ul>
                                        </div>
                                        <div id="flight-price-tab" class="tab-pane fade">
                                            <h5>
                                                <strong class="airline">{{$post['airline_name']}}</strong>
                                                <p><span class="flight-class">{{$post['airline_name']}}</span></p>
                                            </h5>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="pull-left">
                                                        <strong>Passengers Fare (x3)</strong>
                                                    </div>
                                                    <div class="pull-right">
                                                        <strong>{{number_format($post['fl_cost'], 0, ',', '.').' VNĐ'}}</strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="pull-left">
                                                        <span>Tax</span>
                                                    </div>
                                                    <div class="pull-right">
                                                        <span>Included</span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item list-group-item-info">
                                                    <div class="pull-left">
                                                        <strong>You Pay</strong>
                                                    </div>
                                                    <div class="pull-right">
                                                        <strong>{{number_format($post['fl_cost'], 0, ',', '.').' VNĐ'}}</strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </section>
        </div>
    </main>
@endsection