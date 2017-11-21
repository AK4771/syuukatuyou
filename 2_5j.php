<?php

$dataFile ='kadai2_2f.txt';


if(isset($_POST['toukou']))
{

    $message = ($_POST['message']);

    $user = ($_POST['user']);

    $postedAt = date('Y-m-d H:i:s');



    $newData = (sizeof(file($dataFile)) + 1)."<>".$message."<>".$user."<>".$postedAt. "\n";

    $fp = fopen($dataFile,'a');
    fwrite($fp, $newData);
    fclose($fp);
}

if (isset($_POST['delete'])) {

$delete = $_POST['deleteNo'];
$delCon = file("kadai2_2f.txt");
for ($j = 0; $j < count($delCon) ; $j++){ 
$delData = explode("<>", $delCon[$j]);

if ($delData[0] == $delete) { 
array_splice($delCon, $j, 1);
file_put_contents($dataFile, implode("\n", $delCon));
}
}
}

if (isset($_POST['edit'])) {

$edit = $_POST['editNo'];
$ediCon = file("kadai2_2f.txt");
        for ($k = 0; $k < count($ediCon) ; $k++) {
            $ediData = explode("<>", $ediCon[$k]);
            if ($ediData[0] == $edit) {

                 for($h = 0; $h < count($ediData); $h++){
                    $simEdit[$h] = mb_substr(trim($ediData[$h]), 1, -1);            
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
     <meta charset="utf-8">
     <title>簡易掲示板</title>
</head>
<body>
    <h1>簡易掲示板</h1>
     <form action="" method="POST">

        message:<input type="text" name="message">
         user:<input type="text" name="user">

          <input type='hidden' name='toukou' value=''>
         <input type="submit" value="投稿"></br></br>


     </form>

     <form action="" method="POST">
     削除対象番号<input type="text" name="deleteNo">
          <input type="hidden" name="delete" value="delete" />
         <input type="submit" name="delete" value="削除">
     </form></br></br>

     <form action="" method="POST">
     編集対象番号<input type="text" name="editNo">
          <input type="hidden" name="edit" value="edit" />
         <input type="submit" name="edit" value="編集">
     </form></br></br>


<?php

     $file=file($dataFile); // ファイルの内容を配列に格納


     foreach( $file as $value ){

     $line = explode("<>",$value);

     echo $value."<br />\n"; // 改行しながら値を表示

}

?>



</body>
</html>