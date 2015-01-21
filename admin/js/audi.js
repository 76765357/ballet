$(function () {
    $('.trust input').live('click',function(){
	var name = $(this).attr('name');
	var usrname = $(this).attr('usrname');
	var id = name.split('_')[1];
	var val = $(this).val();
	var url = "add.php";
	if(confirm("确定修改"+usrname+"为可信用户?")){
		$.getJSON(url,{tbname:'audi',id:id,trust:val},function(data){
			if(data.status == 0){
				alert("修改成功");
			}
		});
	}
    });
});
