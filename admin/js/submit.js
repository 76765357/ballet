$(function () {
    $('#avatar_upload').fileupload({
        dataType: 'json',
        done: function (e, data) {
                var t = $("#avatar_thumbs");
                t.empty();
                $.each(data.result.files, function (index, file) {
                    $('<img />').attr('src',file.thumbnailUrl).appendTo(t);
                    $('<input name="avatar" type="hidden" />').val(file.id).appendTo(t);
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

    $('#rpt_upload').fileupload({
        dataType: 'json',
        done: function (e, data) {
                var t = $("#rpt_thumbs");
                $.each(data.result.files, function (index, file) {
                    $('<img />').attr({'src':file.thumbnailUrl}).appendTo(t);
                    $('<b> </b>').appendTo(t);
                    $('<input name="rpt[]" type="hidden" />').val(file.id).appendTo(t);
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
		})
	});	

	$("#goonAdd").click(function(){
		window.location.reload();
	});

	$("#seeResult").click(function(){
		window.location.href = $("input[name='tbname']").val() + '.php';
	});
});
