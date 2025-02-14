<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css file -->
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <!-- icons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>A-Store Login</title>
</head>

<body>
    <div class="contener">
        <div class="forms_contener">
            <div class="signin_signgup">
                <form method="POST" action="{{ route('login') }}" class="sign_in">
                    @csrf <!-- إضافة الحماية ضد التزوير -->
                    <h2 class="title">Sign in</h2>

                    <!-- حقل البريد الإلكتروني -->
                    <div class="input_field">
                        <i class='bx bx-user'></i>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email') <!-- عرض الأخطاء المتعلقة بالبريد الإلكتروني -->
                    <span class="invalid-feedback" style="color: red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- حقل كلمة المرور -->
                    <div class="input_field">
                        <i class='bx bx-lock'></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    @error('password') <!-- عرض الأخطاء المتعلقة بكلمة المرور -->
                    <span class="invalid-feedback" style="color: red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- تذكرني -->
                    <div class="form-check" style="margin: 10px 0;">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <input type="submit" value="Login" class="btn solid">

                </form>


                <form method="POST" action="{{ route('register') }}" class="sign_up">
                    @csrf <!-- إضافة الحماية ضد التزوير -->
                    <h2 class="title">Sign Up</h2>

                    <!-- حقل الاسم -->
                    <div class="input_field">
                        <i class='bx bx-user'></i>
                        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                    </div>
                    @error('name') <!-- عرض الأخطاء المتعلقة بالاسم -->
                    <span class="invalid-feedback" style="color: red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- حقل البريد الإلكتروني -->
                    <div class="input_field">
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" style="color: red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- حقل كلمة المرور -->
                    <div class="input_field">
                        <i class='bx bx-lock'></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" style="color: red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <!-- تأكيد كلمة المرور -->
                    <div class="input_field">
                        <i class='bx bx-lock'></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>

                    <input type="submit" value="Sign up" class="btn solid">
                </form>

            </div>
        </div>

        <div class="panels_contener">
            <div class="panel left_panel">
                <div class="content">
                    <h3>New Here?</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, asperiores similique eligendi
                    </p>
                    <button class="btn transparent" id="sign_up_btn">Sign up</button>
                </div>

            </div>
            <div class="panel right_panel">
                <div class="content">
                    <h3>One of us?</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, asperiores similique eligendi
                    </p>
                    <button class="btn transparent" id="sign_in_btn">Sign in</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/login.js') }}"></script>
</body>

</html>
