<!DOCTYPE html>
<html dir="rtl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <title>Login | ورود</title>
  </head>
  <body>
    <main>
      <section class="col col-right">
        <div class="logo">
          <img src="assets/images/logo.png">
        </div>
      </section>
      <section class="col col-left">
        <div class="errors"></div>
        
        <form class="login">
          <h1 class="title-head">ورود</h1>
          <br>
          <!-- <div>
            <input type="text" name="name" placeholder="نام کاربری">
          </div> -->
          <div class="container-input">
            <label class="fa fa-envelope"></label>
            <input type="email" name="email" placeholder="ایمیل">
          </div>
          <div class="container-input">
            <label class="fa fa-key"></label>
            <input type="password" name="password" placeholder="رمز ورود">
          </div>
          <div>
            <input type="checkbox" name="remember">
            <lable>مرا بخاطر بسپار</lable>
          </div>
          <br>
          <button>ورود</button>
          <div style="text-align: center;">
            <span>ثبت نام نکردین؟</span>
            <a href="signin">برای عضویت کلیک کنید</a>
          </div>
        </form>
      </section>
    </main>
    <script src="/assets/js/login.js"></script>
  </body>
</html>