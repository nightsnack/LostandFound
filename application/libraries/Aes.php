<?php
header("Content-type: text/html;charset=utf-8");

class Aes {
 
    // CRYPTO_CIPHER_BLOCK_SIZE 32
     
    private $_secret_key = 'default_secret_key';
     
    public function setKey($key) {
        $this->_secret_key = $key;
    }
     
    public function encode($data) {
        replace($data);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_256,'',MCRYPT_MODE_CBC,'');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td),MCRYPT_RAND);
        mcrypt_generic_init($td,$this->_secret_key,$iv);
        $encrypted = mcrypt_generic($td,$data);
        mcrypt_generic_deinit($td);
         
        return $iv . $encrypted;
    }
     
    public function decode($data) {
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_256,'',MCRYPT_MODE_CBC,'');
        $iv = mb_substr($data,0,32,'latin1');
        mcrypt_generic_init($td,$this->_secret_key,$iv);
        $data = mb_substr($data,32,mb_strlen($data,'latin1'),'latin1');
        $data = mdecrypt_generic($td,$data);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
	    $data = trim($data);
        clean($data);

        return $data;
    }
}

function replace (&$string) {
    $string=preg_replace('/ /','%E1nD#',$string);
    return $string;
}

function clean (&$string) {
    $string=preg_replace('/%E1nD#/',' ',$string);
    return $string;
}

//记住原来的key,万一要改密钥，就用$lastaes去还原数据,再用新的$aes把数据加密
//global $lastaes;
//$lastaes = new aes();
//$lastaes->setKey('yiW7BPNI8ax0O39opkKCCFQS');
//
//global $aes;
//$aes = new aes();
//$aes->setKey('yiW7BPNI8ax0O39opkKCCFQS');
 
// // 加密
// $before="njupt";
// $string = $aes->encode($before);

// echo $string."<br>";

// // 解密
// echo $aes->decode($string)."<br>";
?>