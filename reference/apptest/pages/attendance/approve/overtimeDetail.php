<!--
	作者：836110252@qq.com
	时间：2016-05-29
	描述：我的审批：加班审批详情
-->
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>加班审批详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!--标准mui.css-->
		<link rel="stylesheet" href="../../../css/mui.min.css">
		<style>
			html,
			body,
			.mui-content {
				color: #888;
				background-color: #FFF;
			}
			
			.datatom-text-left {
				text-align: left;
			}
			
			.datatom-footer {
				position: fixed;
				z-index: 10;
				right: 0;
				left: 0;
				border-bottom: 0;
				background-color: #fff;
				-webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .85);
				box-shadow: 0 0 1px rgba(0, 0, 0, .85);
				-webkit-backface-visibility: hidden;
				backface-visibility: hidden;
				bottom: 0;
				display: table;
				width: 100%;
				height: 44px;
				padding: 0;
				table-layout: fixed;
				border-top: 0;
				-webkit-touch-callout: none;
			}
			
			.datatom-item {
				text-decoration: none;
				display: table-cell;
				overflow: hidden;
				width: 1%;
				height: 44px;
				text-align: center;
				vertical-align: middle;
				white-space: nowrap;
				text-overflow: ellipsis;
				color: #007aff;
			}
			
			.mui-col-sm-2 img,
			.mui-col-sm-7 img {
				width: 50px;
				height: 50px;
				border-radius: 50%;
			}
			
			.datatom-border-bottom {
				border-bottom: 1px solid #888;
			}
			
			.datatom-img-tips {
				position: absolute;
				right: 5%;
			}
			
			.datatom-line {
				border: 1px solid #888;
				height: 1px;
				margin-left: 10px;
				margin-right: 10px;
			}
			
			.mui-row label {
				font-size: .9rem;
			}
		</style>
	</head>

	<body>
		<div class="mui-content mui-scroll-wrapper mui-fullscreen">
			<div class="mui-scroll" id="content">
				<div class="mui-loading" id="load">
					<div class="mui-spinner">
					</div>
				</div>
			</div>
			<div id="footer" class="datatom-footer mui-hidden">
				<a id="chexiao" class="datatom-item mui-hidden" href="javascript:;">
					<label class="datatom-label">撤销</label>
				</a>
				<a id="pass" class="datatom-item mui-hidden" href="javascript:;">
					<label class="datatom-label">同意</label>
				</a>
				<a id="nopass" class="datatom-item mui-hidden" href="javascript:;">
					<label class="datatom-label">否决</label>
				</a>
			</div>
		</div>
		<script src="../../../js/mui.min.js"></script>
		<script src="../../../js/common.js" charset="UTF-8"></script>
		<script>
			mui.init({
				swipeBack: false
			});

			//初始化单页的区域滚动
			mui('.mui-scroll-wrapper').scroll();

			(function($) {
				var id = <?php echo "'". $_GET["id"] . "'" ?>;
//				showWebviewToast("id>>>"+id);
				var token = getToken();
				var date = <?php echo "'". $_GET["date"] . "'" ?>;
				var policenum = <?php echo "'". $_GET["policenum"] . "'" ?>;
				var diff = <?php echo "'". $_GET["diff"] . "'" ?>;
				var json_overtime_interval = "";
				mui.ajax(basePath + '/osapi/attendance.php', {
					data: {
						action: 'getMyApplyOvertimeDetails',
						id: id
					},
					beforeSend: function(request) {
						request.setRequestHeader("U-Auth-Token", token);
					},
					dataType: 'json', //服务器返回json格式数据
					type: 'POST', //HTTP请求类型
					timeout: 10000, //超时时间设置为10秒；
					success: function(data) {
						var html = '';
						var content = document.getElementById('content');
						if(data.code == "200") {
							var item = data.result;
							if(item == [] || item == "" || item == null) {
								html += '<div class="mui-content-padded"><div class="mui-row">';
								html += '<div class="mui-text-center mui-col-sm-10 mui-col-xs-10">';
								html += '<p>暂无考勤数据，请第二天再尝试 </p></div></div></div>';
								document.getElementById("load").classList.add("mui-hidden");								
								showWebviewToast("暂无考勤数据，请第二天再尝试");
							} else {
								//					showWebviewToast("diff>>>"+diff);
								if(item.status == "0" && diff <= 3) {
									document.getElementById("footer").classList.remove("mui-hidden");
									document.getElementById('pass').classList.remove("mui-hidden");
									document.getElementById('nopass').classList.remove("mui-hidden");
								}
								var overtime_interval = {
									"start": item.overtime_interval_start,
									"end": item.overtime_interval_end
								}
								var tempArray = [overtime_interval];
								json_overtime_interval = JSON.stringify(tempArray);

								html += '<div class="mui-content-padded"><div class="mui-row">';
								html += '<div class="mui-text-center mui-col-sm-2 mui-col-xs-3">';
								html += '<img src="' + basePath + '/osapi/avantar.php?policenum=' + item.policenum + '"/></div>';
								html += '<div class="mui-col-sm-10 mui-col-xs-9">';
								html += '<p>' + item.realname + '</p><p style="margin-bottom: 0;">' + item.departmentname + '</p></div></div></div>';
								html += '<div class="mui-content-padded">';
								html += '<div class="mui-row mui-text-center">';
								html += '<div class="mui-col-sm-6 mui-col-xs-6">';
								html += '<span class="mui-btn mui-btn-mini mui-btn-success" id="workScheduling" data-key="' + item.policenum + '" data-name="' + item.realname + '" data-day="' + item.time.substring(0, 10) + '" style="font-size: 1rem;padding: 3px 6px;">查看排班</span>';
								html += '</div><div class="mui-col-sm-6 mui-col-xs-6">';
								html += '<span class="mui-btn mui-btn-mini mui-btn-yellow" id="workAttendance" data-key="' + item.policenum + '" data-name="' + item.realname + '" data-day="' + item.time.substring(0, 10) + '" style="margin-left: 10px;font-size: 1rem;padding: 3px 6px;">查看考勤</span>';
								html += '</div></div></div><div class="datatom-line"></div>';
								html += '<div class="mui-content-padded">';
								if(item.status == "1") {
									html += '<img class="datatom-img-tips" src="../../../img/passapply.png"/>';
								} else if(item.status == "2") {
									html += '<img class="datatom-img-tips" src="../../../img/nopassapply.png"/>';
								} else if(item.status == "0"){
									html += '<img class="datatom-img-tips" src="../../../img/waitapply.png"/>';
								}else if(item.status == "5"){
									html += '<img class="datatom-img-tips" src="../../../img/revocation_apply.png"/>';
								}
								html += '<div class="mui-row mui-text-center">';
								html += '<div class="mui-col-sm-3 mui-col-xs-4">';
								html += '<label>申请时间：</label></div>';
								html += '<div class="mui-col-sm-9 mui-col-xs-8">';
								html += '<p class="datatom-text-left">' + item.apply_time + '</p>';
								html += '</div></div>';
								html += '<div class="mui-row mui-text-center">';
								html += '<div class="mui-col-sm-3 mui-col-xs-4">';
								html += '<label>开始时间：</label></div>';
								html += '<div class="mui-col-sm-9 mui-col-xs-8">';
								html += '<p class="datatom-text-left">' + item.overtime_interval_start + '</p>';
								html += '</div></div>';
								html += '<div class="mui-row mui-text-center">';
								html += '<div class="mui-col-sm-3 mui-col-xs-4">';
								html += '<label>截止时间：</label></div>';
								html += '<div class="mui-col-sm-9 mui-col-xs-8">';
								html += '<p class="datatom-text-left">' + item.overtime_interval_end + '</p>';
								html += '</div></div>';
								html += '<div class="mui-row mui-text-center">';
								html += '<div class="mui-col-sm-3 mui-col-xs-4">';
								html += '<label>加班事由：</label></div>';
								html += '<div class="mui-col-sm-9 mui-col-xs-8">';
								html += '<p class="datatom-text-left">' + item.apply_content + '</p></div></div></div>';
								html += '<div class="datatom-line"></div>';
								if(item.status == "1" || item.status == "2") {
									html += '<div class="mui-content-padded">';
									html += '<div class="mui-row mui-text-center">';
									html += '<div class="mui-col-sm-3 mui-col-xs-4">';
									html += '<label>审批人员：</label>';
									html += '</div><div class="mui-col-sm-9 mui-col-xs-8">';
									html += '<p class="datatom-text-left">' + item.leader + '</p></div></div>';
									html += '<div class="mui-row mui-text-center">';
									html += '<div class="mui-col-sm-3 mui-col-xs-4">';
									html += '<label>审批时间：</label></div>';
									html += '<div class="mui-col-sm-9 mui-col-xs-8">';
									html += '<p class="datatom-text-left">' + item.audit_time + '</p></div></div>';
									html += '<div class="mui-row mui-text-center">';
									html += '<div class="mui-col-sm-3 mui-col-xs-4">';
									html += '<label>审批内容：</label></div>';
									html += '<div class="mui-col-sm-9 mui-col-xs-8">';
									var audit_content = item.audit_content;
									if(null == audit_content || "" == audit_content) {
										if(item.status == "1") {
											audit_content = "审批完成（通过）";
										} else {
											audit_content = "审批完成（不通过）";
										}
									}
									html += '<p class="datatom-text-left">' + audit_content + '</p></div></div></div>';
								}
							}

							content.innerHTML = html;
							console.info("policenum>>"+policenum+"id>>>" + id + "date>>" + date + "status>>>" + 1 + "overtime_interval>>" + json_overtime_interval);
							document.getElementById('workScheduling').addEventListener("tap", function() {
								var policenum = this.getAttribute('data-key');
								var realname = this.getAttribute('data-name');
								var date = this.getAttribute('data-day');
								window.javaInterface.workScheduling(policenum, realname, date);
							});

							document.getElementById('workAttendance').addEventListener("tap", function() {
								var policenum = this.getAttribute('data-key');
								var realname = this.getAttribute('data-name');
								var date = this.getAttribute('data-day');
								window.javaInterface.workAttendance(policenum, realname, date);
							});

						} else {
								html += '<div class="mui-content-padded"><div class="mui-row">';
								html += '<div class="mui-text-center mui-col-sm-10 mui-col-xs-10">';
								html += '<p>暂无考勤数据，请第二天再尝试 </p></div></div></div>';
								document.getElementById("load").classList.add("mui-hidden");								
								content.innerHTML = html;
								showWebviewToast(data.msg);
						}
					},
					error: function(xhr, type, errorThrown) {
						document.getElementById("load").addClass("mui-hidden");
						showWebviewToast("网络异常!");
					}
				});

				//通过
				document.getElementById("pass").addEventListener("tap", function() {
					document.location.href = "finishOvertime.php?id=" + id + '&date=' + date + '&status=' + 1 + '&overtime_interval=' + json_overtime_interval+'&policenum='+policenum;
				});
				//不通过
				document.getElementById("nopass").addEventListener("tap", function() {
					document.location.href = "finishOvertime.php?id=" + id + '&date=' + date + '&status=' + 2 + '&overtime_interval=' + json_overtime_interval+'&policenum='+policenum;
				});

				setTitle('加班审批详情'); //设置title

			})(mui);
		</script>
	</body>

</html>