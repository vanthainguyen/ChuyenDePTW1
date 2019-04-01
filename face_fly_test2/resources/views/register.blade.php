@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Join as a Wordskills Travel Member</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" action="{{url('/postregister')}}" method="post">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    @if($errors->has('errorlogin'))
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{$errors->first('errorlogin')}}
                                    </div>
                                    @endif
                                    <label class="control-label">Email Address:</label>
                                    <input name="email" type="email" class="form-control" placeholder="Enter your email address">
                                    @if($errors->has('email'))
                                            <p style="color:red">{{$errors->first('email')}}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password:</label>
                                    <input name="password" type="password" class="form-control" placeholder="Enter your password">
                                    @if($errors->has('password'))
                                            <p style="color:red">{{$errors->first('password')}}</p>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">First Name:</label>
                                    <input  name="first_name" type="text" class="form-control" placeholder="Enter your name">
                                    @if($errors->has('name'))
                                            <p style="color:red">{{$errors->first('name')}}</p>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Last Name:</label>
                                    <input  name="last_name" type="text" class="form-control" placeholder="Enter your name">
                                    @if($errors->has('name'))
                                            <p style="color:red">{{$errors->first('name')}}</p>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Phone Number:</label>
                                    <input name="phone" type="tel" class="form-control" placeholder="Enter your phone number">
                                    @if($errors->has('phone'))
                                            <p style="color:red">{{$errors->first('phone')}}</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                     
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection()