@extends('layouts.app')

@section('title', 'Login Page')

@section('content')
    <section class="section section-variant-1 bg-gray-100">
    <div class="container">
        <div class="row row-50 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-6">
            <div class="card-login-register" id="card-l-r">
            <div class="card-top-panel">
                <div class="card-top-panel-left">
                <h5 class="card-title card-title-login">Login</h5>
                <h5 class="card-title card-title-register">Register</h5>
                </div>
                <div class="card-top-panel-right"><span class="card-subtitle"><span class="card-subtitle-login">Register now</span><span class="card-subtitle-register">Sign in</span></span>
                <button class="card-toggle" data-custom-toggle="#card-l-r"><span class="card-toggle-circle"></span></button>
                </div>
            </div>
            <div class="card-form card-form-login">
                <form class="rd-form rd-mailform" novalidate="novalidate">
                <button class="button button-lg button-primary button-block" type="submit" onclick="line_login()">
                    <img src="./images/icons8-line.svg" alt="" style="width: 30px;margin-right: 20px;">
                    使用line登入
                </button>
                </form>
            </div>
            <div class="card-form card-form-register">
                <form class="rd-form rd-mailform" novalidate="novalidate">
                <div class="form-wrap">
                    <label class="form-label rd-input-label" for="form-register-email">Birthday(生日) : </label>
                    <input class="form-input form-control-has-validation form-control-last-child" id="form-register-email" type="date"  name="birthday"  data-constraints="@Required" style="padding-left: 131px !important;">
                </div>
                <div class="form-wrap">
                    <label class="form-label rd-input-label" for="form-login-name-2">Sex(性別) : </label>
                    <!-- <input class="form-input form-control-has-validation form-control-last-child" id="form-login-name-2" type="text" name="form-input" data-constraints="@Required"><span class="form-validation"></span> -->
                    <select class="form-select form-input" aria-label="Default select example" id="form-login-name-3" name="Gender"  data-constraints="@Required" style="padding-left: 71px;">
                    <option selected></option>
                    <option value="M">男生(Boy)</option>
                    <option value="W">女生(Girl)</option>
                    </select>
                </div>
                <div class="form-wrap">
                    <label class="form-label rd-input-label" for="form-login-name-2">position 1 (位置 1) : </label>
                    <!-- <input class="form-input form-control-has-validation form-control-last-child" id="form-login-name-2" type="text" name="form-input" data-constraints="@Required"><span class="form-validation"></span> -->
                    <select class="form-select form-input" aria-label="Default select example" id="form-login-name-2" name="position1"  data-constraints="@Required" style="padding-left: 131px;">
                    <option selected></option>
                    <option value="GK">GK(守門員)</option>
                    <option value="DF">DF(後衛)</option>
                    <option value="MF">MF(中場)</option>
                    <option value="FW">FW(前鋒)</option>
                    <option value="libero">libero(自由人)</option>

                    </select>
                </div>
                <div class="form-wrap">
                    <label class="form-label rd-input-label" for="form-login-name-2">position 2 (位置 2) : </label>

                    <select class="form-select form-input" aria-label="Default select example" id="form-login-name-1" name="position2"  data-constraints="@Required" style="padding-left: 131px;">
                    <option selected></option>
                    <option value="GK">GK(守門員)</option>
                    <option value="DF">DF(後衛)</option>
                    <option value="MF">MF(中場)</option>
                    <option value="FW">FW(前鋒)</option>
                    <option value="libero">libero(自由人)</option>

                    </select>
                </div>
                <div class="form-wrap">
                </div>
                <div class="form-wrap">

                    <a style="width: 100%;" class="button button-google button-icon button-icon-left button-round button-lg" href="#" onclick="line_register()">
                    <img src="./images/icons8-line-red.svg" alt="" style="width: 30px;margin-right: 20px;">
                    <span>使用line註冊</span></a>
                </div>                  </form>
                <!-- <div class="group-sm group-sm-justify group-middle"><a class="button button-google button-icon button-icon-left button-round" href="#"><span class="icon fa fa-google-plus"></span><span>Google+</span></a><a class="button button-twitter button-icon button-icon-left button-round" href="#"><span class="icon fa fa-twitter"></span><span>Twitter</span></a><a class="button button-facebook button-icon button-icon-left button-round" href="#"><span class="icon fa fa-facebook"></span><span>Facebook</span></a></div> -->
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>


@endsection