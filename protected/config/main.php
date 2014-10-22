<?php

$dbConfig = json_decode(file_get_contents(dirname(__FILE__).'/db.json'), true);
$pre_config = require(dirname(__FILE__).'/local.php');

// Location where user images are stored
Yii::setPathOfAlias('imageUploadPath', realpath(dirname(__FILE__). '/../../images/uploads'));
Yii::setPathOfAlias('imageUploadURL', '/images/uploads/');

return CMap::mergeArray(array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Image Wrapper',

    'preload'=>array('log'),

    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.behaviors.*',
        'application.vendors.*',
        'application.helpers.*',
    ),

    'components'=>array(
        'db'=>array(
            'class'=>'system.db.CDbConnection',
            'connectionString'=>"pgsql:dbname={$dbConfig['database']};host={$dbConfig['host']}",
            'username'=>$dbConfig['user'],
            'password'=>$dbConfig['password'],
            'charset'=>'utf8',
            'persistent'=>true,
            'enableParamLogging'=>true,
            'schemaCachingDuration'=>30
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache'
        ),
        'session' => array(
            'class' => 'system.web.CDbHttpSession',
            'connectionID' => 'db',
            'timeout' => 3600,
        ),
        'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                //'search/<search:.+>'=>'site/index',
                //'search'=>'site/index',
                //'download/<search:.+>'=>'site/index',
                //'download'=>'site/index',
                //'.*'=>'site/index',
            ),
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning, info, debug',
                ),
                //array(
                //    'class'=>'CWebLogRoute',
                //),
            ),
        ),
        'messages'=>array(
            'class'=>'CPhpMessageSource',
        ),
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'class'=>'WebUser',
        ),
        'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            # GD or ImageMagick
            'driver'=>'GD',
            # ImageMagick setup path
            #'params'=>array('directory'=>'/opt/local/bin'),
        ),


    ),

    'params' => array(
        // date formats
        'js_date_format' => 'dd-mm-yy',
        'db_date_format' => "%Y-%m-%d",
        'display_date_format' => "%d-%m-%Y",
        'display_short_date_format' => "%d-%m",
        'language' => 'en' ,
        'languages' => array('en' , 'zh_tw'),
   ),
), $pre_config);

