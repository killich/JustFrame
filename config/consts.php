<?php
    # DATABASE connection params
    define("DATABASE_HOST", "localhost");
    define("DATABASE_NAME", "moodle");
    define("DATABASE_USER", "root");
    define("DATABASE_PASSWORD", "");
    
    # Каталог, в котором хранится mvc (при интеграции mvc в другой проект)
    # mvc directory for integration with another project
    define("MVC_PATH_PREFIX", '/_mvc/'); // '/_mvc/' or '/' for empty project
    
    # INDEX page routing
    define("ROOT_CONTROLLER", "users");
    define("ROOT_ACTION", "index");
    /*==============================================================*/
    define("MODEL_PATH", "./app/models/");
    define("VIEW_PATH", "./app/views/");
    define("CONTROLLER_PATH", "./app/controllers/");
    define("LAYOUT_PATH", "./app/views/layouts/");
    define("VENDORS_PATH", "./vendors/");

    define("VALIDATION_PATH", "./app/model/validators/");
    define("FILTRATION_PATH", "./app/model/filters/");

    define("LIB_PATH", "./lib/");
    define("PUBLIC_PATH", "public/");
    /*==============================================================*/
    define("EMAIL_FORMAT", "/^[\.\-\+A-Za-z0-9]+@{1,1}[\.\-\+A-Za-z0-9]+\.[A-Za-z0-9]{2,6}$/");
    define("LOGIN_FORMAT", "/^[\-A-Za-z0-9]+$/");
    // \b - граница слова; для запрета использования чистых SQL слов
    define("MYSQL_RESERVED_WORDS", "/\b(ACCESSIBLE|ADD|ALL|ALTER|ANALYZE|AND|AS|ASC|ASENSITIVE|BEFORE|BETWEEN|BIGINT|BINARY|BLOB|BOTH|BY|CALL|CASCADE|CASE|CHANGE|CHAR|CHARACTER|CHECK|COLLATE|COLUMN|CONDITION|CONSTRAINT|CONTINUE|CONVERT|CREATE|CROSS|CURRENT_DATE|CURRENT_TIME|CURRENT_TIMESTAMP|CURRENT_USER|CURSOR|DATABASE|DATABASES|DAY_HOUR|DAY_MICROSECOND|DAY_MINUTE|DAY_SECOND|DEC|DECIMAL|DECLARE|DEFAULT|DELAYED|DELETE|DESC|DESCRIBE|DETERMINISTIC|DISTINCT|DISTINCTROW|DIV|DOUBLE|DROP|DUAL|EACH|ELSE|ELSEIF|ENCLOSED|ESCAPED|EXISTS|EXIT|EXPLAIN|FALSE|FETCH|FLOAT|FLOAT4|FLOAT8|FOR|FORCE|FOREIGN|FROM|FULLTEXT|GRANT|GROUP|HAVING|HIGH_PRIORITY|HOUR_MICROSECOND|HOUR_MINUTE|HOUR_SECOND|IF|IGNORE|IN|INDEX|INFILE|INNER|INOUT|INSENSITIVE|INSERT|INT|INT1|INT2|INT3|INT4|INT8|INTEGER|INTERVAL|INTO|IS|ITERATE|JOIN|KEY|KEYS|KILL|LEADING|LEAVE|LEFT|LIKE|LIMIT|LINEAR|LINES|LOAD|LOCALTIME|LOCALTIMESTAMP|LOCK|LONG|LONGBLOB|LONGTEXT|LOOP|LOW_PRIORITY|MASTER_SSL_VERIFY_SERVER_CERT|MATCH|MEDIUMBLOB|MEDIUMINT|MEDIUMTEXT|MIDDLEINT|MINUTE_MICROSECOND|MINUTE_SECOND|MOD|MODIFIES|NATURAL|NOT|NO_WRITE_TO_BINLOG|NULL|NUMERIC|ON|OPTIMIZE|OPTION|OPTIONALLY|OR|ORDER|OUT|OUTER|OUTFILE|PRECISION|PRIMARY|PROCEDURE|PURGE|RANGE|READ|READS|READ_WRITE|REAL|REFERENCES|REGEXP|RELEASE|RENAME|REPEAT|REPLACE|REQUIRE|RESTRICT|RETURN|REVOKE|RIGHT|RLIKE|SCHEMA|SCHEMAS|SECOND_MICROSECOND|SELECT|SENSITIVE|SEPARATOR|SET|SHOW|SMALLINT|SPATIAL|SPECIFIC|SQL|SQLEXCEPTION|SQLSTATE|SQLWARNING|SQL_BIG_RESULT|SQL_CALC_FOUND_ROWS|SQL_SMALL_RESULT|SSL|STARTING|STRAIGHT_JOIN|TABLE|TERMINATED|THEN|TINYBLOB|TINYINT|TINYTEXT|TO|TRAILING|TRIGGER|TRUE|UNDO|UNION|UNIQUE|UNLOCK|UNSIGNED|UPDATE|USAGE|USE|USING|UTC_DATE|UTC_TIME|UTC_TIMESTAMP|VALUES|VARBINARY|VARCHAR|VARCHARACTER|VARYING|WHEN|WHERE|WHILE|WITH|WRITE|XOR|YEAR_MONTH|ZEROFILL)\b/i"); 
?>