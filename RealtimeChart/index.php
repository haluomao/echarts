<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
header("Content-Type:text/html;charset=UTF-8");

$filename="./json/1.json";
$handle = fopen($filename, "r");//读取二进制文件时，需要将第二个参数设置成'rb'

//通过filesize获得文件大小，将整个文件一下子读到一个字符串中
$contents = fread($handle, filesize ($filename));
fclose($handle);

echo  $contents."\n";
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>demo</title>
</head>
<body>
nice body
<div id="main" style="height:500px">none</div>

<script src="http://echarts.baidu.com/build/dist/echarts.js"></script>
<script type="text/javascript" src="js/jquery-1.12.4.min.js" ></script>
<script>
//路径配置
require.config({
    paths: {
        echarts: 'http://echarts.baidu.com/build/dist'
    }
});

function getDate(type){
	date=[];
	if(type==1){
    	for (var i = 1; i < 60; i++) {
            var now = new Date();
            date.push([now.getHours(),now.getMinutes(),now.getSeconds()].join(':'));
            data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
        }
	}
    
}
// 使用
require(
    [
        'echarts',
        'echarts/chart/bar', // 使用柱状图就加载bar模块，按需加载
        'echarts/chart/line'
    ],

    
    function (ec) {
        // 基于准备好的dom，初始化echarts图表
        var myChart = ec.init(document.getElementById('main')); 

        var base = +new Date();
        var step = 5* 1000;
        var date = [];
        
        var data = [10];
        
        for (var i = 1; i < 24; i++) {
            var now = new Date(base+i*step);
            date.push([now.getHours(),now.getMinutes(),now.getSeconds()].join(':'));
            data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
        }
        
        var option = {
            tooltip: {
                show: true
            },
            legend: {
                data:['销量']
            },
            xAxis : [
                {
                    type : 'category',
                    data: date
                    //data : ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            dataZoom: [{
                type: 'inside',
                start: 0,
                end: 10
            }, {
                start: 0,
                end: 10
            }],
            series : [
                {
                    "name":"销量",
                    "type":"line",                    
                    "data":data
                }
            ]
        };
        myChart.setOption(option);
        timeTicket = setInterval(function () {
        	$.ajax({
        		type:"GET",
        		url:"http://realtimecharts.com/getFile.php",
        		dataType:"json",
        		success:function(ret){
            		//alert(ret);
        			myChart.setOption({
                        series: [{ 
                            data: ret
                        }]
                    });
        		},
        		error:function(e){
            		data=[34,2,23,4,35,46,7,8,9,10];
//         			for (var i = 0; i < 100; i++) {
//                         data.shift();
//                         data.push(678);
//                     }
                    myChart.setOption({
                        series: [{ 
                            data: data
                        }]
                    });
        		}
        	});
            
        }, 2000);
        // 为echarts对象加载数据 
        //myChart.setOption(option); 
    }
);

</script>

</body>

</html>