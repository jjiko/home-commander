<div class="row">
    <div class="col col-xs-6">
        <h1>Eight Setup</h1>
    </div>
    <div class="col col-xs-6">
        <div class="row">
            <div class="col col-xs-6 pull-right" style="padding-top: 20px">
                <img class="img-responsive" src="//cdn.joejiko.com/img/vendor/eight/EightLogo.png">
            </div>
        </div>
    </div>
    <div class="col col-xs-6">
        <form data-role="auth.eight.form" action="{{ route("auth.connect.handler", ["provider" => "eight"]) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="eight_email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="eight_password">
            </div>
            <button class="btn btn-lg btn-success">Save &amp; Check credentials</button>
        </form>
    </div>
</div>