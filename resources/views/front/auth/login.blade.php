<x-front-layout title="Login">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Login</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" method="post" action="{{route('login')}}">
                        @csrf

                            @if($errors->has(config('fortify.username')))
                                <div class="alert alert-danger">
                                    {{$errors->first(config('fortify.username'))}}
                                </div>
                            @endif
                            <div class="form-group input-group">
                                <label for="reg-fn">Email</label>
                                <input class="form-control" type="text" name="{{config('fortify.username')}}" id="reg-email" required>
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Password</label>
                                <input class="form-control" type="password" name="password" id="reg-pass" required>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input width-auto" name="remember" value="1" id="exampleCheck1">
                                    <label class="form-check-label">Remember me</label>
                                </div>
{{--                                @if(Route::has('password.request'))--}}
{{--                                <a class="lost-pass" href="{{route('password.request')}}">Forgot password?</a>--}}
{{--                                @endif--}}
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Login</button>
                            </div>
                            @if(Route::has('register'))
                            <p class="outer-link">Don't have an account? <a href="{{route('register')}}">Register here </a>
                                @endif
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-front-layout>
