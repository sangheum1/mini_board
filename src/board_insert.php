<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );  // define( 정의하는 변수, 변수에 들어가는 값 )
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );

    $http_method = $_SERVER["REQUEST_METHOD"];
    if( $http_method === "POST")
    {
        $arr_post = $_POST;

        $result_cnt = insert_board_info( $arr_post );

        header( "Location: board_list.php" );
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 작성</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./board_update.css">
</head>
<body>
<section class="cont1">
        <p>게시글 작성</p>
        <div class="cont2">
            <form method="post" action="board_insert.php">  <!-- input값 가져오기 위해 input에서 name은 넘겨주는 컬럼이기때문에 사용-->
            <div class="label_cont1">
                <label for="title">제목</label>
                <input type="text" name="board_title" class="board_title" id="title">
            </div>
            <label for="contents" class="bd_con">내용</label>
            <input type="text" name="board_contents" class="board_contents" id="contents">
            <br>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-info">작성</button>
                <button type="button" class="btn btn-info" onclick="location.href='board_list.php'" >취소</button>
            </div>
            </form>
        </div>
    </section>
</body>
</html>