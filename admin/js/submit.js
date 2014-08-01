$(function () {
	$('#avatar_upload').fileupload({
        dataType: 'json',
        done: function (e, data) {
                var t = $("#avatar_thumbs");
                t.empty();
                $.each(data.result.files, function (index, file) {
                    $('<img />').attr('src',file.thumbnailUrl).appendTo(t);
                    $('<input name="avatar" type="hidden" />').val(file.name).appendTo(t);
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
                    $('<input name="rpt[]" type="hidden" />').val(file.name).appendTo(t);
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

});
