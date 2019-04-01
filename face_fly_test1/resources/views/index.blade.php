@extends('layouts.app')

@section('content')
<main>
        <div class="container">
            <section>
                <h3>Flight Booking</h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" action="{{route('flight-list')}}">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="form-heading">1. Flight Route</h4>
                                    <div class="form-group">
                                        <label class="control-label">From: </label>
                                        <select  class="form-control" name="flight_route" id="dosmetic_from">
                                            @foreach($flight_route as $item)
                                                <option value="{{$item['fr_id']}}">{{$item['fr_name']}}</option>
                                            @endforeach
                                        </select>                                       
                                    </div>
                                    
                                    <h4 class="form-heading">2. Flight Destination</h4>
                                    <div class="form-group">
                                        <label class="control-label">From: </label>
                                        <select class="form-control" name="city_from" id="from">
                                            <optgroup id="myOptgroup" label="Domestic Route"  >
                                                @foreach($city1 as $item)
                                                <option value="{{$item['city_id']}}">{{$item['city_name']}}</option>
                                                @endforeach
                                            </optgroup> 
                                            <optgroup id="myOptgroup" label="International Route"  >
                                                @foreach($nation1 as $item)
                                                <option value="{{$item['city_id']}}">{{$item['nation_name']}}</option>
                                                @endforeach
                                            </optgroup>                                            
                                        </select>                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">To: </label>
                                        <select class="form-control" name="city_to" id="to">
                                            <optgroup label="Domestic Route" id="op_international">
                                                @foreach($city2 as $item)
                                                <option value="{{$item['city_id']}}">{{$item['city_name']}}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="International Route"  id="op_international">
                                                @foreach($nation2 as $item)
                                                <option value="{{$item['city_id']}}">{{$item['nation_name']}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>       
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">2. Date of Flight</h4>
                                    <div class="form-group">
                                        <label class="control-label">Departure: </label>
                                        <input type="date" class="form-control" placeholder="Choose Departure Date" name="departure_date">
                                    </div>
                                    <div class="form-group">
                                        <div class="radio">
                                            <label><input type="radio" name="flight_type" checked value="1">One Way</label>
                                            <label><input type="radio" name="flight_type" value="0">Return</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Return: </label>
                                        <input name = "return_date" type="date" class="form-control" placeholder="Choose Return Date">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">3. Search Flights</h4>
                                    <div class="form-group">
                                        <label class="control-label">Total Person: </label>
                                        <select class="form-control" name = "total">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Flight Class: </label>
                                        <select class="form-control" name="flight_class">
                                            
                                            @foreach($flightclass as $item)
                                            <option value="{{$item['fc_id']}}">{{$item['fc_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Search Flights</button>
                                    </div>
                                </div>
                            </div>
                            @if($errors->has('error'))
                                    <div class="alert alert-danger">
                                        <button  type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{$errors->first('error')}}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
