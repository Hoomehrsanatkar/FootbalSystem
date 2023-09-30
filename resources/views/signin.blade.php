<!DOCTYPE html>
<html dir="rtl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/signin.css">
    <title>Singin | عضویت</title>
  </head>
  <body>
    <main>
      <section class="col col-right">
        <div class="errors"></div>
        <form class="signin">
          <h1 class="title-head">ثبت نام</h1>
          <br>
          <div class="container-input">
            <label class="fa fa-user"></label>
            <input type="text" name="name" placeholder="نام کاربری">
          </div>
          <div class="container-input">
            <label class="fa fa-envelope"></label>
            <input type="email" name="email" placeholder="ایمیل">
          </div>
          <div class="container-input">
            <label class="fa fa-key"></label>
            <input type="password" name="password" placeholder="رمز ورود">
          </div>
          <div class="container-input">
            <input type="checkbox" name="law">
            <lable><a href="#">قوانین و مقررات سایت</a> را مطالعه و به آن پایبندم.</lable>
          </div>
          <br>
          <button>عضویت</button>
          <a href="login" style="text-align: center;">برای ورود کلیک کنید</a>
        </form>
      </section>
      <section class="col col-left">
        <div class="logo">
          <img src="assets/images/logo.png">
        </div>
      </section>
    </main>
    <script src="/assets/js/signin.js"></script>
  </body>
</html>