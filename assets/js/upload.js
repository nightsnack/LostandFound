$(document).ready(function () {
    
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
            max_file_size: '5000kb', //最大只能上传400kb的文件
            prevent_duplicates: true //不允许选取重复文件
        },
//        resize: {
//            width: 1080,
//            quality: 90,
//            preserve_headers: true
//        },
        multi_selection: false,
        container: document.getElementById('container'),
        flash_swf_url: 'plupload-2.1.2/js/Moxie.swf',
        silverlight_xap_url: 'plupload-2.1.2/js/Moxie.xap',

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
                    document.getElementById("uploadphotos").value = obj.Filename;
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