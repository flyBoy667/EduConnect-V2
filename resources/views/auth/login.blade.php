<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/Home.css">
    <title>Document</title>
</head>
<body>
<div class='home'>
    <div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
    <div class='img-container'>
        <img src="/img/logo-off.png" alt="Logo du site" class="logo-front">
    </div>
    <div class='box'>
        <div class='box-form'>
            <div class='box-login-tab'></div>
            <div class='box-login-title'>
                <div class='i i-login'></div>
                <h2>LOGIN</h2>
            </div>
            <form method="POST" action="{{route('auth.login')}}">
                @csrf
                <div class='box-login'>
                    <div class='fieldset-body'>
                        <button type="button" class='b b-form i i-more' title='Mais Informações'></button>
                        <p class='field'>
                            <label for='user'>IDENTIFIANT</label>
                            <input type='text' id='login' name='email' title='Username' value="{{ old('login') }}" }>
                            <span id='valida' class='i i-warning'></span>
                            @error('login')
                            <span>{{ $message }}</span>
                            @enderror

                        </p>
                        <p class='field'>
                            <label for='pass'>MOT DE PASSE</label>
                            <input type='password' id='password' name='password' title='Password'>
                            <span id='valida' class='i i-close'></span>
                        </p>

                        <input type='submit' id='do_login' value='SE CONNECTER' title='Get Started'>
                    </div>
                </div>
            </form>
        </div>
        <div class='box-info'>
            <p>
                <button class='b b-info i i-left' title='Back to Sign In'></button>
            <h3>Need Help?</h3></p>
            <div class='line-wh'></div>
            <button class='b-support' title='Forgot Password?'> Forgot Password?</button>
            <button class='b-support' title='Contact Support'> Contact Support</button>
            <div class='line-wh'></div>
            <button class='b-cta' title='Sign up now!'> CREATE ACCOUNT</button>
        </div>
    </div>
</div>
</body>
</html>
