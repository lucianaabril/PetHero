<html>
    <head>
        <title>Menu</title>
        <style><?php include(VIEWS_PATH . "/layout/styles/nav-bar.css")?></style>
    </head>
    <body>
        <span class="nav-bar">
        <nav class="nav">
                <ul class="nav__links">
                    <li class="listitem"><a class="links" href="<?php echo FRONT_ROOT."Home/showHomeView" ?>">Home</a></li>
                    <li class="listitem"><a class="links" href="">About our service</a></li>
                    <li class="listitem"><a class="links" href="">Contact</a></li>
                </ul>
            <a class="item" href="<?php echo FRONT_ROOT."User/ShowLoginView" ?>">Login</a>
            <a class="item" href="<?php echo FRONT_ROOT."User/ShowSignupView" ?>">Signup</a>
        </nav>
</span>
        
           
    </body>
</html>