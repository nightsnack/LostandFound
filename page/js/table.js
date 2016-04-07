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
    var page;

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
            deletegood: function (id) {
                delGoods(id);
            },
            editgood: function (id) {
                BindModel(id);
            }
        }
    })


    //更新当前列表
    function Ajaxpage(pagenum) {
        $.ajax({
            type: 'POST',
            async: false, //设置同步的ajax请求，以便于在执行完ajax之前不执行别的函数
            url: loadpage_url,
            data: {
                pagenum: pagenum
            },
            success: function (data) {

                if (data.error) {
                    window.location.href = login_url;
                    return false;
                }
                page = data.page;
                pagemain.$data = data;
                pagehead.$data = data.user;
                Bindclick();
            },
            dataType: 'json'
        });
    }
    Ajaxpage(1);

    //生成页码
    $(".tcdPageCode").createPage({
        pageCount: page,
        current: 1,
        backFn: function (p) {
            pagemain.$data = {};
            Ajaxpage(p);
        }
    });


    //绑定单击按钮
    function Bindclick() {
        $("#checkedAll").bind("click", check);
        $("#additem").click(function () {
            addvm.$data.item = {};
            if (!!$(".progress.active").length) {
                $(".progress.active").remove();
                $(".active").remove();
            }

            $('#newModal').modal();
        });
    }
    //初始化模态框
    var model = new Vue({
        el: '#abc',
        data: {
            msg: ''
        },
        methods: {
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
    var addvm = new Vue({
        el: '#new',
        data: {
            item: {}
        },
        methods: {
            submit: function () {
                $.post(add_url, addvm.$data.item, function (back) {
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
    function BindModel(id) {
        $.post(showone_url, {
            item_id: id
        }, function (data) {
            model.$data.msg = data;
        }, 'json');
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
                item_id: event
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
        if (confirm("确定要删除吗？")) {
            var id = new Array();
            check.each(function (i) {
                id[i] = $(this).val();
            });

            $.post(batchdelurl, {
                item_id: id
            }, function (data) {
                if (data.errno == 0) {
                    location.reload();
                } else {
                    alert(data.error);
                }


            }, 'json');
        }
    });



    accessid = ''
    accesskey = ''
    host = ''
    policyBase64 = ''
    signature = ''
    callbackbody = ''
    filename = ''
    key = ''
    expire = 0
    now = timestamp = Date.parse(new Date()) / 1000;

    function send_request() {
        var xmlhttp = null;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        if (xmlhttp != null) {
            phpUrl = 'http://ossserver.aifuwu.org/LostAndFound/get.php'
            xmlhttp.open("GET", phpUrl, false);
            xmlhttp.send(null);
            return xmlhttp.responseText
        } else {
            alert("Your browser does not support XMLHTTP.");
        }
    };

    function get_signature() {
        //可以判断当前expire是否超过了当前时间,如果超过了当前时间,就重新取一下.3s 做为缓冲
        now = timestamp = Date.parse(new Date()) / 1000;
        if (expire < now + 3) {
            body = send_request()
            var obj = eval("(" + body + ")");
            host = obj['host']
            policyBase64 = obj['policy']
            accessid = obj['accessid']
            signature = obj['signature']
            expire = parseInt(obj['expire'])
            callbackbody = obj['callback']
            key = obj['dir']
            return true;
        }
        return false;
    };

    function set_upload_param(up) {
        var ret = get_signature()
        if (ret == true) {
            var d = new Date();
            var datestring = d.toISOString();
            new_multipart_params = {
                'key': key + datestring + '${filename}',
                'policy': policyBase64,
                'OSSAccessKeyId': accessid,
                'success_action_status': '200', //让服务端返回200,不然，默认会返回204
                'callback': callbackbody,
                'signature': signature,
            };

            up.setOption({
                'url': host,
                'multipart_params': new_multipart_params
            });
            //uploader.start();
        }
    }

    var uploader = new plupload.Uploader({
        runtimes: 'html5,flash,silverlight,html4',
        browse_button: 'selectfiles',
        filters: {
            mime_types: [ //只允许上传图片和zip文件
                {
                    title: "Image files",
                    extensions: "jpg,bmp,gif,png,jpeg,JPG,JPEG,BMP,PNG"
            }
      ],
            max_file_size: '10000kb', //最大只能上传400kb的文件
            prevent_duplicates: true //不允许选取重复文件
        },
        resize: {
            width: 1080,
            quality: 90,
            preserve_headers: true
        },
        multi_selection: false,
        container: document.getElementById('container'),
        flash_swf_url: 'lib/plupload-2.1.2/js/Moxie.swf',
        silverlight_xap_url: 'lib/plupload-2.1.2/js/Moxie.xap',

        url: 'http://oss.aliyuncs.com',

        init: {
            PostInit: function () {
                document.getElementById('ossfile').innerHTML = '';
                document.getElementById('postfiles').onclick = function () {
                    if (!!$(".progress.active").length) {
                        set_upload_param(uploader);
                        uploader.start();
                    }
                    return false;
                };
            },

            FilesAdded: function (up, files) {
                plupload.each(files, function (file) {
                    document.getElementById('ossfile').innerHTML += '<div id="' + file.id + '" class="active">' + file.name + ' (' + plupload.formatSize(file.size) + ')<b></b>' + '<div class="progress active"><div class="progress-bar progress-bar-success progress-bar-striped" style="width: 0%"></div></div>' + '</div>';
                });
                while (up.files.length > 1) {
                    var el = document.getElementById(up.files[0].id);
                    el.parentNode.removeChild(el);
                    up.removeFile(up.files[0]);
                }
            },

            UploadProgress: function (up, file) {
                var d = document.getElementById(file.id);
                d.getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";

                var prog = d.getElementsByTagName('div')[0];
                var progBar = prog.getElementsByTagName('div')[0]
                progBar.style.width = 6 * file.percent + 'px';
                progBar.setAttribute('aria-valuenow', file.percent);
            },

            FileUploaded: function (up, file, info) {
                set_upload_param(up);
                if (info.status == 200) {
                    $("#postfiles").attr("disabled", true);
                    var obj = JSON.parse(info.response);
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = ' 上传成功！';
                    addvm.$data.item.uploadphotos = obj.Filename;
                } else {
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = info.response;
                }
            },

            //		Error: function(up, err) {
            //            set_upload_param(up);
            //			document.getElementById('console').appendChild(document.createTextNode("\nError xml:" + err.response));
            //		}
        }
    });

    uploader.init();



});