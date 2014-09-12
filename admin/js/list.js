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
});
