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