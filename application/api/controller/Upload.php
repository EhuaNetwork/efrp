<?php


namespace app\api\controller;


class Upload
{
    //layui
    public function img()
    {

        $file = request()->file('file');
        if (empty($file)) {
            return json(['code' => -1, 'msg' => '未获取到文件信息', 'data' => []]);
        }

        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if ($info) {

            $name_path = str_replace('\\', "/", $info->getSaveName());

            return json(['code' => 0, 'msg' => '上传成功', 'data' => ['src' => '/uploads/' . $name_path]]);
        } else {
            return json(['code' => -1, 'msg' => '上传失败', 'data' => $info->getError()]);
        }
    }

    //wangeditor
    public function wangeditor()
    {

        $file = request()->file();
        if (empty($file)) {
            return json(['code' => -1, 'msg' => '未获取到文件信息', 'data' => []]);
        }


        foreach ($file as $f) {
            $info = $f->move(ROOT_PATH . 'public' . DS . 'uploads');
            $name_path = str_replace('\\', "/", $info->getSaveName());

            $data[] = ['url' => '/uploads/' . $info->getSaveName(), 'alt' => '', 'href' => '/uploads/' . $name_path];
        }


        if ($info) {
            return json(['errno' => 0, 'data' => $data]);
        } else {
            return json(['errno' => -1, 'fail' => $info->getError()]);
        }
    }


    public function wangeditor3()
    {
        $files = request()->file('file');

        //上传回调error为0
        if (empty($files)) {
            $result["error"] = "1";
            $result['data'] = '';
        } else {
            if (is_array($files)) {
                foreach ($files as $file) {
                    // 移动到框架应用根目录/public/uploads/ 目录下


                    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/editor');
                    if ($info) {
                        $name_path = $info->getSaveName();
                        //成功上传后 获取上传信息
                        $name_path = str_replace('\\', "/", $info->getSaveName());
                        $path[] = "/uploads/editor/" . $name_path;
                    } else {
                        // 上传失败获取错误信息
//                    $result["code"] = "2";
//                    $result["errno"] = '1';
//                    $result['data'] = '';
                    }
                }
            } else {
                $info = $files->move(ROOT_PATH . 'public' . DS . 'uploads/editor');
                if ($info) {
                    $name_path = $info->getSaveName();
                    //成功上传后 获取上传信息
                    $name_path = str_replace('\\', "/", $info->getSaveName());
                    $path = "/uploads/editor/" . $name_path;
                }
            }
            $result["error"] = '0';
            $result["errno"] = '0';
            $result['data'] = $path;
        }
        exit(json_encode($result));
    }

    public function wangeditor3_video()
    {
        $file = request()->file('file');
        //上传回调error为0
        if (empty($file)) {
            $result["error"] = "1";
            $result['data'] = '';
        } else {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/editor');
            if ($info) {
                $name_path = $info->getSaveName();
                //成功上传后 获取上传信息
                $name_path = str_replace('\\', "/", $info->getSaveName());
                $result["error"] = '0';
                $result["errno"] = '0';

                $result['data'] = "/uploads/editor/" . $name_path;
            } else {
                // 上传失败获取错误信息
                $result["errno"] = '1';
                $result["code"] = "2";
                $result['data'] = '';
            }
        }
        exit(json_encode($result));
    }
}