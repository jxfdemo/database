<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>异常分类</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="../../../css/mui.min.css" />		
		<style type="text/css">
		body {
			color:#888888;
			background-color: #fff;
		}
		
		#leader-content {
			color:#ffffff;
		}
		
		.mui-icon-left-nav {
			color: #FFF;
		}
		
		.error-circle {
			margin: 0 auto;
			width: 4rem;
			height: 4rem;
			border: 1px solid #EEE;
			border-radius: 10rem;
		}
		
		.error-circle .title {
			font-size: .7rem;
			font-weight: bold;
			margin-top: 0.8rem;
		}
		
		.error-circle .number {
			font-size: .5rem;
		}
		
		.mui-table-view:before {
			height: 0;
		}
		
		.mui-table-view:after {
			height: 0;
		}
		.own-title {
		    margin: 20px 15px 7px;
		    color: #6d6d72;
		    font-size: 15px;
		}
		
		.error-circle .number {
			font-size:.5rem;
		}
		</style>
	</head>

	<body>
		<div class="mui-content" >
			<ul class="mui-table-view mui-grid-view" id="leader-content">
				
			</ul>
		</div>
		<script src="../../../js/mui.min.js"></script>
		<script src="../../../js/common.js" charset="UTF-8"></script>
		<script type="text/javascript" charset="UTF-8">
			mui.init({
				swipeBack: true
			});
			(function($) {
				var department = <?php echo "'". $_GET["department"] . "'" ?>;
				var token = getToken(); 
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'getExceptionType',
						department:department,
						type:"other"
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType:'json',//服务器返回json格式数据
					type:'GET',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if("200"==data.code){
							var list = data.result;
							var length = list.length;
							var leader_content = document.body.querySelector('#leader-content');
							for(var i=0;i<length;i++){
								var d = list[i];
								var name = "其它";
								var count = d.total;
								var color = "red";
								if(1==d.type){
									name = "考勤";
									color = "#5a96f7";
								}else if(2==d.type){
									name = "工作记录";
									color = "#9c8abd";
								}else if(3==d.type){
									name = "排班";
									color = "#63cbf7";
								}else if(4==d.type){
									name="退办异常";
									color = "#e08254";
								}else if(5==d.type){
									name = "车驾异常";
									color = "#ee293c";
								}else if(6==d.type){
									name = "档案提取";
									color = "#fd1ad5";
								}else if(8==d.type){
									name = "事故异常";
									color = "#e2e921";
								}
								var li = document.createElement('li');
								li.className = 'mui-table-view-cell mui-media mui-col-xs-3';
								li.innerHTML = '<a href="list.php?type='+d.type+'&department='+department+'"><div class="error-circle" style="background-color: '+color+';">'+
											   '<div class="title">'+name+'</div><div class="number">共'+count+'条</div></div></a>';
								leader_content.appendChild(li);
							}
						}else{
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					}
				});
				window.javaInterface.setTitle('异常分类');  //设置title
			})(mui);
		</script>
	</body>

</html>