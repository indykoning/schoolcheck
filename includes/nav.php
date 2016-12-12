<nav>
    <ul>
        <li><a href="./">home</a></li>
        <li><a href="Admin">Admin</a></li>
        <li><a href="?logout=logout">Uitloggen</a></li>
    </ul>
</nav>
<style>
    body{
        margin-top: 70px;
    }
    nav{
        text-align: center;
        position: fixed;
        height: 60px;
        background-color: cornflowerblue;
        left: 0;
        top: 0;
    }
    nav, nav ul{
        width: 100%;
    }
    nav ul li a{
        text-decoration: none;
        color: white;
        height: 100%;
        background-color: black;
        padding: 25px 10px;
    }
    nav ul li a:hover{
        /*background: rgba(0,0,0,0.7);*/
        opacity: 0.7;
    }
    nav ul li{
        display: inline;
    }
</style>