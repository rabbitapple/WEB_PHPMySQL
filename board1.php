<?php
require_once 'tool/db_conn.php';
// require_once 'tool/chack_er.php';

$target=$_GET['target'];
$keyword=$_GET['keyword'];


if(isset($_GET["page"])){
    $page=$_GET['page'];
    $read=($page - 1) * 10;
}elseif(!isset($_GET["page"])){
    $read=0;
}

if(isset($_GET["target"])&&isset($_GET["keyword"])){
    if($_GET["target"]==="all"){
        $list_board_1_query = "SELECT board_id, writer, title, regdate, updatedate FROM board_1 WHERE title LIKE ? OR writer LIKE ? OR content LIKE ? ORDER BY board_id DESC LIMIT 10 OFFSET ?";
        $stmt = $con -> prepare($list_board_1_query);
        $stmt -> bind_param('sssi', $keyword, $keyword, $keyword, $read);               
    }elseif($_GET["target"]==="title"){
        $list_board_1_query = "SELECT board_id, writer, title, regdate, updatedate FROM board_1 WHERE title LIKE ? ORDER BY board_id DESC LIMIT 10 OFFSET ?";
        $stmt = $con -> prepare($list_board_1_query);
        $stmt -> bind_param('si', $keyword, $read);     
    }elseif($_GET["target"]==="content"){
        $list_board_1_query = "SELECT board_id, writer, title, regdate, updatedate FROM board_1 WHERE writer LIKE ? ORDER BY board_id DESC LIMIT 10 OFFSET ?";
        $stmt = $con -> prepare($list_board_1_query);
        $stmt -> bind_param('si', $keyword, $read); 
    }elseif($_GET["target"]==="writer"){
        $list_board_1_query = "SELECT board_id, writer, title, regdate, updatedate FROM board_1 WHERE content LIKE ? ORDER BY board_id DESC LIMIT 10 OFFSET ?";
        $stmt = $con -> prepare($list_board_1_query);
        $stmt -> bind_param('si', $keyword, $read); 
    }
}else {
    $list_board_1_query = "SELECT board_id, writer, title, regdate, updatedate FROM board_1 ORDER BY board_id DESC LIMIT 10 OFFSET ?"; 
    $stmt = $con -> prepare($list_board_1_query);
    $stmt -> bind_param('i', $read); 
}

$stmt->execute();
$board1_result = $stmt -> get_result();
$list_board_1_all = $board1_result -> fetch_assoc();
?>


<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>IQ Spoofing</title>
    <link rel="stylesheet" href="CSS/board1.css">
    
</head>
<body>
    <h1><a href="index.php">IQ Spoofing</a></h1>
    <h2>게시판1</h2>
    <div id = search>
        <form method="GET" action="board1.php">
            <select id="target" name="target">
                <option value ="all">전체</option>
                <option value ="title">제목</option>
                <option value ="content">내용</option>
                <option value ="writer">작성자</option>
            </select>

            <input type="text" id="keyword" name="keyword">
            <input type="submit" value="검색" id="search_btn">
    </div>
    <div class="write-box">
        <a href="write_1.php" class="write-link">글쓰기</a>
    </div>    <br>
    
 
    <table>
        <thead>
            <tr>
                <th id = "board_id">id</th>
                <th id = "title">제목</th>
                <th id = "writer">작성자</th>
                <th id = "regdate">작성날짜</th>
                <th id = "updatedate">수정날짜</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($list_board_1 = $board1_result -> fetch_assoc()) {
                    $board_id = htmlspecialchars($list_board_1['board_id']);
                    $writer = htmlspecialchars($list_board_1['writer']);
                    $title = htmlspecialchars($list_board_1['title']);
                    $regdate = htmlspecialchars($list_board_1['regdate']);
                    $updatedate = htmlspecialchars($list_board_1['updatedate']);?>

                

                    <tr onclick="location.href='conent.php/?id=<?php echo ($board_id) ?>';">
                        <td><?php echo ($board_id);?></td>
                        <td><?php echo ($title);?></td>
                        <td><?php echo ($writer);?></td>
                        <td><?php echo ($regdate);?></td>
                        <td><?php echo ($updatedate);?></td>
                    </tr> 
                <?php } ?>
        </tbody>
    </table>
    <div id="page">
    <?php
    if(isset($_GET["target"])&&isset($_GET["keyword"])){
        if($_GET["target"]==="all"){
            $total_records_query = "SELECT COUNT(*) AS total FROM board_1 WHERE title LIKE ? OR writer LIKE ? OR content LIKE ?";            
            $stmt = $con -> prepare($total_records_query);
            $stmt -> bind_param('sss', $keyword, $keyword, $keyword); 
        }elseif($_GET["target"]==="title"){
            $total_records_query = "SELECT COUNT(*) AS total FROM board_1 WHERE title LIKE ?";
            $stmt = $con -> prepare($total_records_query);
            $stmt -> bind_param('s', $keyword); 
        }elseif($_GET["target"]==="content"){
            $total_records_query = "SELECT COUNT(*) AS total FROM board_1  WHERE writer LIKE ?";
            $stmt = $con -> prepare($total_records_query);
            $stmt -> bind_param('s', $keyword); 
        }elseif($_GET["target"]==="writer"){
            $total_records_query = "SELECT COUNT(*) AS total FROM board_1 WHERE content LIKE '?";
            $stmt = $con -> prepare($total_records_query);
            $stmt -> bind_param('s', $keyword); 
        }
    }else {
        $total_records_query = "SELECT COUNT(*) AS total FROM board_1";
        $stmt = $con -> prepare($total_records_query);        
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total_records = $row['total'];
    $total_pages= ceil($total_records / 10); 


    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    if(isset($_GET['keyword']) && isset($_GET['target'])){
        $page_adress="/nk/board1.php?target=".$target."&keyword=".$keyword."&page=";
    } else{
        $page_adress="/nk/board1.php?page=";
    }
    
    if($current_page >= 6){
        $page_b=$current_page-5;
    }else{
        $page_b=1;
    }
    if($current_page+6 <= $total_pages ){
        $page_a=$current_page+5;
    }else{
        $page_a=$total_pages;
    }

    if ($current_page > 1) {
        echo '<a href="' . $page_adress . ($current_page - 1) . '">이전</a>';
    }
    for ($i = $page_b; $i <= $page_a; $i++) {
        echo '<a href="' . $page_adress . $i . '">' . $i . '</a>';
    }
    if ($current_page < $total_pages) {
        echo '<a href="' . $page_adress . ($current_page + 1) . '">다음</a>';
    }
    ?>
</div>

    </div>
</body>

</html>
