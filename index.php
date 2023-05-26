<?php
// 세션시작 확인
require_once 'tool/session_open.php';

?>



<!DOCTYPE html>
<html>
    <head>
        <title> IQ Spoofing </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="font_fi.css">
        <link rel="stylesheet" href="CSS/index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1><a href='/nk/index.php'>IQ Spoofing</a></h1>
        <div class="mainpage">               
            <div class="list">
            <nav>
                <?php
                    if( isset($_SESSION['loggedin'])) { 
                        echo '<nav>
                            <ul>
                                <li><a href="userfile.php">마이페이지</a></li>
                                <li><a href="logout.php">로그아웃</a></li>
                            </ul>
                            
                        </nav>';
                    } else if(!isset($_SESSION['loggedin'])) {
                        echo '<nav>
                            <ul>
                                <li><a href="syjdr.html">로그인</a></li>
                                <li><a href="account_jn.php">회원가입</a></li>
                            </ul>
                            
                        </nav>';
                    }
                ?>
                <nav>
                    <ul>
                        <li><a href="board1.php">게시판 1</a></li>
                        <li><a href="#">게시판 2</a></li>
                        <li><a href="#">게시판 3</a></li>
                        <li><a href="#">게시판 4</a></li>
                    </ul>
                    
                </nav>

            </div>
        </div>
    </body>
</html>