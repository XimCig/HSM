<?php
namespace hsm;

//路由配置文件

reg::any("/([0-9]+).html","Index/index/id/$1/sb/nishabi");
reg::any("/","Index/index");
