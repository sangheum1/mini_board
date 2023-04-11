<?php

function db_conn(&$param_conn)
{
    $host = "localhost";
    $user = "root";
    $pass = "root506";
    $charset = "utf8mb4";
    $db_name = "boarder";
    $dns = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
    $pdo_option=
    array(
        PDO::ATTR_EMULATE_PREPARES => false
        , PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
        , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    try
    {
        $param_conn = new PDO( $dns, $user, $pass, $pdo_option );
    }
    catch( exception $e )
    {
        $param_conn = null;
        throw new exception( $e->getMessage() );
    }
}

function select_board_info_paging( &$param_arr ) // 1page ,2page등을 만드는것
{
    $sql =
    " SELECT "
    ." board_no "
    ." , board_title "
    ." , board_write_date "
    ." from board_info "
    ." where "
    ." board_del_flg = '0' "  // 삭제가 된 게시판은 출력하면 안되기 때문에 조건 적음
    ." order by "
    ." board_no desc " // 내림차순 정렬
    ." limit :limit_num offset :offset "
    ;

    $arr_prepare =
        array(
            ":limit_num"    => $param_arr["limit_num"]
            , ":offset"       => $param_arr["offset"]
        );

    $conn = null;
    try
    {
        db_conn( $conn );
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result = $stmt->fetchAll(); // 연상배열의 값들은 string임
    }
    catch( exception $e )
    {
        return $e->getMessage();
    }
    finally // 에러가 나면 catch 작동후 finally 작동함 (return $result는 작동안함)
    {
        $conn = null;
    }

    return $result;
}

function select_board_info_cnt()
{
    $sql =
        " select "
        ." count(*) cnt "
        ." from "
        ." board_info "
        ." where "
        ." board_del_flg = '0' "
        ;
    $arr_prepare = array();

    $conn = null;
    try
    {
        db_conn( $conn );
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result = $stmt->fetchAll();
    }
    catch( exception $e )
    {
        return $e->getMessage();
    }
    finally // 에러가 나면 catch 작동후 finally 작동함 (return $result는 작동안함)
    {
        $conn = null;
    }

    return $result;
}

function select_board_info_no( &$param_no )               // 게시판 특정 게시글 레코드 검색
{
    $sql = 
        " SELECT "
        ." board_no "
        ." , board_title "
        ." , board_contents "
        ." FROM "
        ." board_info "
        ." where "
        ." board_no = :board_no "
        ;
    
    $arr_prepare =
        array(
            ":board_no" => $param_no
        );

        $conn = null;
        try
        {
            db_conn( $conn );
            $stmt = $conn->prepare( $sql );
            $stmt->execute( $arr_prepare );
            $result = $stmt->fetchAll();
        }
        catch( exception $e )
        {
            return $e->getMessage();
        }
        finally // 에러가 나면 catch 작동후 finally 작동함 (return $result는 작동안함)
        {
            $conn = null;
        }
    
        return $result[0]; //2차원 배열이라 1차원 배열 하나만 받기 위해 키값까지 하나 적음
}

function update_board_info_no( &$param_arr )  // 게시판 특정 게시글 정보 수정(post로 받은값이 board_no,title,name 여러개라서 array로 받기)
{
    $sql =
        " UPDATE "
        ." board_info "
        ." set "
        ." board_title = :board_title "
        ." , board_contents = :board_contents "
        ." where "
        ." board_no = :board_no "
        ;
    $arr_prepare =
        array(
            ":board_title" => $param_arr["board_title"]
            , ":board_contents" => $param_arr["board_contents"]
            , ":board_no" => $param_arr["board_no"]
        );

    $conn = null;
    try
    {
        db_conn( $conn );
        $conn->beginTransaction(); // Transaction 시작( 커밋이나 롤백 있으면 자동 종료 )
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result_cnt = $stmt->rowCount();  // update는 update한 개수를 들고와야 하기때문에 count 쓰기
        $conn->commit(); // update를 하기때문에 저장해야함
    }
    catch( exception $e )
    {
        $conn->rollback(); // return 전에 나와야함
        return $e->getMessage();
    }
    finally // 에러가 나면 catch 작동후 finally 작동함 (return $result는 작동안함)
    {
        $conn = null;
    }

    return $result_cnt;
}

// $arr = 
//     array(
//         "board_no" => 1
//         , "board_title" => "test1"
//         , "board_contents" => "testtest1"
//     );
// echo update_board_info_no( $arr );




// todo : test start
// $arr =
//     array(
//         "limit_num" => 5
//         , "offset"  => 0
//     );
// $result = select_board_info_paging( $arr );

// print_r( $result );

// todo : test end


?>