USE boarder;  /*boarder db에서 실행*/

CREATE TABLE board_info (
	board_no INT primary key auto_increment
	, board_title VARCHAR(100) NOT NULL
	, board_contents VARCHAR(1000) NOT NULL
	, board_write_date DATETIME NOT NULL
	, board_del_flg CHAR(1) NOT NULL DEFAULT('0')
	, board_del_date datetime
);

DESC board_info; /* board_info 테이블의 컬럼들 조회*/

INSERT INTO board_info(
	board_title
	, board_contents
	, board_write_date
)
VALUES
(
	'제목20'
	, '내용20'
	, NOW()
);

COMMIT;