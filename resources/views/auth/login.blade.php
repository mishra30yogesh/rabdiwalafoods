@extends('layouts.app')

@section('content')

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="card card-login card-hidden">
                        <div class="card-header text-center" data-background-color="rose">
                            <h4 class="card-title">Login</h4>
                        </div>
                        <div class="card-content">
                            <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>

                                <div class="form-group label-floating">
                                    <label class="control-label">Email address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock_outline</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Let's go</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-content')
<script type="text/javascript">
    $().ready(function () {
        demo.checkFullPageBackgroundImage();

        setTimeout(function () {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>
@endsection