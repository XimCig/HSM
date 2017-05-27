## xCurl - 一个基于CURL的类

>开始使用

    $xCurl = new xCurl( 'http://www.baidu.com');
    echo $xCurl->getPage();
    //直接输出网页结果

>设置CURL参数

    $xCurl = new xCurl( 'http://www.baidu.com');
    echo $xCurl
    ->config( [CURLOPT_HEADER=>0] )
    ->getPage();
    //直接输出网页结果

>设置UA

    //只需在构造函数声明设备
    $xCUrl = new xCurl( 'http://www.baidu.com' , 'android');
