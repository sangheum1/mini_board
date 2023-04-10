<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );  // define( 정의하는 변수, 변수에 들어가는 값 )
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );
    $http_method = $_SERVER["REQUEST_METHOD"];    // get방식 post 이든 배열 온것을 담아 주는것
    $arr_get = $_GET;

    // if( $http_method === "GET" )
    // {
    //     $arr_get = $_GET;
    //     $page_num = $arr_get["page_num"];
    // }
    // else
    // {
    //     $page_num = 1;
    // }

    if( array_key_exists( "page_num", $_GET ) )  // 해당키의 배열이 변수에 있나 없나 체크해서 있으면 쓰고 없으면 세팅 안함;
    {
        $page_num = $_GET["page_num"];
    }
    else
    {
        $page_num = 1;
    }

    $limit_num = 5;

    // 게시판 정보 테이블 전체 카운트
    $result_cnt = select_board_info_cnt();

    // max page 넘버
    $max_page_num = ceil( (int)$result_cnt[0]["cnt"] / $limit_num );
    
    // 1페이지 일때 0, 2페이지일때 5, 3페이지 ... (offset  계산)
    $offset = ( $page_num * $limit_num ) - $limit_num;

    $arr_prepare =
        array(
            "limit_num" => $limit_num
            , "offset"  => $offset
        );
    $result_paging = select_board_info_paging( $arr_prepare );
    

    // print_r( $max_page_num );
    // var_dump( $result_cnt );

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>게시판</title>
    <style>
    </style>
    <link rel="stylesheet" href="./board_list.css">
</head>
<body>
    <div class="cont1">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>게시글 번호</th>
                    <th>게시글 제목</th>
                    <th>작성일자</th>
                </tr>
            </thead>
            <tbody>
                <?php  // html과 php를 구분해서 적기
                    foreach( $result_paging as $recode )
                    {
                ?>
                    <tr>
                        <td><?php echo $recode["board_no"] ?></td>
                        <td><?php echo $recode["board_title"] ?></td>
                        <td><?php echo $recode["board_write_date"] ?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php
        for( $i = 1; $i <= $max_page_num; $i++ )
        {
    ?>
            <a href='board_list.php?page_num=<?php echo $i ?>'><?php echo $i ?></a>                    <!-- gap 방식으로 페이지 보냄(사용자한테 보임) <>post 방식은 사용자한테 안보이게 보냄 -->
    <?php
        }
    ?>
</body>
</html>