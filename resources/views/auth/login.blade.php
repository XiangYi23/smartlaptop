
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg, #f6d365, #fda085);
}

.login-container {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-card {
    width: 100%;
    max-width: 450px;
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    transform: translateY(-5%);
    transition: transform 0.3s;
}

.login-card:hover {
    transform: translateY(-7%);
}

.form-input {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-top: 8px;
}

.form-input:focus {
    border-color: #fda085;
    box-shadow: 0 0 10px rgba(253, 160, 133, 0.5);
}

.btn-submit {
    display: block;
    width: 100%;
    padding: 10px 20px;
    color: white;
    background: linear-gradient(120deg, #f6d365, #fda085);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-submit:hover {
    background: linear-gradient(120deg, #fda085, #f6d365);
}

.forgot-link {
    display: block;
    margin-top: 15px;
    color: #fda085;
    text-decoration: none;
    transition: 0.3s;
}

.forgot-link:hover {
    text-decoration: underline;
}

.register-prompt {
    display: flex;
    margin-top: 20px;
    color: #fda085;
    text-align: center;
    transition: 0.3s;
}

.register-prompt:hover {
    text-decoration: underline;
    color: #f6d365;
}

</style>
<div class="login-container">
    <div class="login-card">
        <h2 class="text-center mb-4">{{ __('Login') }}</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group mb-4">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-4">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <div>
                <button type="submit" class="btn-submit">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
        @if (Route::has('register'))
            <a class="register-prompt" href="{{ route('register') }}">
                Don't have an account yet? Register Now
            </a>
        @endif
    </div>
</div>
