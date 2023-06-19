<?php
require_once '../tool/db_conn.php';
// require_once '../tool/chack_er.php';

$target=$_GET['target'];
$keyword="%" . $_GET['keyword'] . "%";
$keywordget=$_GET['keyword'];


if(isset($_GET["sort"])&&$_GET["sort"]!=NULL){
    if($_GET["sort"]==="writer"||$_GET["sort"]==="title"||$_GET["sort"]==="regdate"||$_GET["sort"]==="updatedate"){
        $sortget=$_GET['sort'];
    }
}else{
    $sortget="board_id";
}

if(isset($_GET["ud"])&&$_GET["ud"]!=NULL){
    if($_GET["ud"]==="DESC"||$_GET["ud"]==="ASC"){
        $udget=$_GET['ud'];
    }
}else{
    $udget="DESC";
}

if(isset($_GET["day1"])&&isset($_GET["day2"])&&$_GET["day1"]!=NULL&&$_GET["day2"]!=NULL){
    $day1=$_GET['day1'];
    $day2=$_GET['day2'];    
    

    if ($_GET["target"]==="writer"||$_GET["target"]==="content"||$_GET["target"]==="title"||$_GET["target"]==="all"){
        if($sortget==="updatedate"){
            $day12="AND updatedate BETWEEN ? AND ?";
        }else{
            $day12="AND regdate BETWEEN ? AND ?";
        }
    }else{
        if($sortget==="updatedate"){
            $day12="WHERE updatedate BETWEEN ? AND ?";
        }else{
            $day12="WHERE regdate BETWEEN ? AND ?";
        }
    }

}else{
    $day12=NULL;
}

if(isset($_GET["page"])&&$_GET["page"]!=NULL){
    $page=$_GET['page'];
    $read=($page - 1) * 10;
}else{
    $read=0;
}

if(isset($_GET["target"])&&isset($_GET["keyword"])){
    if($_GET["target"]==="all"){
        $list_board_1_query = "SELECT * FROM board_" . $board_num . " WHERE (title LIKE ? OR writer LIKE ? OR content LIKE ?) " . (string)$day12 . " ORDER BY " . $sortget . " " . $udget . " LIMIT 10 OFFSET ?";
        $stmt = $con -> prepare($list_board_1_query);
        $stmt -> bind_param('sssi', $keyword, $keyword, $keyword, $read);               
    }elseif($_GET["target"]==="title"){
        $list_board_1_query = "SELECT * FROM board_" . $board_num . " WHERE title LIKE ? " . (string)$day12 . " ORDER BY " . $sortget . " " . $udget . " LIMIT 10 OFFSET ?";
        $stmt = $con -> prepare($list_board_1_query);
        $stmt -> bind_param('si', $keyword, $read);     
    }elseif($_GET["target"]==="content"){
        $list_board_1_query = "SELECT * FROM board_" . $board_num . " WHERE writer LIKE ? " . (string)$day12 . " ORDER BY " . $sortget . " " . $udget . " LIMIT 10 OFFSET ?";
        $stmt = $con -> prepare($list_board_1_query);
        $stmt -> bind_param('si', $keyword, $read); 
    }elseif($_GET["target"]==="writer"){
        $list_board_1_query = "SELECT * FROM board_" . $board_num . " WHERE content LIKE ? " . (string)$day12 . " ORDER BY " . $sortget . " " . $udget . " LIMIT 10 OFFSET ?";
        $stmt = $con -> prepare($list_board_1_query);
        $stmt -> bind_param('si', $keyword, $read); 
    }
}else {
    $list_board_1_query = "SELECT * FROM board_" . $board_num . " " . (string)$day12 . " ORDER BY " . $sortget . " " . $udget . " LIMIT 10 OFFSET ?"; 
    $stmt = $con -> prepare($list_board_1_query);

    if(isset($_GET["day1"])&&isset($_GET["day2"])&&$_GET["day1"]!=NULL&&$_GET["day2"]!=NULL){
        $stmt -> bind_param('ssi', $day1, $day2, $read); 
    }else{
        $stmt -> bind_param('i', $read); 
    }
}

$stmt->execute();
$board1_result = $stmt -> get_result();
?>


<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>IQ Spoofing</title>
    <link rel="stylesheet" href="../CSS/board1.css">
    
</head>
<body>
    <h1><a href="../index.php">IQ Spoofing</a></h1>
    <h2><?php echo $board_name; ?></h2>
    <div id = "search">
        <form method="GET" action="./board.php">
            <select id="target" name="target">
                <option value ="all">전체</option>
                <option value ="title">제목</option>
                <option value ="content">내용</option>
                <option value ="writer">작성자</option>
            </select>
            <input type="text" id="keyword" name="keyword">
            <input type="submit" value="검색" id="search_btn">
            <div id="fold">
                <details>
                    <summary>세부검색 및 정렬변경</summary>                    
                    <select id="sort" name="sort">
                        <option value ="regdate">작성일</option>
                        <option value ="updatedate">수정일</option>
                        <option value ="writer">작성자</option>
                        <option value ="title">제목</option>                        
                    </select>
                    <select id="ud" name="ud">
                        <option value ="DESC">내림차순</option>
                        <option value ="ASC">오름차순</option>
                    </select>            
                    <input type="date" id="day1" name="day1">
                    <input type="date" id="day2" name="day2">
                    <input type="submit" value="검색" id="search_btn">                    
                </details>
                </div>
        </form>
    </div>
    

    <div class="write-box">
        <a href="../board<?php echo $board_num; ?>/write.php" class="write-link">글쓰기</a>
    </div>    <br>
    
 
    <table>
        <thead>
            <tr>
                <th id = "board_id">id</th>
                <th id = "title">제목</th>
                <th id = "writer">작성자</th>
                <th id = "regdate">작성날짜</th>
                <th id = "updatedate">수정날짜</th>
                <th id = "views">조회수</th>
                <th id = "views">추천수</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($list_board_1 = $board1_result -> fetch_assoc()) {
                    $board_id = htmlspecialchars($list_board_1['board_id']);
                    $writer = htmlspecialchars($list_board_1['writer']);
                    $title = htmlspecialchars($list_board_1['title']);
                    $regdate = htmlspecialchars($list_board_1['regdate']);
                    $updatedate = htmlspecialchars($list_board_1['updatedate']);
                    $views = htmlspecialchars($list_board_1['views']);
                    $likes = htmlspecialchars($list_board_1['likes']);?>

                    

                

                    <tr onclick="location.href='./content.php/?id=<?php echo ($board_id) ?>';">
                        <td><?php echo ($board_id);?></td>
                        <td><?php echo ($title);?></td>
                        <td><?php echo ($writer);?></td>
                        <td><?php echo ($regdate);?></td>
                        <td><?php echo ($updatedate);?></td>
                        <td id="views2"><?php echo ($views);?></td>
                        <td id="views2"><?php echo ($likes);?></td>
                    </tr> 
                <?php } ?>
        </tbody>
    </table>
    <div id="page">
    <?php
    if(isset($_GET["target"])&&isset($_GET["keyword"])){
        if($_GET["target"]==="all"){
            $total_records_query = "SELECT COUNT(*) AS total FROM board_" . $board_num . " WHERE title LIKE ? OR writer LIKE ? OR content LIKE ?";            
            $stmt = $con -> prepare($total_records_query);
            $stmt -> bind_param('sss', $keyword, $keyword, $keyword); 
        }elseif($_GET["target"]==="title"){
            $total_records_query = "SELECT COUNT(*) AS total FROM board_" . $board_num . " WHERE title LIKE ?";
            $stmt = $con -> prepare($total_records_query);
            $stmt -> bind_param('s', $keyword); 
        }elseif($_GET["target"]==="content"){
            $total_records_query = "SELECT COUNT(*) AS total FROM board_" . $board_num . "  WHERE writer LIKE ?";
            $stmt = $con -> prepare($total_records_query);
            $stmt -> bind_param('s', $keyword); 
        }elseif($_GET["target"]==="writer"){
            $total_records_query = "SELECT COUNT(*) AS total FROM board_" . $board_num . " WHERE content LIKE '?";
            $stmt = $con -> prepare($total_records_query);
            $stmt -> bind_param('s', $keyword); 
        }
    }else {
        $total_records_query = "SELECT COUNT(*) AS total FROM board_" . $board_num;
        $stmt = $con -> prepare($total_records_query);        
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total_records = $row['total'];
    $total_pages= ceil($total_records / 10); 


    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    if(isset($_GET['keyword']) && isset($_GET['target'])){
        $page_adress="./board.php?target=".$target."&keyword=".$keywordget."&page=";
    } else{
        $page_adress="./board.php?page=";
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
