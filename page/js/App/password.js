$().ready(function () {
    var baseurl = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/User/';
    var change_psw = baseurl+'change_psw';
    var login_url = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/User/login';
    var logout_url = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/user/logout';
    
        var pagehead = new Vue({
        el: '#pagehead',
        data: {},
        methods: {
            logout: function () {
                window.location.href = logout_url;
            }
        }
    })
    var sidebar = new Vue({
        el: '#sidebar',
        data: {}
    })
    
    function Ajaxpage() {
        $.ajax({
            type: 'GET',
            url: baseurl,
            success: function (data) {

                if (data.error) {
                    window.location.href = login_url;
                    return false;
                }
                pagehead.$data = data;
                sidebar.$data  = data;
            },
            dataType: 'json'
        });
    }
    Ajaxpage();
    
    // 在键盘按下并释放及提交后验证提交表单
    $("#pswForm").validate({
        rules: {
            oldpassword: {
                required: true,
            },
            password: {
                required: true,
                minlength: 5
            },
            confirm_password: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
        },
        messages: {
            oldpassword: {
                required: "请输入原密码"
            },
            password: {
                required: "请输入密码",
                minlength: "密码长度不能小于 5 个字母"
            },
            confirm_password: {
                required: "请输入密码",
                minlength: "密码长度不能小于 5 个字母",
                equalTo: "两次密码输入不一致"
            }
        },
        submitHandler: function () {
                var username = pagehead.$data.username,
                    oldpassword = $('input[name=oldpassword]').val(),
                    password = $('input[name=password]').val();

                $.ajax({
                    type: 'post', // 提交方式 get/post
                    url: change_psw, // 需要提交的 url
                    data: {
                        'username':username,
                        'oldpassword': oldpassword,
                        'password': password
                    },
                    success: function (data) { 
                        if (data.errno!==0){
                            alert(data.error);
                            return false;
                        }
                        window.location.href = logout_url;
                    },
                    dataType: 'json'
//                    $('#pswForm').resetForm(); // 提交后重置表单
                });
                return false; // 阻止表单自动提交事件
        }
    });
});