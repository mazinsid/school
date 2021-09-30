<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مدرسة الانشراح</title>
	<meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <link href="{{asset('css/tailwind.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .body-bg {
            background-color: #9921e8;
            background-image: linear-gradient(315deg, #9921e8 0%, #5f72be 74%);
        }
    </style>
</head>
<body dir="rtl" class="body-bg min-h-screen pt-12 md:pt-20 pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
    <header class="max-w-lg mx-auto">
        <a href="#">
            <h1 class="text-4xl font-bold text-white text-center">إنشاء حساب جديد</h1>
        </a>
    </header>

    <main class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
        <section>
            <h3 class="font-bold text-2xl">مرحبا بكم في مدرسة الانشراح</h3>
            <p class="text-gray-600 pt-2">تسجيل الدخول إلى حسابك.</p>
        </section>
        <section class="mt-10">
            <form class="flex flex-col" method="POST"
                    action="{{ route('register') }}">
                    @csrf

                    <div class="mb-6 pt-3 rounded bg-gray-200">

                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 ml-3">
                            {{ __('أسم المستخدم') }}:
                        </label>
                        <input type="hidden" name="role" value="parents">
                        <input type="hidden" name="state" value="active">
                        <input type="hidden" name="parent_id" value="0">
                        <input id="name" type="text" 
                        class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300
                         focus:border-purple-600 transition duration-500 px-3 pb-3 @error('name')  border-red-500 @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" >

                        @error('name')
                        <p class="mt-4 text-xs italic text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-6 pt-3 rounded bg-gray-200">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 ml-3">
                            {{ __('البريد اللكتروني') }}:
                        </label>

                        <input id="email" type="email"
                            class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300
                            focus:border-purple-600 transition duration-500 px-3 pb-3 @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <p class="mt-4 text-xs italic text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-6 pt-3 rounded bg-gray-200">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2 ml-3">
                            {{ __('كلمة المرور') }}:
                        </label>

                        <input id="password" type="password"
                            class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300
                            focus:border-purple-600 transition duration-500 px-3 pb-3 @error('password') border-red-500 @enderror" name="password"
                            required autocomplete="new-password">

                        @error('password')
                        <p class="mt-4 text-xs italic text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-6 pt-3 rounded bg-gray-200">
                        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2 ml-3">
                            {{ __('تأكيد كلمة المرور') }}:
                        </label>

                        <input id="password-confirm" type="password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300
                        focus:border-purple-600 transition duration-500 px-3 pb-3"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>

               
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold 
                        py-2 rounded shadow-lg hover:shadow-xl transition duration-200" type="submit">إنشاء حساب جديد</button>
                    </form>
                </section>
            </main>
        
            <div class="max-w-lg mx-auto text-center mt-12 mb-6">
                <p class="text-white">هل لديك حساب ? <a href="{{ route('login') }}"class="font-bold hover:underline">تسجيل الدخول</a>.</p>
            </div>
        
            <footer class="max-w-lg mx-auto flex justify-center text-white">
                <a href="#" class="hover:underline">أتصل بنا</a>
                <span class="mx-3">•</span>
                <a href="#" class="hover:underline">عنا</a>
            </footer>
        </body>
        </html>