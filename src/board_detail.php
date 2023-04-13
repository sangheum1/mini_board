<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );  // define( 정의하는 변수, 변수에 들어가는 값 )
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );

    // request parameter 획득(get)
    $arr_get = $_GET;

    // db에서 게시글 정보 획득
    $result_info = select_board_info_no( $arr_get["board_no"] );


?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./board_detail.css">
</head>
<body>
    <div class="cont1">
        <p>작성일 : <?php echo $result_info["board_write_date"] ?></p>
        <!-- <p>게시글 번호 : <?php echo $result_info["board_no"] ?></p> -->
        <label for="bno">게시글 번호 : </label>
        <input type="text" name="board_title" class="board_title" id="bno" value="<?php echo $result_info["board_no"] ?>" readonly>
        <br>
        <!-- <label for="bno">  작성일 : </label>
        <input type="text" name="board_title" class="board_title" id="bno" value="<?php echo $result_info["board_write_date"] ?>" readonly>
        <br> -->
        <label for="bno">게시글 제목 : </label>
        <input type="text" name="board_title" class="board_title" id="bno" value="<?php echo $result_info["board_title"] ?>" readonly>
        <br>
        <!-- <p>게시글 제목 : <?php echo $result_info["board_title"] ?></p> -->
        <label for="bno">게시글 내용 : </label>
        <input type="text" name="board_title" class="board_contents" id="bno" value="<?php echo $result_info["board_contents"] ?>" readonly>
        <!-- <p>게시글 내용 : <?php echo $result_info["board_contents"] ?></p> -->
    </div>
    <br>
    <div>
        <button type="button"><a href="board_update.php?board_no=<?php echo $result_info["board_no"] ?>">수정</a></button>
        <button type="button"><a href="board_delete.php?board_no=<?php echo $result_info["board_no"] ?>">삭제</button>
    </div>
</body>
</html>