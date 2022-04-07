<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
        <ul class=" navbar-right">
            <li class="nav-item dropdown open" style="padding-left: 15px;">
            <a href="#" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-BiIorxpeD_vgAzBTgpx9vd6EQezMODouWZWDbv8wY55bX4z56X4RuBEdeVbrYaCyxkc&usqp=CAU" alt="">
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> Log Out</a>
            </div>
            </li>
        </ul>
        </nav>
    </div>
</div>