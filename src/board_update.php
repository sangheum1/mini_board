<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );  // define( 정의하는 변수, 변수에 들어가는 값 )
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB ); // PHP에서 INCLUDE 할때는 절대주소로 넣기(상대주소는 넣기힘듬)

    $http_method = $_SERVER["REQUEST_METHOD"]; // Request Method를 획득 ( 적은 모든 정보들을 get, POST방식(암호화)으로 SESSION에 저장됨 )
    // get 일때
    if( $http_method === "GET" )
    {
        // get 체크
        $board_no = 1;
        if( array_key_exists( "board_no", $_GET ) )  // 해당키의 배열이 변수에 있나 없나 체크해서 있으면 쓰고 없으면 세팅 안함;
        {
            $board_no = $_GET["board_no"];
        }
        
        $result_info = select_board_info_no( $board_no );
    }
    else // post 일때
    {
        $arr_post = $_POST; // POST값이 사용자에 의해 바꿔질수도 있어서 변수 선언해서 사용(GET같은 글로벌변수들 다 )
        $arr_info =
            array(
                "board_no" => $arr_post["board_no"]
                , "board_title" => $arr_post["board_title"]
                , "board_contents" => $arr_post["board_contents"]
            );

        // update
        $result_cnt = update_board_info_no( $arr_info );

        // update한 값들을 화면에 띄우기
        $result_info = select_board_info_no( $arr_post["board_no"] );
        // print_r( $_POST );
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./board_update.css">
</head>
<body>
    <section class="cont1">
        <form method="post" action="board_update.php">  <!-- input값 가져오기 위해 input에서 name은 넘겨주는 컬럼이기때문에 사용-->
        <label for="bno">게시글 번호 : </label>
        <input type="text" name="board_no" class="board_no" id="bno" value="<?php echo $result_info['board_no'] ?>" readonly > <!--readonly는 value 값 변경x or 값에다 1적으면 안바뀜-->
        <br>
        <label for="title">게시글 제목 : </label>
        <input type="text" name="board_title" class="board_title" id="title" value="<?php echo $result_info['board_title'] ?>">
        <br>
        <label for="contents" class="board_contents_label">게시글 내용 : </label>
        <input type="text" name="board_contents" class="board_contents" id="contents" value="<?php echo $result_info['board_contents'] ?>">
        <br>
        <button type="submit">수정</button>
        <button type="button" onclick="location.href='http://localhost/mini_board/src/board_list.php?' " >돌아가기</button>
        </form>
    </section>
</body>
</html>