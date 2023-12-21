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

<div class="login-container">
    <div class="login-card">
        <h2 class="text-center mb-4">{{ __('Register') }}</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group mb-4">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-4">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-4">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-4">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-input" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="input-group mb-4">
                <label for="is_admin">{{ __('Is Admin') }}</label>
                <input id="is_admin" type="checkbox" class="form-input" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}>
            </div>

            <div id="admin-password" style="display: none;">
                <label for="admin_password">{{ __('Admin Password') }}</label>
                <input id="admin_password" type="password" class="form-input @error('admin_password') is-invalid @enderror" name="admin_password" value="{{ old('admin_password') }}" autocomplete="off">
                @error('admin_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn-submit">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

        @if (Route::has('login'))
            <a class="login-prompt" href="{{ route('login') }}">
                Already have an account? Login Now
            </a>
        @endif

        <script>
            const is_adminCheckbox = document.getElementById('is_admin');
            const adminPasswordInput = document.getElementById('admin-password');

            is_adminCheckbox.addEventListener('change', () => {
                if (is_adminCheckbox.checked) {
                    adminPasswordInput.style.display = 'block';
                } else {
                    adminPasswordInput.style.display = 'none';
                }
            });
        </script>
    </div>
</div>
