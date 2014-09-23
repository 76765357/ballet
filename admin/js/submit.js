$(function () {
    function get_img_li(imgurl,thumbnailUrl,id,name,size){
        return '<li>' +
                '<img class="dashboard-avatar" alt="" style="width:auto" src="'+ thumbnailUrl +'">' +
                '<strong>文件名:</strong><a href="' + imgurl + '" target="_blank"> 点击查看 </a><br>'+
                //'<strong>大&nbsp;&nbsp;&nbsp;小:</strong> '+ Math.floor(size/1024) +'KB<br>'+
                '<strong>描&nbsp;&nbsp;&nbsp;述:</strong> <input name="rpt_desc[]" type="text" style="height:12px"/><br>'+
                '<button class="btn btn-mini btn-danger del_img">删除</button>' +
                '<input name="rpt[]" type="hidden" value="'+ id +'"/>'+                               
        '</li>';
    }

    $('.del_img').live('click',function(){
        $(this).parent('li').remove();
    });

    $('#avatar_upload').fileupload({
        dataType: 'json',
        done: function (e, data) {
                var t = $("#avatar_thumbs");
                t.empty();
                $.each(data.result.files, function (index, file) {
                    $('<img />').attr('src',file.thumbnailUrl).appendTo(t);
                    $('<input name="avatar" type="hidden" />').val(file.id).appendTo(t);
                    $('#avatar_progress .bar').hide();
                });
        },
        progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#avatar_progress .bar').css(
                    'width',
                    progress + '%'
                );
        }
    });

    $('#video_upload').fileupload({
        dataType: 'json',
        done: function (e, data) {
                var t = $("#video_info");
                t.empty();
                $.each(data.result.files, function (index, file) {
                    //$('<img />').attr('src',file.thumbnailUrl).appendTo(t);
                    $('<strong>视频链接地址: </strong>').appendTo(t);
                    $('<a target="_blank"> 点击查看</a>').attr('href',file.url).appendTo(t);
                    $('<br />').appendTo(t);
                    $('<strong>视频大小:</strong>').appendTo(t);
                    $('<span> </span>').html(Math.floor(file.size/1024/1024) + 'MB').appendTo(t);
                    $('<input name="video" type="hidden" />').val(file.id).appendTo(t);
                });
		alert('上传成功!');
		$("#progressDiv").addClass('hide');
        },
        progressall: function (e, data) {
		$("#progressDiv").removeClass('hide');
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#video_progress .bar').css(
                    'width',
                    progress + '%'
                );
        }
    });

    $('#videoimg_upload').fileupload({
        dataType: 'json',
        done: function (e, data) {
                var t = $("#videoimg_thumbs");
                t.empty();
                $.each(data.result.files, function (index, file) {
                    $('<img />').attr('src',file.thumbnailUrl).appendTo(t);
                    $('<input name="video_img" type="hidden" />').val(file.name).appendTo(t);
                });
        },
        progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#videoimg_progress .bar').css(
                    'width',
                    progress + '%'
                );
        }
    });

    $('#rpt_upload').fileupload({
        dataType: 'json',
        done: function (e, data) {
                var t = $("#rpt_thumbs");
                $.each(data.result.files, function (index, file) {
                    var li = get_img_li(file.url,file.thumbnailUrl,file.id,file.name,file.size);
                    t.append(li);
                    /*$('<img />').attr({'src':file.thumbnailUrl}).appendTo(t);
                    $('<b> </b>').appendTo(t);
                    $('<input name="rpt[]" type="hidden" />').val(file.id).appendTo(t);*/
                    $('#rpt_progress .bar').hide();
                });
        },
        progressall: function (e, data) {
                $('#rpt_progress .bar').show();
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#rpt_progress .bar').css(
                    'width',
                    progress + '%'
                );
        }
	});
	
    $("#mainsave").click(function(e){
        if($("#mainform")[0].checkValidity()){
    		e.preventDefault();
    		$.ajax({
    				type: "POST",
    				url: "add.php",
    				dataType:'json',
    				data: $("#mainform").serialize(),
    				success: function(r){
    					if(r.status == 0){
    						$('#saveModal').modal('show');
    					}else{
    						alert("保存失败");	
    					}
    				}
    		});
        }
	});	

	$("#goonAdd").click(function(){
        var h = window.location.href;
        if(h.indexOf('?')){
            var ph = h.split('?');
            window.location.href = ph[0];
        }else{
            window.location.reload();
        }
		
	});

	$("#seeResult").click(function(){
		window.location.href = $("input[name='tbname']").val() + '.php';
	});
});
