<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );  // define( 정의하는 변수, 변수에 들어가는 값 )
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );

    $arr_get = $_GET;

    $result_cnt = delete_board_info_no( $arr_get["board_no"] );

    header( "Location: board_list.php" );
    exit();
?>