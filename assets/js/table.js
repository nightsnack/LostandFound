$(document).ready(function() {
	var loadpage_url='http://127.0.0.1/~chiyexiao/LostAndFound/index.php/ManageFind/query_page';
	var delete_url='http://127.0.0.1/~chiyexiao/LostAndFound/index.php/ManageFind/del_item';
	var showone_url='http://127.0.0.1/~chiyexiao/LostAndFound/index.php/ManageFind/query_item';


	$.ajax({
		  type: 'POST',
		  async:false,   //设置同步的ajax请求，以便于在执行完ajax之前不执行别的函数
		  url: loadpage_url,
		  data: {pagenum:1},
		  success: function(data){
				page=data.page;
				var source   = $("#entry-template").html();
				var template = Handlebars.compile(source);
				$('#table1').append(template(data));

		    },
		  dataType: 'json'
		});

	
    $(".tcdPageCode").createPage({
        pageCount:2,
        current:1,
        backFn:function(p){
        	$("#table1").empty();
        	$.post(loadpage_url,{pagenum:p} ,function(data){
        		var source   = $("#entry-template").html();
        		var template = Handlebars.compile(source);
        		$('#table1').append(template(data));
            },'json');
        }
    });
	
    
    var delGoods = function(event){
        if(confirm("您确定要删除吗?")) {
            $.post(delete_url, {item_id:event.data.item_id},function(data){
                if (data.errno ==0)
                {
                    location.reload();
                } else {
                    alert(data.error);
                }
            },'json');

        }
    };


	$("a[attr^='delgoods_']").each(function(){
        var tmp = $(this).attr('attr').split('_');
        $(this).bind("click", {item_id:tmp[1]}, delGoods);
    });

    
    
    
    $("#edit_model").click(function(){
    	$('#myModal').modal();
      });
	
    $('#myModal').on('show.bs.modal', function () {
    	$.post(showone_url,{item_id:27},function(data){

            	for(var key in data)
            	{
            		$('#'+key).attr({"value":data[key]});
            	}
        },'json');

        });
    
   
    
})
