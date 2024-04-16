<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Login</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.svg')}}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/LineIcons.3.0.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/tiny-slider.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/glightbox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
    @stack('css')

</head>

<body>
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
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/tiny-slider.js')}}"></script>
    <script src="{{asset('assets/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script>
        document.querySelector('.search-btn button').addEventListener('click', searchAndRedirect);
        function searchAndRedirect(event) {
            event.preventDefault();
            var query = document.getElementById('q').value; // Get the value from the input
            $.ajax({
                url: '{{route('front.products.search')}}', // Your Laravel route that handles the search
                type: 'GET',
                data: { q: query }, // Pass the query parameter
                success: function(response) {
                    // Redirect to the desired route on success
                    window.location.href = '{{route('front.products.search')}}?q=' + encodeURIComponent(query);
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(error);
                }
            });
        }

    </script>

    @stack('js')
</body>

</html>
