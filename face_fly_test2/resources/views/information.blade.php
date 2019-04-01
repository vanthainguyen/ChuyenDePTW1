@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Log into your account</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" action="{{url('login')}}" method="post">
                                 {!! csrf_field() !!}
                                <div class="form-group">

                                    <label class="control-label">Email Address:</label>
                                    <input type="email"
                                       class="form-control"
                                       name="email"
                                       placeholder="Enter username"
                                       value="{{old('email')}}"
                                       >
                                        @if($errors->has('email'))
                                            <p style="color:red">{{$errors->first('email')}}</p>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password:</label>
                                    <input type="password"
                                       class="form-control"
                                       name="password"
                                       placeholder="Password"
                                       >
                                       @if($errors->has('password'))
                                            <p style="color:red">{{$errors->first('password')}}</p>
                                        @endif
                                </div>
                                <div class="text-right">
                                   
                                    <button type="submit" class="btn btn-primary">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection