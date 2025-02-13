<html> 
    <head> 
        <meta charset="utf-8"> <title>@yield('title') - Shop Laravel</title>
        <link rel="stylesheet" href="/assets/bootstrap-5.3.3-dist/css/bootstrap.min.css"> 
    </head> 
    <body> 
        <header> 
            <a href="#">註冊</a> 
            <a href="#">登入</a> 
        </header> 
        <div class="container" > 
            @yield('content')
        </div> 
        @yield("test")
        <footer> 
            <a href="#">聯絡我們</a> 
        </footer> 
    </body> 
</html> 


