$(document).ready(function () {
    var baseurl = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/ManageFind/';
    var loadpage_url = baseurl + 'query_page';
    var add_url = baseurl + 'add_item';
    var delete_url = baseurl + 'del_item';
    var showone_url = baseurl + 'query_item';
    var upd_url = baseurl + 'upd_item';
    var batchdelurl = baseurl + 'batchdel_item';
    var login_url = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/User/login';
    var logout_url = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/user/logout';
    var checklogin_url = 'http://127.0.0.1/~chiyexiao/LostAndFound/index.php/User';

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
 


    //更新当前列表
    function Ajaxpage() {
        $.ajax({
            type: 'GET',
            url: checklogin_url,
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

 
});