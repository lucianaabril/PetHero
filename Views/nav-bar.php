<html>
    <head>
        <title>Menu</title>
        <link rel="stylesheet" href="Views\layout\styles\nav-bar.css">
    </head>
    <body>
            <nav>
                <ul class="nav__links">
                    <li><a href="<?php echo FRONT_ROOT."Home/showHomeView" ?>">Home</a></li>
                    <li><a href="">About our service</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            <a class="item" href="<?php echo FRONT_ROOT."User/ShowLoginView" ?>">Login</a>
            <a class="item" href="<?php echo FRONT_ROOT."User/ShowSignupView" ?>">Signup</a>
            </nav>
    </body>
</html>