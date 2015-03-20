$(function () {
	$(".del").live('click',function(e){
		var c = window.confirm('确定删除？');
		if(c){
			e.preventDefault();
			$.ajax({
					type: "POST",
					url: "del.php",
					dataType:'json',
					data: "id=" + $(this).attr('data-id') +' &tbname=' + $('#tbname').val(),
					success: function(r){
						//if(r.status == 0){
							alert("删除成功");
							window.location.reload();
						//}else{
						//	alert("删除失败");	
						//}
					}
			});
		}
	});

	$("#batch_del").live('click',function(e){
		var ids = [];
		$("input[name='sel[]']:checked").each(function(){
			ids.push($(this).val());
		});
		if(ids.length == 0){
			alert('请至少选择一项需要删除的');
			return;
		}
		var c = window.confirm('确定删除？');
		if(c){
			e.preventDefault();
			$.ajax({
					type: "POST",
					url: "del.php",
					dataType:'json',
					data: "id=" + ids.join(',') +' &tbname=' + $('#tbname').val(),
					success: function(r){
						//if(r.status == 0){
							alert("删除成功");
							window.location.reload();
						//}else{
						//	alert("删除失败");	
						//}
					}
			});
		}
	});


	$("input[name='selectAll']").click(function(){
		var ck = $(this).attr('checked');
		$("input[name='sel[]']").each(function(){
			if(ck == 'checked'){
				$(this).attr('checked',ck);
			}else{
				$(this).attr('checked',false);
			}	
		});
	});
});
