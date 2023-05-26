<?php
if (isset($_GET['adress'])) {
    require_once 'tool/db_conn.php';
    // require_once 'tool/chack_er.php';
    $adress = $_GET['adress'];
    $adress_arr=explode(" ",$adress);
   
    $ad_count=count($adress_arr);
    
    if ($ad_count ==1) {
        $data_adress = "SELECT * FROM adress_kr WHERE DORO LIKE '%".$adress_arr[$ad_count-1]."%'";
    } elseif ($ad_count == 2) {
        $data_adress = "SELECT * FROM adress_kr WHERE DORO LIKE '%".$adress_arr[$ad_count-2]."%' AND BUILD_NO1 LIKE '%".$adress_arr[$ad_count-1]."%'";

    } else {
        echo("도로명과 도로번호만 입력해주세요.");
    }
    ini_set('memory_limit', '512M');

    
   
    $data_adress_result = mysqli_query($con, $data_adress);
    $data_adress = mysqli_fetch_array($data_adress_result);
}
?>


<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>주소검색</title>
    
</head>
<body>
    <h1>주소 검색</h1>      
    <form method="get" action="#">
        <label>도로명 주소를 입력해주세요</label>
        <br>
        <input type="text" name="adress" placeholder="예)도청로, 도청로89번길, 도청로89번길 30" required>
             <input type="submit" name value="검색">
    </form>
 
    <table>
<?php
    while($adress_visual = mysqli_fetch_array($data_adress_result)){
        $full_adress = $adress_visual['SIDO']." ".$adress_visual['SIGUNGU']." ".$adress_visual['DORO']." ".$adress_visual['BUILD_NO1']." ".$adress_visual['BUILD_NM']; ?>
        <tr>
            <td><a href="ad_in.php?full_adress=<?=$full_adress?>"><?=$full_adress?></a></td>
        </tr><?php
    }
?>

    </table>
</body>

</html>


