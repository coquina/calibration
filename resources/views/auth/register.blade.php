@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('Account_number') ? ' has-error' : '' }}">
                            <label for="Account_number" class="col-md-4 control-label">Account_number</label>

                            <div class="col-md-6">
                                <input id="Account_number" type="text" class="form-control" name="Account_number" value="{{ old('Account_number') }}" required autofocus>

                                @if ($errors->has('Account_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Account_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('E_mail') ? ' has-error' : '' }}">
                            <label for="E_mail" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="E_mail" type="email" class="form-control" name="E_mail" value="{{ old('E_mail') }}" required>

                                @if ($errors->has('E_mail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('E_mail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Member_name') ? ' has-error' : '' }}">
                            <label for="Member_name" class="col-md-4 control-label">Member_name</label>

                            <div class="col-md-6">
                                <input id="Member_name" type="text" class="form-control" name="Member_name" value="{{ old('Member_name') }}" required autofocus>

                                @if ($errors->has('Member_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Member_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Job_title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Job_title</label>

                            <div class="col-md-6">
                                <input id="Job_title" type="text" class="form-control" name="Job_title" value="{{ old('Job_title') }}" required autofocus>

                                @if ($errors->has('Job_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Job_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Member_phone') ? ' has-error' : '' }}">
                            <label for="Member_phone" class="col-md-4 control-label">Member_phone</label>

                            <div class="col-md-6">
                                <input id="Member_phone" type="text" class="form-control" name="Member_phone" value="{{ old('Member_phone') }}" required autofocus>

                                @if ($errors->has('Member_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Member_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Cell_phone') ? ' has-error' : '' }}">
                            <label for="Cell_phone" class="col-md-4 control-label">Cell_phone</label>

                            <div class="col-md-6">
                                <input id="Cell_phone" type="text" class="form-control" name="Cell_phone" value="{{ old('Cell_phone') }}" required autofocus>

                                @if ($errors->has('Cell_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Cell_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Member_address') ? ' has-error' : '' }}">
                            <label for="Member_address" class="col-md-4 control-label">Member_address</label>

                            <div class="col-md-6">
                                <input id="Member_address" type="text" class="form-control" name="Member_address" value="{{ old('Member_address') }}" required autofocus>

                                @if ($errors->has('Member_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Member_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
