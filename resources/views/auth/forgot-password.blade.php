<x-guest-layout>
    {{-- <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card> --}}


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="images/fg-img.png" alt="IMG">
          </div>
            <form method="POST" action="{{ route('password.email') }}" class="login100-form validate-form">
                @csrf
                <span class="login100-form-title">
                    <b>KHÔI PHỤC MẬT KHẨU</b>
                </span>
                <form action="custommer.html">
                    <div class="wrap-input100 validate-input"
                        data-validate="Bạn cần nhập đúng thông tin như: ex@abc.xyz">
                        <input class="input100" id="emailInput" type="text" placeholder="Nhập email" name="email" :value="old('email')" required autofocus/>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class='bx bx-mail-send' ></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <x-button>
                            {{ __('Email Password Reset Link') }}
                        </x-button>
                    </div>

                    <div class="text-center p-t-12">
                        <a class="txt2" href="{{ route('login') }}">
                            Trở về đăng nhập
                        </a>
                    </div>
                </form>
                <div class="text-center p-t-70 txt2">
                    Phần mềm quản lý bán hàng <i class="far fa-copyright" aria-hidden="true"></i>
                    <script type="text/javascript">document.write(new Date().getFullYear());</script> <a
                        class="txt2" href="https://www.facebook.com/truongvo.vd1503/"> Code bởi Trường </a>
                </div>
            </form>
        </div>
    </div>
</div>


</x-guest-layout>
