@extends('layouts.app')

@section('content')
<main>

    <div class="container">
        <h2>Booking</h2>
        <div class="row">
            @foreach($detail_data as $post)
            <div class="col-md-8">
                <form role="form" action="{{route('booking')}}" method="post">
                    <section>     
                        <h3>Contact Information</h3>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label">
                                            First Name:
                                        </label>
                                        @if(Session::has('login') && Session::get('login') == true)
                                        <input type="text" class="form-control" value="{{ Session::get('firstname')}}">
                                        @else
                                         <input type="text" class="form-control" >
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">
                                            Last Name:
                                        </label>
                                        @if(Session::has('login') && Session::get('login') == true)
                                        <input type="text" class="form-control" value="{{ Session::get('lastname')}}">
                                        @else
                                         <input type="text" class="form-control" >
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label">
                                            Contact's Mobile phone number
                                        </label>
                                        @if(Session::has('login') && Session::get('login') == true)
                                        <input type="text" class="form-control" value="{{ Session::get('phonenumber')}}">
                                        @else
                                         <input type="text" class="form-control" >
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label" value="">
                                            Contact's email address
                                        </label>
                                        @if(Session::has('login') && Session::get('login') == true)
                                        <input type="text" class="form-control" value="{{ Session::get('email')}}">
                                        @else
                                         <input type="text" class="form-control" >
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right">
                                  <button type="button" class="btn btn-default">Clear all</button>
                                  <button type="button" class="btn btn-default">Reset</button>
                              </div>
                          </div>
                      </div>
                  </section>
                  <section>
                    <h3>Passenger(s) Details</h3>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4>Passenger #1</h4>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="control-label">Title:</label>
                                    <select class="form-control">
                                        <option value="mr">Mr.</option>
                                        <option value="mrs">Mrs.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="control-label">First Name:</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Last Name:</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>

                    <h3>Price Details</h3>
                    <div>
                        <h5>
                            <strong class="airline">Qatar Airways</strong>
                            <p><span class="flight-class">Economy</span></p>
                        </h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="pull-left">
                                    <strong>Passengers Fare (x3)</strong>
                                </div>
                                <div class="pull-right">
                                    <strong>IDR24.796.650,00</strong>
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
                                    <strong>IDR24.796.650,00</strong>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        </ul>
                    </div>
                </section>
                <section>
                    <h3>Payment</h3>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label">
                                    Payment Method:
                                </label>
                                <select class="form-control">
                                    <option value="transfer">Transfer</option>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="paypal">Paypal</option>
                                </select>
                            </div>
                            <h4>Credit Card</h4>
                            <div class="form-group">
                                <label class="control-label">Card Number</label>
                                <input type="number" class="form-control" placeholder="Digit card number">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <label class="control-label">Name on card:</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <label class="control-label">CCV Code:</label>
                                    <input type="number" maxlength="3" class="form-control" placeholder="Digit CCV">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            Continue to Booking
                        </button>
                    </div>
                </section>
            </form>
        </div>
        <div class="col-md-4">
            <h3>Flights</h3>
            <aside>
                <article>
                    <div>
                        <ul class="list-group">
                            @for($i = -1 ; $i < $detail_transit->count(); $i++)
                            <li class="list-group-item">
                                <h5>
                                    <strong class="airline">{{$post['airline_name']}}</strong>
                                    <p><span class="flight-class">{{$post['fc_name']}}</span></p>
                                </h5>
                                <div class="row">
                                    <div class="col-sm-12">
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
                                                <div><span class="place">@if($i == -1)
                                                    {{$name_city_airport_from[0]['city_name']}} ({{$name_city_airport_from[0]['city_code']}})
                                                    @else
                                                    {{$detail_transit[$i]['city_name']}} ({{$detail_transit[$i]['city_code']}})
                                                @endif</span></div>
                                                <div><small class="airport">@if($i == -1)
                                                    {{$name_city_airport_from[0]['airport_name']}}
                                                    @else
                                                    {{$detail_transit[$i]['airport_name']}}
                                                @endif</small></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <i class="glyphicon glyphicon-arrow-down"></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            @if($i == $detail_transit->count()-1 )
                                            <div class="col-sm-4">
                                                <div><big class="time"> {{date("H:i",$post['fl_return_date'])}} </big></div>
                                                <div><small class="date">{{date("d M Y",$post['fl_return_date'])}}</small>
                                                </div>
                                            </div>

                                            @else
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
                                                   @else
                                                   {{$detail_transit[$i+1]['city_name']}} ({{$detail_transit[$i+1]['city_code']}})
                                                   @endif
                                               </span></div>
                                               <div><small class="airport">@if($i+1 == $detail_transit->count())
                                                   {{$name_city_airport_to[0]['airport_name']}}
                                                   @else
                                                   {{$detail_transit[$i+1]['airport_name']}}
                                                   @endif</small></div>
                                           </div>
                                       </div>
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
            </article>
        </aside>
    </div>
    @endforeach
</div>
</div>
<br>
</main>
@endsection