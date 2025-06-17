<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $mode == 'register' ? 'Registration' : 'Login' }}</title>
</head>
<body>
    <div class="form">
        <form method="POST" action="{{ $mode == 'register' ? route('register') : route('login') }}">
            <div class="sub-form">
            @csrf
            <div class="upper-form">
                <h2>{{ $mode == 'register' ? 'Sign-Up Form' : 'Sign-In Form' }}</h2>

                @if ($mode == 'register')
                    <label>Name</label><br />
                    <input type="text" name="name" value="{{ old('name') }}" required /><br />
                @endif

                <label>Email</label><br />
                <input type="email" id="regEmail" name="email" value="{{ old('email') }}" required /><br />

                <label>Password</label><br />
                <input type="password" name="password" required /><br />

                @if ($mode == 'register')
                    <label>Confirm Password</label><br />
                    <input type="password" name="password_confirmation" required /><br />
                @endif

                <div class="btn">
                    <button type="submit">{{ $mode == 'register' ? 'Sign-Up' : 'Sign-In' }}</button><br />
                </div>
            </div>

            <div class="bottom-form">
                @if ($mode == 'register')
                    <div class="account">Already have an account?</div>
                    <a href="{{ route('login') }}" class="login">Login</a>
                @else
                    <div class="account">Don't have an account?</div>
                    <a href="{{ route('register') }}" class="login">Register</a>
                @endif
            </div>
            </div>
        </form>
    </div>

    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/california.svg') }}" alt="CALIFORNIA" />
        </a>
    </div>
</body>
</html>
