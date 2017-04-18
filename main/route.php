<?php
namespace hsm;

//路由配置文件



reg::get('/index.html','Index/index');

reg::get('/([a-zA-z]+)/([a-zA-z]+).html',"$1/$2");

reg::any("/list-[1-9]+.html","fuckssss");