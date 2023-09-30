<!DOCTYPE html>
<html dir="rtl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <title>Dashboard - داشبورد</title>
  </head>
  <body>
    <header>
      <form class="search">
        <button class="fa fa-search"></button>
        <div>
          <input type="text" placeholder="جستجو" class="search-box">
        </div>
        <ul class="search-result"></ul>
      </form>
      <div class="options">
        <a class="item chat fa fa-comment">
          <span class="count">10</span>
        </a>
        <a class="item notif fa fa-bell">
          <span class="count">5</span>
        </a>
      </div>
      <div class="user">
        <div class="info">
          <h3>کاربر - {{$user->name}}</h3>
          <p>IP-{{$user_ip}}</p>
        </div>
        <div class="avatar">
          <img src="assets/images/{{$user->avatar}}" alt="avatar">
          <div class="status"></div>
        </div>
      </div>
    </header>
    <main>
      <section class="col sidebar">
        <div class="logo">
          <img src="assets/images/logo.png" alt="logo">
        </div>
        <ul class="menu">
          <li>
            <a href="#">
              <span>داشبورد</span>
              <i class="fa fa-home"></i>
            </a>
          </li>
          <li>
            <a href="#">
              <span>بخش امتیازدهی</span>
              <i class="fa fa-star"></i>
            </a>
            <ul class="dropdown">
              <li>
                <a href="#">
                  <span>درحال انجام</span>
                  <i class="fa fa-star"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <span>تاریخچه</span>
                  <i class="fa fa-star"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <span>نتایج</span>
                  <i class="fa fa-star"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <span>نتایج</span>
                  <i class="fa fa-star"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <span>نتایج</span>
                  <i class="fa fa-star"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <span>نتایج</span>
                  <i class="fa fa-star"></i>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">
              <span>پخش زنده</span>
              <i class="fa fa-television"></i>
            </a>
          </li>
          <li><a href="#">
            <span>فوتبال</span>
            <i class="fa fa-soccer-ball-o"></i>
          </a></li>
          <li><a href="#">
            <span>آخرین خبرها</span>
            <i class="fa fa-newspaper-o"></i>
          </a></li>
          <li><a href="#">
            <span>ورودبه جدول بازی‌ها</span>
            <i class="fa fa-trophy"></i>
          </a></li>
          <li><a href="#">
            <span>خرید اشتراک</span>
            <i class="fa fa-credit-card"></i>
          </a></li>
          <li><a href="?exit=exit">
            <span>خروج</span>
            <i class="fa fa-sign-out"></i>
          </a></li>
        </ul>
      </section>
      <section class="col main_content">
        <div class="row row-1">
          <h1>بازی های درحال انجام</h1>
          <br>
          <table>
            <thead>
              <tr>
                <th></th>
                <th>تاریخ شروع</th>
                <th>تاریخ پایان</th>
                <th>تاریخ اطلاعات بازی</th>
              </tr>
            </thead>
            <tbody>
                @foreach($currentGames as $game)
              <tr>
                
                <td>{{$game->id}}</td>
                <td>{{$game->start}}</td>
                <td>{{$game->end}}</td>
                <td class="info">
                  <p>{{$game->date}}</p>
                  <p>{{$game->team_1}} VS {{$game->team_2}}</p>
                  <button data-id="{{$game->id}}" data-team1="{{$game->team_1_id}}" data-team2="{{$game->team_2_id}}" class="btn vote-btn">امتیاز میدم!</button>
                </td>
              </tr>

                @endforeach
            </tbody>
          </table>
        </div>
        <div class="row row-2">
          <div class="card" style="background-color: #ff4545;">
            <div>
              <h4 class="title">رنکینگ بازیکنان در سایت</h4>
              <i class="fa fa-trophy"></i>
            </div>
            <div>
              <h2>جایگاه شما:</h2>
              <h2>{{$user->ranking}}</h2>
            </div>
          </div>
          <div class="card" style="background-color: #042e53;">
            <div>
              <h4 class="title">بازی های انجام شده</h4>
              <i class="fa fa-soccer-ball-o"></i>
            </div>
            <div>
              <h2>مشارکت ها:</h2>
              <h2>{{$user->playing_count}}</h2>
            </div>
          </div>
          <div class="card" style="background-color: #ffd400;">
            <div>
              <h4 class="title">امتیاز های دریافت شده</h4>
              <i class="fa fa-star"></i>
            </div>
            <div>
              <h2>مجموع امتیاز ها:</h2>
              <h2>{{$user->score}}</h2>
            </div>
          </div>
        </div>
        <div class="row row-3">
          <h1>بازی های امتیاز دهی شده توسط شما</h1>
          <br>
          <table>
            <thead>
              <tr>
                <th></th>
                <th>تاریخ شروع</th>
                <th>تاریخ پایان</th>
                <th>تاریخ اطلاعات بازی</th>
              </tr>
            </thead>
            <tbody>
              @foreach($playedGames as $game)
              <tr>
                <td>{{$game->id}}</td>
                <td>{{$game->start}}</td>
                <td>{{$game->end}}</td>
                <td class="info">
                  <p>{{$game->date}}</p>
                  <p>{{$game->team_1}} VS {{$game->team_2}}</p>
                  <a href="#" class="btn">مشاهده نتیجه</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="vote">
          <i class="close fa fa-close"></i>
          <div class="container">
            <h3 style="text-align:center">پیش بینی شما</h3>
            <br>
            <form class="voting">
              <div>
                <input type="number" name="team_1" value="0" required> - <input type="number" name="team_2" value="0" required>
              </div>
              <button class="btn">ارسال</button>
            </form>
          </div>
        </div>
      </section>
    </main>
    <script src="/assets/js/dashboard.js"></script>
  </body>
</html>