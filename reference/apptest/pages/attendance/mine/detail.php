<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>考勤详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		<link rel="stylesheet" type="text/css" href="../../../css/mui.min.css"/>
		<style>
			body {
				background-color: #ffffff;
				font-size: 14px;
				color:#888888;

			}

			.mui-table-view:before {
				background-color: #ffffff;
			}

			ul {
				background-color: #ffffff;
				list-style: none;
				margin: 0;
			}

			.mui-grid-view.mui-grid-9 {
				margin: 0;
				padding: 0;
			    border-top: 1px solid #ffffff;
			    border-left: 1px solid #ffffff;
			    background-color: #ffffff;
			}

			.mui-grid-view.mui-grid-9 .mui-table-view-cell {
				border-right: 1px solid #ffffff;
				border-bottom: 1px solid #ffffff;
			}

			.mui-active {
				background-color: #ffffff;!important;
			}

			.title {
				color: #1a70c7;
				font-size: 15px;
				height: 43px;
				background-color: #ffffff;
				font-weight: bold;
				box-shadow: 2px 3px #eeeeee;
				margin-top: 1%;
			}

			.title span {
				float: left;
				margin-top: 5%;
			}

			.title span:first-child {
				display: inline-block;
				height: 19px;
				width: 2px;
				background-color: #1a70c7;
				margin-left: 2%;
				margin-right: 3%;
			}

			.mui-table-view:after {
				background-color: #ffffff;
			}


			table {
				width: 100%;
				background-color: #ffffff;
			}

			table thead {
				color:#1a70c7;
			}

			table thead tr th {
				font-weight: normal;
				width: 50%;
			}

			.kq_mj tr td {
				width: 50%;
				text-align: center;
				height: 30px;
				font-size: 14px;
			}

			.cant_kq {
				width: 100%;
			}

			.cant_kq li {
				width: 100%;
				text-align: left;
				height: 50px;
				/*border:groove;*/
			}

			.cant_kq li span:last-child {
				/*float: right;*/
				margin-right: 15%;
			}
			

			.waiq_kq {
				background-color: #ffffff;
				padding-left: 11%;
			}

			.mui-table-view-cell span {
				color:#1a70c7;
				/*font-weight: bold;*/
				font-size: 14px;
			}

			#other_way {
				color:#1a70c7 ;
				/*font-weight: bold;*/
			}

			.mui-grid-view.mui-grid-9 .mui-table-view-cell {
				padding: 4px 0;
				font-size: 12px;
				/*border:1px solid purple;*/
			}

			.kaoq .mui-table-view-cell {
				width: 100%;
			}

			.mui-active {
				background-color: #ffffff!important;
			}

			.mui-card .mui-table-view .mui-table-view-cell:first-child, .mui-card .mui-table-view .mui-table-view-divider:first-child,
			.mui-card .mui-table-view .mui-table-view-cell:last-child, .mui-card .mui-table-view .mui-table-view-divider:last-child{
				border-radius: 0;
			}

			.mui-table-view-cell.mui-collapse .mui-collapse-content {
				margin: 0 -15px -11px;
			}

			.mui-table-view-cell.mui-collapse .mui-table-view {
				margin-top: 0;
			}

			.other_times thead tr th,.other_times tbody tr td {
				width: 25%;
				text-align: center;
			}

			.zhanc_kq thead tr th,.zhanc_kq tbody tr td {
				width: 25%;
				text-align: center;
				color: #1a70c7;
			}

			.mui-table-view-cell>a:not(.mui-btn) {
				margin: -11px -27px;
			}


			.mui-table-view-cell.mui-collapse .mui-collapse-content {
				padding: 8px 0;!important;
			}

            #other_way {
				width: 105%;
				margin: 0 auto;
			}


		</style>
	</head>
	<body>
		<div class="mui-content">
			<div class="title">
				<span></span><span>指纹打卡</span>
			</div>
			<table class="zhanc_kq">
				<thead>
					<tr>
						<th></th>
						<th>方式</th>
						<th>区域</th>
						<th>时间</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>早上</td>
						<td id="morningStyle"></td>
						<td id="morningArea"></td>
						<td id="morningTime"></td>
					</tr>
					<tr>
						<td>中午</td>
						<td id="nooningStyle"></td>
						<td id="nooningArea"></td>
						<td id="nooningTime"></td>
					</tr>
					<tr>
						<td>晚上</td>
						<td id="afternoonStyle"></td>
						<td id="afternoonArea"></td>
						<td id="afternoonTime"></td>
					</tr>
				</tbody>
			</table>
			<ul class="mui-table-view">
                <li class="mui-table-view-cell mui-collapse">
					<a href="javascript:void(0);" class="mui-navigate-right" id="other_way">
						其他时间
					</a>
					<div class="mui-collapse-content other_area">
						<table class="other_times">
							<thead>
							<tr>
								<th></th>
								<th>方式</th>
								<th>区域</th>
								<th>时间</th>
							</tr>
							</thead>
							<tbody id="other_times">
								
							</tbody>
						</table>
					</div>
				</li>
			</ul>
			<div class="title">
				<span></span><span>门禁卡</span>
			</div>
			<table border="0">
				<thead>
				<tr>
					<th>地点</th>
					<th>时间</th>
				</tr>
				</thead>
				<tbody class="kq_mj" id="kq_mj">
					
				</tbody>
			</table>
			<div class="title">
				<span></span><span>餐厅打卡</span>
			</div>
			<ul class="cant_kq" id="kq_ct">
			</ul>
			<div class="title">
				<span></span><span>外勤时段</span>
			</div>
			<ul class="cant_kq" id="waiq_ct">

			</ul>
			<div class="title">
				<span></span><span>签到打卡</span>
			</div>
			
			<ul class="cant_kq" id="qiand_ct">
				<!--<li class="mui-table-view-cell">打卡时间:<span>2016-11-04:9:20</span><br/>签退时间:<span>2016-10-4</span></li>-->
				
				<!--<li class="mui-table-view-cell">打卡时间:<span>2016-11-04:9:20</span><br/>签退时间:<span>2016-10-4</span></li>-->

			</ul>
			<div class="title">
				<span></span><span>可加班时段</span>
			</div>
			<ul class="cant_kq" id="kejia_ct">

			</ul>
			
			
		</div>
		<script src="../../../js/mui.min.js"></script>
		<script src="../../../js/common.js" charset="UTF-8"></script>
		<script>
			mui.init();
			(function($) {
				var policenum = <?php echo "'". $_GET["data-policenum"] . "'" ?>;
				var token = getToken();
				var date = <?php echo "'". $_GET["date"] . "'" ?>;
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'getNewGpsinfo',
						policenum:policenum,
						date:date
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType:'json',//服务器返回json格式数据
					type:'POST',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if("200"==data.code){
							//外勤打卡
							var legwork = data.result;
							var legwork_ct = document.getElementById('waiq_ct');
							if(legwork&&legwork.length){
								var html = "";
								for(var i=0;i<legwork.length;i++){
									html += '<li class="mui-table-view-cell">开始时间:<span>'+legwork[i].normalstart_time+'</span><br/>结束时间:<span>'+legwork[i].normalend_time+'</span></li>';
								}	
								legwork_ct.innerHTML = html;		
							}else{
								legwork_ct.innerHTML = '<li>暂无打卡记录</li>';
							}
						}else{
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					},
				});
				mui.ajax(basePath+'/osapi/attendance.php',{
					data:{
						action:'getAttendanceInfo',
						policenum:policenum,
						date:date
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType:'json',//服务器返回json格式数据
					type:'POST',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						if("200"==data.code){
							var fingerprint = data.result.fingerprint;
							//早上
							if(fingerprint.morningRow){
								document.getElementById('morningStyle').innerHTML = fingerprint.morningRow.status;
								document.getElementById('morningArea').innerHTML = fingerprint.morningRow.area;
								document.getElementById('morningTime').innerHTML = fingerprint.morningRow.hour; 
							}								
							//中午
							if(fingerprint.nooningRow){
								document.getElementById('nooningStyle').innerHTML = fingerprint.nooningRow.status;
								document.getElementById('nooningArea').innerHTML = fingerprint.nooningRow.area;
								document.getElementById('nooningTime').innerHTML = fingerprint.nooningRow.hour; 
							}	
							//下午
							if(fingerprint.afternoonRow){
								document.getElementById('afternoonStyle').innerHTML = fingerprint.afternoonRow.status;
								document.getElementById('afternoonArea').innerHTML = fingerprint.afternoonRow.area;
								document.getElementById('afternoonTime').innerHTML = fingerprint.afternoonRow.hour; 
							}	
							
							//其它
							var other = fingerprint.rows;
							var other_times = document.getElementById('other_times');
							var html = "";
							for(var i=0;i<other.length;i++){
								html += '<tr><td>'+other[i].status+'</td><td>'+other[i].area+'</td><td>'+other[i].hour+'</td></tr>';
							}
							other_times.innerHTML = html;
							
							
							//门禁打卡
							var doorCheckin = data.result.doorCheckin;
							var kq_mj = document.getElementById('kq_mj');
							if(doorCheckin&&doorCheckin.length){
								var html = "";
								for(var i=0;i<doorCheckin.length;i++){
									html += '<tr><td>'+doorCheckin[i].area_name+'</td><td>'+doorCheckin[i].hour+'</td></tr>';
								}	
								kq_mj.innerHTML = html;						
							}else{
								kq_mj.innerHTML = '暂无打卡记录';
							}
							//餐厅打卡
							var canteen = data.result.canteen;
							var kq_ct = document.getElementById('kq_ct');
							if(canteen&&canteen.length){
								var html = "";
								for(var i=0;i<canteen.length;i++){
									html += '<li class="mui-table-view-cell">描述:<span>'+canteen[i].check_desc+'</span><span>'+canteen[i].hour+'</span></li>';
								}	
								kq_ct.innerHTML = html;		
							}else{
								kq_ct.innerHTML = '<li>暂无打卡记录</li>';
							}
							
							
							//签到打卡
							var sign = data.result.sign;
							var sign_ct = document.getElementById('qiand_ct');
							if(sign&&sign.length){
								var html = "";
								for(var i=0;i<sign.length;i++){
									html += '<li class="mui-table-view-cell">打卡时间:<span>'+sign[i].checkintime+'</span><br/>签退时间:<span>'+sign[i].checkouttime+'</span></li>';
								}	
								sign_ct.innerHTML = html;		
							}else{
								sign_ct.innerHTML = '<li>暂无打卡记录</li>';
							}
							//可加班时段
							var overtime = data.result.overtime;
							var overtime_ct = document.getElementById('kejia_ct');
							if(overtime&&overtime.length){
								var html = "";
								for(var i=0;i<overtime.length;i++){
									html += '<li class="mui-table-view-cell">开始时间:<span>'+overtime[i].alldaystart_time+'</span><br/>结束时间:<span>'+overtime[i].alldayend_time+'</span></li>';
								}	
								overtime_ct.innerHTML = html;		
							}else{
								overtime_ct.innerHTML = '<li>暂无打卡记录</li>';
							}
						}else{
							mui.alert(data.msg, '警告信息');
						}
					},
					error:function(xhr,type,errorThrown){
						mui.alert('请求失败！请检查网络是否异常!', '警告信息');
					}
				});		
				window.javaInterface.setTitle('考勤详细'); //设置title
			})(mui);	
		</script>
	</body>
</html>