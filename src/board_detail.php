<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );  // define( 정의하는 변수, 변수에 들어가는 값 )
    define( "URL_DB", DOC_ROOT."common/db_common.php" );
    define( "URL_HEADER", DOC_ROOT."board_header.php" );
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
    <?php include_once( URL_HEADER ) ?>
    <div class="cont1">
        <p class="write_date">작성일 : <?php echo $result_info["board_write_date"] ?></p>
        <p class=detail_title>상세 페이지</p>
        <label for="bno">게시글 번호 : </label>
        <input type="text" name="board_title" class="board_title" id="bno" value="<?php echo $result_info["board_no"] ?>" readonly>
        <br>
        <label for="bno">게시글 제목 : </label>
        <input type="text" name="board_title" class="board_title" id="bno" value="<?php echo $result_info["board_title"] ?>" readonly>
        <br>
        <label for="bno" class="label_contents">게시글 내용 : </label>
        <input type="text" name="board_title" class="board_contents" id="bno" value="<?php echo $result_info["board_contents"] ?>" readonly>
    </div>
    <br>
    <div class="button_cont">
        <button type="button"><a href="board_update.php?board_no=<?php echo $result_info["board_no"] ?>">수정</a></button>
        <button type="button"><a href="board_delete.php?board_no=<?php echo $result_info["board_no"] ?>">삭제</button>
    </div>
</body>
</html>