
<!DOCTYPE html>
<html lang="kr">
<head>
  
</head>
<body>
    <?php
    $full_adress = $_GET['full_adress'];
    ?>
    <script>
    window.onload = function(){
        var full_adress = '<?=$full_adress?>';
        opener.document.getElementById("adress").value = full_adress;
		window.close();
    };
    </script>
</body>

</html>



