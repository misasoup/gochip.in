<?php
    define('PERCH_LICENSE_KEY', 'P21212-CWG660-TVP807-YRP908-GMU012');

    define("PERCH_DB_USERNAME", 'yao51557');
    define("PERCH_DB_PASSWORD", 'junkiku0718');
    define("PERCH_DB_SERVER", "mysql311.db.sakura.ne.jp");
    define("PERCH_DB_DATABASE", "yao51557_gochipin");
    define("PERCH_DB_PREFIX", "perch2_");
    
    define('PERCH_TZ', 'Asia/Tokyo');

    define('PERCH_EMAIL_FROM', 'mantangs@gmail.com');
    define('PERCH_EMAIL_FROM_NAME', 'satoshi kikuchi');

    define('PERCH_LOGINPATH', '/perch');
    define('PERCH_PATH', str_replace(DIRECTORY_SEPARATOR.'config', '', dirname(__FILE__)));
    define('PERCH_CORE', PERCH_PATH.DIRECTORY_SEPARATOR.'core');

    define('PERCH_RESFILEPATH', PERCH_PATH . DIRECTORY_SEPARATOR . 'resources');
    define('PERCH_RESPATH', PERCH_LOGINPATH . '/resources');
    
    define('PERCH_HTML5', true);
 
?>