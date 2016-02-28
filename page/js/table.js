$(document).ready(function () {
    var loadpage_url = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/ManageFind/query_page';
    var add_url = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/ManageFind/add_item';
    var delete_url = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/ManageFind/del_item';
    var showone_url = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/ManageFind/query_item';
    var upd_url = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/ManageFind/upd_item';
    var batchdelurl = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/ManageFind/batchdel_item';
    var page;
    var source = $("#entry-template").html();
    var template = Handlebars.compile(source);
    //更新当前列表
    function Ajaxpage(pagenum) {
        $.ajax({
            type: 'POST'
            , async: false, //设置同步的ajax请求，以便于在执行完ajax之前不执行别的函数
            url: loadpage_url
            , data: {
                pagenum: pagenum
            }
            , success: function (data) {
                page = data.page;

                $('#table1').append(template(data));
                Bindclick();


            }
            , dataType: 'json'
        });
    }
    Ajaxpage(1);

    //生成页码
    $(".tcdPageCode").createPage({
        pageCount: page
        , current: 1
        , backFn: function (p) {
            $("#table1").empty();
            Ajaxpage(p);
        }
    });


    //绑定单击按钮
    function Bindclick() {
        $("a[attr^='delgoods_']").each(function () {
            var tmp = $(this).attr('attr').split('_');
            $(this).bind("click", {
                item_id: tmp[1]
            }, delGoods);
        });
        $("a[id=edit_model]").each(function () {
            var data_id;
            data_id = $(this).attr("data-id");
            $(this).bind("click", {
                item_id: data_id
            }, BindModel);
        });
        $("#checkedAll").bind("click", check);
        $("#additem").click(function(){
            vm.$data.msg = {};
    	$('#newModal').modal();
      });
    }
    //初始化模态框
    var model = new Vue({
        el: '#abc'
        , data: {
            msg: ''
        }
        , methods: {
            submit: function () {
                $.post(upd_url, model.$data.msg, function (back) {
                    if (back.errno == 0) {
                        alert("更新成功");
                        $("#table1").empty();
                        var p = $("span.current").html();
                        Ajaxpage(p);
                        $('#myModal').modal('hide')
                    } else {
                        alert(back.error);
                    }
                }, 'json');

            }
        }
    })
    
        //初始化模态框 新增物品
    var vm = new Vue({
        el: '#new'
        , data: {
            item: {
            }
        }
        , methods: {
            submit: function () {
                $.post(add_url, vm.$data.item, function (back) {
                    if (back.errno == 0) {
                        alert("新增成功");
                        $("#table1").empty();
                        var p = $("span.current").html();
                        Ajaxpage(p);
                        $('#newModal').modal('hide')
                    } else {
                        alert(back.error);
                    }
                }, 'json');

            }
        }
    })

    //查询一个物品详情的模态框
    function BindModel(event) {
        $.post(showone_url, {
            item_id: event.data.item_id
        }, function (data) {
            Modeltext(data);
        }, 'json');

    }

    function Modeltext(data) {
        model.$data.msg = data;
    }

    //全选、取消全选
    var checkflag = "false";

    function check() {
        field = $("input[id^='checkbox']");
        if (checkflag == "false") {
            for (i = 0; i < field.length; i++) {
                field[i].checked = true;
            }
            checkflag = "true";
            return "什么都不选";
        } else {
            for (i = 0; i < field.length; i++) {
                field[i].checked = false;
            }
            checkflag = "false";
            return "选中所有";
        }
    }

    //单个删除
    function delGoods(event) {
        if (confirm("您确定要删除吗?")) {
            $.post(delete_url, {
                item_id: event.data.item_id
            }, function (data) {
                if (data.errno == 0) {
                    location.reload();
                } else {
                    alert(data.error);
                }
            }, 'json');

        }
    }


    //批量删除
    $("[attr='BatchDel']").click(function () {
        var check = $("input:checked");
        if (check.length < 1) {
            alert('请选择删除项');
            return false;
        }
        var id = new Array();
        check.each(function (i) {
            id[i] = $(this).val();
        });

        $.post(batchdelurl, {
            item_id: id
            , mp_account_id: $('#mp_account_id').val()
        }, function (data) {
            if (data.errno == 0) {
                location.reload();
            } else {
                alert(data.error);
            }


        }, 'json');

    });



});