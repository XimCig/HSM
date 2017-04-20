
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>程序运行错误</title>
    <style type="text/css">

        ::selection { background-color: #6d4336; color: white; }
        ::-moz-selection { background-color: #6d4336; color: white; }

        body {
            background-color: #eee;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #fff;
            background-color: #4f5155;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;

        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
            width:900px;
        }

        .info {
            width:90%;
            margin: 12px 15px 12px 15px;
        }
        small{
            font-size:10px;
            float:right;
            text-align: right;
        }
    </style>
</head>
<body>
<div id="container">
    <h1>错误信息 <small>HSM 0.1</small></h1>
    <div class="info">
        <p>错误文件 : <?=$e->getFile()?> 在 <?=$e->getLine()?> 行</p>

        <p style="font-weight: bold;">错误信息 : <span style="font-size:1.01rem;"><?=$e->getMessage()?></span></p>

        <p><pre><?=($e->getTraceAsString())?></pre></p>
    </div>
</div>
</body>
</html>