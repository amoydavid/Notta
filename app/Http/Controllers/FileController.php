<?php
/**
 * Wizard
 *
 * @link      https://aicode.cc/
 * @copyright 管宜尧 <mylxsw@aicode.cc>
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * 上传图片文件
     *
     * @param Request $request
     *
     * @return array
     */
    public function imageUpload(Request $request)
    {
        $files = $request->file('editormd-image-file', $request->file('file'));
        $isSingle = false;
        if(!is_array($files)) {
            $isSingle = true;
            $files = [$files];
        }
        $paths = [];
        foreach($files as $file) {
            if (!$file->isValid()) {
                return $this->response(false,
                    __('common.upload.failed', ['reason' => $file->getErrorMessage()]));
            }

            if (!in_array(strtolower($file->extension()), ["jpg", "jpeg", "gif", "png", "bmp", "mp3", 'webp'])) {
                return $this->response(false, __('common.upload.invalid_type'));
            }
            $path = $file->storePublicly(sprintf('public/%s', date('Y/m-d')));
            $url = \Storage::url($path);
            if($isSingle) {
                $paths[] = $url;
            } else {
                $paths[] = ['name'=>$file->getClientOriginalName(), 'url'=>$url];
            }
        }
        return $this->response(true, __('common.upload.success'), $isSingle?$paths[0]:$paths);
    }

    private function response(bool $isSuccess, string $message, $url = null)
    {
        return [
            'success' => $isSuccess ? 1 : 0,
            'message' => $message,
            'url'     => $url,
        ];
    }


    public function imageFetch(Request $request)
    {
        $url = $request->json('url');

        if(preg_match('/^data:image\/(.+);base64,(.+)/i', $url, $matches)) {
            $ext = strtolower($matches[1]);
            if (!in_array($ext, ["jpg", "jpeg", "gif", "png", "bmp", "mp3", 'webp'])) {
                return $this->response(false, __('common.upload.invalid_type'));
            }
            $content = base64_decode($matches[2]);
        } else {
            $ext = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
            if (!in_array($ext, ["jpg", "jpeg", "gif", "png", "bmp", "mp3", 'webp'])) {
                return $this->response(false, __('common.upload.invalid_type'));
            }
            $client = new \GuzzleHttp\Client(['verify' => false]);
            $content = $client->request('get', $url)->getBody()->getContents();
        }

        $saved_path = sprintf('public/%s', date('Y/m-d'));
        $fileHash = md5($content);

        $storage_path = 'public/'.$saved_path.'/'.$fileHash.'.'.$ext;
        $succ = \Storage::put($storage_path, $content);
        if($succ) {
            $savedUrl = \Storage::url($storage_path);
        } else {
            $savedUrl = '';
        }

        return [
            'msg' => $succ?'':'上传出错',
            'code' => $succ?0:1,
            'data' => [
                'originalURL' => $url,
                'url' => $savedUrl
            ]
        ];
    }
}