<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Register</title>
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
                    <div class="register-form">
                        <div class="title">
                            <h3>No Account? Register</h3>
                            <p>Registration takes less than a minute but gives you full control over your orders.</p>
                        </div>
                        <form class="row" method="POST" action="{{route('register')}}">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="reg-fn">UserName</label>
                                    <input class="form-control" name="name" type="text" id="reg-fn" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-email">E-mail Address</label>
                                    <input class="form-control" type="email" id="reg-email" name="email" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-phone">Phone Number</label>
                                    <input class="form-control" type="text" id="reg-phone" name="phone_number" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass">Password</label>
                                    <input class="form-control" type="password" id="reg-pass" name="password" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass-confirm">Confirm Password</label>
                                    <input class="form-control" type="password" id="reg-pass-confirm" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Register</button>
                            </div>
                            <p class="outer-link">Already have an account? <a href="{{route('login')}}">Login Now</a>
                            </p>
                        </form>
                    </div>
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

