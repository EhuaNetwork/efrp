<?php


namespace app\api\controller;


class Viewapi
{

    public function init()
    {

        $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';//获取入站url。
        $search_1 = "google.com"; //q= utf8
        $search_2 = "baidu.com"; //wd= gbk
        $search_3 = "yahoo.cn"; //q= utf8
        $search_4 = "sogou.com"; //query= gbk
        $search_5 = "soso.com"; //w= gbk
        $search_6 = "bing.com"; //q= utf8
        $search_7 = "youdao.com"; //q= utf8

        $google = preg_match("/\b
{
$search_1
}

\b/
", $url);//记录匹配情况，用于入站判断。
        $baidu = preg_match("/\b{$search_2}\b/", $url);
        $yahoo = preg_match("/\b{$search_3}\b/", $url);
        $sogou = preg_match("/\b{$search_4}\b/", $url);
        $soso = preg_match("/\b{$search_5}\b/", $url);
        $bing = preg_match("/\b{$search_6}\b/", $url);
        $youdao = preg_match("/\b{$search_7}\b/", $url);
        $s_s_keyword = "";
        $bul = $_SERVER['HTTP_REFERER'];
//获取没参数域名
        preg_match('@^(?:http://)?([^/]+)@i', $bul, $matches);
        $burl = $matches[1];
//匹配域名设置
        $curl = "www.netxu.com";
        if ($burl != $curl) {
            if ($google) {//来自google
                $s_s_keyword = $this->get_keyword($url, 'q=');//关键词前的字符为"q="。
                $s_s_keyword = urldecode($s_s_keyword);
                $urlname = "谷歌：";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["s_s_keyword"] = $s_s_keyword;
//$s_s_keyword=iconv("GBK","UTF-8",$s_s_keyword);//引擎为gbk
            } else if ($baidu) {//来自百度
                $s_s_keyword = $this->get_keyword($url, 'wd=');//关键词前的字符为"wd="。
                $s_s_keyword = urldecode($s_s_keyword);
                $s_s_keyword = iconv("GBK", "UTF-8", $s_s_keyword);//引擎为gbk
                $urlname = "百度：";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($yahoo) {//来自雅虎
                $s_s_keyword = $this->get_keyword($url, 'q=');//关键词前的字符为"q="。
                $s_s_keyword = urldecode($s_s_keyword);
//$s_s_keyword=iconv("GBK","UTF-8",$s_s_keyword);//引擎为gbk
                $urlname = "雅虎：";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($sogou) {//来自搜狗
                $s_s_keyword = $this->get_keyword($url, 'query=');//关键词前的字符为"query="。
                $s_s_keyword = urldecode($s_s_keyword);
                $s_s_keyword = iconv("GBK", "UTF-8", $s_s_keyword);//引擎为gbk
                $urlname = "搜狗：";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($soso) {//来自搜搜
                $s_s_keyword = $this->get_keyword($url, 'w=');//关键词前的字符为"w="。
                $s_s_keyword = urldecode($s_s_keyword);
                $s_s_keyword = iconv("GBK", "UTF-8", $s_s_keyword);//引擎为gbk
                $urlname = "搜搜：";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($bing) {//来自必应
                $s_s_keyword = $this->get_keyword($url, 'q=');//关键词前的字符为"q="。
                $s_s_keyword = urldecode($s_s_keyword);
//$s_s_keyword=iconv("GBK","UTF-8",$s_s_keyword);//引擎为gbk
                $urlname = "必应：";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($youdao) {//来自有道
                $s_s_keyword = $this->get_keyword($url, 'q=');//关键词前的字符为"q="。
                $s_s_keyword = urldecode($s_s_keyword);
//$s_s_keyword=iconv("GBK","UTF-8",$s_s_keyword);//引擎为gbk
                $urlname = "有道：";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else {
                $urlname = $burl;
                $s_s_keyword = "";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            }
            $s_urlname = $urlname;
            $s_urlkey = $s_s_keyword;
        } else {
            $s_urlname = $_SESSION["urlname"];
            $s_urlkey = $_SESSION["s_s_keyword"];
        }


        dd($_SESSION);
    }

    //获取来自搜索引擎入站时的关键词
    private function get_keyword($url, $kw_start)
    {
        $start = stripos($url, $kw_start);
        $url = substr($url, $start + strlen($kw_start));
        $start = stripos($url, '&');
        if ($start > 0) {
            $start = stripos($url, '&');
            $s_s_keyword = substr($url, 0, $start);
        } else {
            $s_s_keyword = substr($url, 0);
        }
        return $s_s_keyword;
    }

}