$(document).ready(function () {
    var baseurl = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/User/';
    var loaduser_url = baseurl + 'secondary_user';
    var revert_url = baseurl + 'revert_user';
    var delete_url = baseurl + 'delete_user';
    var register_url = baseurl + 'register';
    var login_url = baseurl + 'login';
    var logout_url = baseurl + 'logout';

    var pagehead = new Vue({
        el: '#pagehead',
        data: {},
        methods: {
            logout: function () {
                window.location.href = logout_url;
            }
        }
    })

    var pagemain = new Vue({
        el: '#pagemain',
        data: {},
        methods: {
            revertuser: function (username) {
                RevertPsw(username);
            },
            deleteuser: function (username) {
                DeleteUser(username);
            }
        }
    })


    //更新当前列表
    function Ajaxpage() {
        $.ajax({
            type: 'GET',
            url: loaduser_url,
            success: function (data) {

                if (data.errno == 100) {
                    window.location.href = login_url;
                    return false;
                }
                if (data.errno == 101) {
                    alert(data.error);
                    window.location.href = 'index.html';
                    return false;
                }
                pagemain.$data = data;
                pagehead.$data = data.user;
                Bindclick();
            },
            dataType: 'json'
        });
    }
    Ajaxpage();

    
    //绑定单击按钮
    function Bindclick() {
        $("#registeruser").click(function () {
            addvm.$data.user = {};
            $('#register').modal();
        });
    }
    
    //重置一个密码
    function RevertPsw(username) {
        if (confirm("确定要重置这个密码吗？")) {
            $.post(revert_url, {
                username: username
            }, function (data) {
                alert(data.error);
            }, 'json');
        }
    }
    
        //删除用户  
    function DeleteUser(username) {
        if (confirm("确定要删除这个用户吗？")) {
            $.post(delete_url, {
                username: username
            }, function (data) {
                alert(data.error);
                Ajaxpage();
            }, 'json');
        }
    }
    
        //初始化模态框 新增物品
    var addvm = new Vue({
        el: '#new',
        data: {
            user: {}
        },
        methods: {
            submit: function () {
                if($('#name').val()==''||$('#username').val()=='')
                    {
                        alert("请将信息填写完整");
                        return false;
                    }
                $.post(register_url, addvm.$data.user, function (back) {
                    if (back.errno == 0) {
                        alert("新增成功");
                        Ajaxpage();
                        $('#register').modal('hide')
                    } else {
                        alert(back.error);
                    }
                }, 'json');

            }
        }
    })


});