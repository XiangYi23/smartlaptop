
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg, #f6d365, #fda085);
}

.reset-container {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.reset-card {
    width: 100%;
    max-width: 450px;
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    transform: translateY(-5%);
    transition: transform 0.3s;
}

.reset-card:hover {
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

.login-prompt {
    display: block;
    margin-top: 20px;
    color: #fda085;
    text-align: center;
    transition: 0.3s;
}

.login-prompt:hover {
    text-decoration: underline;
    color: #f6d365;
}
</style>

<div class="reset-container">
    <div class="reset-card">
        <h2 class="text-center mb-4">{{ __('Reset Password') }}</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
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

            <div>
                <button type="submit" class="btn-submit">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>

            @if (Route::has('login'))
            <a class="login-prompt" href="{{ route('login') }}">
                Back to Sign in
            </a>
            @endif
        </form>
    </div>
</div>
